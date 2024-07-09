<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Throwable;
use Exception;

class GoogleAuthController extends Controller
{
    
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callbackGoogle()
    {
        try{
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('google_id', $googleUser->getId())->first();
            if(!$user)
            {
                $newUser= User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),

                ]);

                Auth::login($newUser);
                return redirect()->intended('home');
            }

                Auth::login($user);
                return redirect()->intended('home');

        }
        catch(\Throwable $th){
            //
            dd("SomeThing Went Wrong!" . $th->getMessage());
        }   
    }
}
