<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Models\WebUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GoogleProvider;
use Laravel\Socialite\Two\FacebookProvider;
use Modules\Setting\Entities\SocialLoginApiKey;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {

/*
|--------------------------------------------------------------------------
| Login Controller
|--------------------------------------------------------------------------
|
| This controller handles authenticating users for the application and
| redirecting them to your home screen. The controller uses a trait
| to conveniently provide its functionality to your applications.
|
 */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    

    public function showLoginForm() {

        return view('auth.login');
    }

    public function login(Request $request)
    {
        
        $this->validateLogin($request);

        // Custom checking the in_active users
        $user = User::where('email', $request->email)->first();
        if ($user && !$user->is_active) {
            return redirect()->back()->with('error', 'Your account is inactive. Please contact support.');
        }
        // End

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            // Insert data into the ActivityLog
            activity()
            ->causedBy($user)
            ->useLog('Login')
            ->log('Logged In');

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $user = auth()->user();

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        // Insert data into the ActivityLog
        activity()
        ->causedBy($user)
        ->useLog('Logout')
        ->log('Logged Out');

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->to(__url('/'));
    }

    public function redirectToGoogle()
    {
        $googleConfig = SocialLoginApiKey::where('provider', 'google')->first();

        $config = [
            'client_id' => $googleConfig->client_id,
            'client_secret' => $googleConfig->client_secret,
            'redirect' => route('google-callback'),
        ];

        return Socialite::buildProvider(GoogleProvider::class, $config)->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleConfig = SocialLoginApiKey::where('provider', 'google')->first();
        $config = [
            'client_id' => $googleConfig->client_id,
            'client_secret' => $googleConfig->client_secret,
            'redirect' => route('google-callback'),
        ];

        $googleUser = Socialite::buildProvider(GoogleProvider::class, $config)
            ->stateless()
            ->user();

        $user = WebUser::where('email', $googleUser->getEmail())->first();
        if (!$user) {
            $imageUrl = $googleUser->getAvatar();
            $response = Http::get($imageUrl);
            $imageContents = $response->body();

            // Detect MIME type to get extension
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($imageContents);
            $extension = match ($mimeType) {
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp',
                default => 'jpg',
            };

            // Save image with unique filename
            $filename = 'avatars/' . Str::uuid() . '.' . $extension;
            Storage::disk('public')->put($filename, $imageContents);

            // Create new user
            $user = WebUser::create([
                'social_id' => $googleUser->getId(),
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $filename,
            ]);
        }

        Auth::guard('webuser')->login($user);
        return redirect('/');
    }

    public function redirectToFacebook()
    {
        $facebookConfig = SocialLoginApiKey::where('provider', 'facebook')->first();

        $config = [
            'client_id' => $facebookConfig->client_id,
            'client_secret' => $facebookConfig->client_secret,
            'redirect' => route('facebook-callback'),
        ];

        return Socialite::buildProvider(FacebookProvider::class, $config)->redirect();
    }

    public function handleFacebookCallback()
    {
        $facebookConfig = SocialLoginApiKey::where('provider', 'facebook')->first();
        $config = [
            'client_id' => $facebookConfig->client_id,
            'client_secret' => $facebookConfig->client_secret,
            'redirect' => route('facebook-callback'),
        ];
    
        // Get user from Facebook using Socialite
        try {
            $facebookUser = Socialite::buildProvider(FacebookProvider::class, $config)
                ->stateless()
                ->user();
        } catch (\Throwable $th) {
            return redirect('/')->withErrors(['error' => 'Failed to authenticate with Facebook. Please try again.']);
        }

        // Check if user already exists
        $user = WebUser::where('email', $facebookUser->getEmail())->first();
        if (!$user) {
            // Use access_token to fetch real profile picture (not placeholder)
            $imageUrl = 'https://graph.facebook.com/' . $facebookUser->getId() . '/picture?type=large&access_token=' . $facebookUser->token;

            // Fetch image content
            $response = Http::get($imageUrl);
            $imageContents = $response->body();

            // Get MIME type
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($imageContents);

            // Determine file extension
            $extension = match ($mimeType) {
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp',
                default => 'jpg',
            };

            // Generate filename and save image to storage
            $filename = 'avatars/' . Str::uuid() . '.' . $extension;
            Storage::disk('public')->put($filename, $imageContents);

            // Create new user
            $user = WebUser::create([
                'social_id' => $facebookUser->getId(),
                'name' => $facebookUser->getName(),
                'email' => $facebookUser->getEmail(),
                'avatar' => $filename
            ]);
        }

        // Log the user in using the webuser guard
        Auth::guard('webuser')->login($user);

        // Redirect to home
        return redirect('/');
    }

    /**
     * Manual Login
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function manualLogin(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'email' => ['required', 'email', Rule::exists(WebUser::class, 'email')],
                'password' => ['required', 'string'],
            ]);

            // Check user
            $user = WebUser::where('email', $validated['email'])->first();
            if (!$user || !Hash::check($validated['password'], $user->password)) {
                throw new Exception('Invalid email or password');
            }

            // Log the user in
            Auth::guard('webuser')->login($user);

            return response()->json([
                'status' => true,
                'message' => 'Login successfully',
                'redirect' => __url('/'),
            ]);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


}
