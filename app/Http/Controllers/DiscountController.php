<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discount;
use App\Reservation;

class DiscountController extends Controller
{
    public function showByDiscount($query){

        $discount = Reservation::where("code","=", $query)->firstOrFail();

        return response()->json($discount);
    }
}
