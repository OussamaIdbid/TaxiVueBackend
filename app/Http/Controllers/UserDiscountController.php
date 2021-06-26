<?php

namespace App\Http\Controllers;

use App\UserDiscount;
use Illuminate\Http\Request;

class UserDiscountController extends Controller
{
    public function getAllUserDiscount() { 

        $userDiscount = UserDiscount::all();

        return response()->json($userDiscount);
    }

    public function createUserDiscount(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'discount_id' => ['required'],
        ]);

        $userDiscount = UserDiscount::create($request->all());

        return response()->json($userDiscount, 201);

    }
}
