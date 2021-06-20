<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discount;

class DiscountController extends Controller
{
    public function showByDiscount($query){

        $discount = Discount::where("code","=", $query)->firstOrFail();

        return response()->json($discount);
    }
}
