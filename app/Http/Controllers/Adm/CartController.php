<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function confirm(Cart $cart){
        $cart->update([
           'status' => 'confirmed'
        ]);
        return back()->with('message', __('messages.cart_confirm'));
    }

    public function car(){
        $productsSize = Cart::where('status', 'ordered')->with(['product','user'])->get();
        return view('adm.cart',['productsSize' => $productsSize]);
    }
}
