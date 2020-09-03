<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Response;

class VerificationController extends Controller
{
     public function verify(Request $request) {
        
        $user = User::findOrFail($request->id);

        // if (! hash_equals((string) $request->id, (string) $request->user()->getKey())) {
        //     throw new AuthorizationException;
        // }

        // dd($user->getEmailForVerification(), $request->hash);

        if (! hash_equals((string) $request->hash, sha1($user->getEmailForVerification()))) {
            return response()->json([
                "message" => "Unauthorized",
                "success" => false
            ]);
        }

        if ($user->hasVerifiedEmail()) {
                return response()->json([
                    "message" => "Je email is al bevestigd",
                    "success" => false
                ]);

        //     return $request->wantsJson()
        //                 ? new Response('', 204)
        //                 : redirect($this->redirectPath());
         }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // if ($response = $this->verified($request)) {
        //     return $response;
        // }

        return response()->json([
            "message" => "Je email is bevestigd!",
            "success" => "true"
        ]);
    

     }
     
     public function resendVerificationEmail(Request $request) {

        $user = User::where('email', $request->email)->first();

        if(!$user) {
            return response()->json([
                "message" => "Het versturen is niet gelukt!",
                "success" => false
            ]);
        }


        $user->sendEmailVerificationNotification();

        return response()->json([
            "message" => "Er is opnieuw een bevestigings mail verstuurd naar je email!",
            "success" => true
        ]);
     }
}
