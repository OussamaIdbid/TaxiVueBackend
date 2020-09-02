<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class UserController extends Controller
{
    public function edit() {

            $user = User::find(Auth::user());
            
                return $user;
            

        
    }
    public function update(Request $request) {

        $user = User::find(Auth::user()->id);

        if(Auth::user()->email === $request['email']) {
            $request->validate([
                'name' => ['required', 'min:2'],
                'email' => ['required','email']
            ]);           
        }else {
            $request->validate([
                'name' => ['required', 'min:2'],
                'email' => ['required','email', 'unique:users']
            ]);
        }
        
        $user->name = $request['name'];
        $user->email = $request['email'];

        $user->save();



    }
    public function passwordEdit() {        

        
    }
    public function passwordUpdate(Request $request) {
        $validate = $request->validate([
            'oldPassword' => ['required', 'min:8'],
            'password' => ['required','min:8',"confirmed"]
        ]);

        $user = User::find(Auth::user()->id);

            if(Hash::check($request['oldPassword'], $user->password) && $validate) {
                $user->password = Hash::make($request['password']);
    
                $user->save();
            }else{

                throw ValidationException::withMessages([
                    'oldPassword' => ['The provided credentials are incorrect.']
                ]);
            }

        

        
    }


}
