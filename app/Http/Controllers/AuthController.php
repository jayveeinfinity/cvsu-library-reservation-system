<?php

namespace App\Http\Controllers;

use App\Models\GoogleUserInfo;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    { 
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
            $socialiteUser = Socialite::driver('google')->user();

            // Insert google user info 
            $googleUserInfo = GoogleUserInfo::updateOrCreate([
                'email'   => $socialiteUser->email,
            ],[
                'gid'           => $socialiteUser->user['id'],
                'email'         => $socialiteUser->user['email'],
                'givenName'     => $socialiteUser->user['given_name'],
                'familyName'    => $socialiteUser->user['family_name'] ?? NULL,
                'name'          => $socialiteUser->user['name'],
                'picture'       => $socialiteUser->user['picture'],
                'verifiedEmail' => $socialiteUser->user['verified_email'],
                'hd'            => $socialiteUser->user['hd'] ?? NULL
            ]);

            // Check if the email domain is using cvsu.edu.ph
            if($googleUserInfo->hd != "cvsu.edu.ph") {
                $data = ['code' => 401, 'message' => "You must used an email of cvsu.edu.ph"];
                return view('errors.index', compact('data'));
            }

            $user = User::updateOrCreate(
                ['email' => $googleUserInfo->email], 
                [
                    'name'      => $googleUserInfo->name,
                    'email'     => $googleUserInfo->email
                ]
            );

            // Assign Patron Role to user if has no roles assigned
            if($user->roles()->count() <= 0) {
                $user->assignRole('patron');
            }
            
            Auth::login($user);
            return redirect()->intended('/');
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}