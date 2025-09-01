<?php

namespace App\Http\Controllers\Website;

use App\Helpers\ThemeHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->guard('webuser')->user();
        return ThemeHelper::view('account_setting', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = auth()->guard('webuser')->user();

        $request->validate([
            'user_name'   => 'required|string|max:255',
            'user_email'  => 'required|email|max:255|unique:web_users,email,' . $user->id,
            'password'    => 'nullable|string|min:6|confirmed',
            'banner'      => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'profile'     => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        $user->name = $request->user_name;
        $user->email = $request->user_email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Banner Upload
        if ($request->hasFile('banner')) {
            if ($user->bg_image) {
                Storage::disk('public')->delete($user->bg_image);
            }

            $bannerFile = $request->file('banner');
            $bannerName = time() . '_banner.' . $bannerFile->getClientOriginalExtension();
            $bannerPath = Storage::disk('public')->putFileAs('banners', $bannerFile, $bannerName);
            Image::make($bannerFile)->save(public_path('storage/' . $bannerPath));
            $user->bg_image = $bannerPath;
        }

        // Profile Upload
        if ($request->hasFile('profile')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $profileFile = $request->file('profile');
            $profileName = time() . '_profile.' . $profileFile->getClientOriginalExtension();
            $profilePath = Storage::disk('public')->putFileAs('profiles', $profileFile, $profileName);
            Image::make($profileFile)->save(public_path('storage/' . $profilePath));
            $user->avatar = $profilePath;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = auth()->guard('webuser')->user();

        // Validate password and checkbox
        $request->validate([
            'account_password' => 'required|string',
            'term_condition' => 'accepted',
        ]);

        // Check if the provided password matches
        if (!Hash::check($request->account_password, $user->password)) {
            return back()->withErrors(['account_password' => 'The provided password is incorrect.']);
        }

        // Optional: Delete avatar and banner images
        if ($user->avatar && \Storage::disk('public')->exists($user->avatar)) {
            \Storage::disk('public')->delete($user->avatar);
        }
        if ($user->bg_image && \Storage::disk('public')->exists($user->bg_image)) {
            \Storage::disk('public')->delete($user->bg_image);
        }

        // Logout and delete the user
        Auth::guard('webuser')->logout();
        $user->delete();

        // Redirect to homepage or login with success message
        return redirect('/')->with('success', 'Your account has been deleted successfully.');
    }
}
