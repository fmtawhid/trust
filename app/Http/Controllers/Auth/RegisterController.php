<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\WebUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Modules\Setting\Entities\Setting;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Modules\User\Entities\PasswordSetting;
use Illuminate\Foundation\Auth\RedirectsUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;

    use RedirectsUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        $passwordSetting = PasswordSetting::firstOrFail();
        $this->validator($request->all())->validate();
        $data = $request->except(['password','user_type_id']);
        $data['password'] = $request->password . $passwordSetting->salt;
        $data['user_type_id'] = 1;

        event(new Registered($user = $this->create($data)));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_type_id' => 1,
        ]);
    }

    protected function guard()
    {
        return Auth::guard();
    }

    protected function registered(Request $request, $user)
    {
        //
    }

    /**
     * Account store
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Step 1: Validate the form fields
        $validatedData = $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'user_email' => ['required', 'email', Rule::unique(WebUser::class, 'email')],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
            'recaptcha_token' => ['nullable', 'string'],
        ]);

        // Step 2: Check if reCAPTCHA is enabled
        $recaptchaData = Setting::select('details')
            ->where('event', 'google_recaptcha')
            ->first();

        $recaptchaInfo = $recaptchaData ? json_decode($recaptchaData->details) : null;

        if ($recaptchaInfo && !empty($recaptchaInfo->site_key) && !empty($recaptchaInfo->secret_key)) {
            // Only validate if keys exist (reCAPTCHA enabled)
            if (empty($validatedData['recaptcha_token'])) {
                return back()
                    ->withErrors(['recaptcha' => 'reCAPTCHA is required. Please try again.'])
                    ->withInput();
            }

            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => $recaptchaInfo->secret_key,
                'response' => $validatedData['recaptcha_token'],
                'remoteip' => $request->ip(),
            ]);

            $result = $response->json();

            if (
                empty($result['success']) ||
                $result['success'] !== true ||
                ($result['score'] ?? 0) < 0.5
            ) {
                return back()
                    ->withErrors(['recaptcha' => 'reCAPTCHA verification failed. Please try again.'])
                    ->withInput();

            }
        }

        // Step 3: Create the user
        try {
            $user = WebUser::create([
                "name" => $validatedData['user_name'],
                "email" => $validatedData['user_email'],
                "password" => Hash::make($validatedData['password']),
            ]);

            auth()->guard('webuser')->login($user);

            return redirect()->to(__url('/'));
        } catch (\Exception $e) {
            return back()
                    ->withErrors(['error' => $e->getMessage()])
                    ->withInput();
        }
    }
}
