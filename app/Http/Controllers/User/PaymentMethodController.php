<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    public function index(){
        $methods =PaymentMethod::where('user_id',Auth::id())->get();
        return view('user.payment_method',compact('method'));
    }

    // register
    public function store (Request $request)
    {
        $request->validate([
            'gateway_token'=>'required',
            'brand'=>'required',
            'last4'=>'required|digits:4',
        ]);
        // already registered??
        $isFirstCard =!PaymentMethod::where('user_id',Auth::id())->exsits();    
    
        PaymentMethod::create([
            'user_id'=>Auth::id(),
            'gateway_token'=>$request->gateway_token,
            'brand'        =>$request->brand,
            'last4'        =>$request->last4,
            'exp_month'    =>$request->exp_month,
            'exp_year'     =>$request->exp_year,
            'is_default'   =>$isFirstCard,
        ]);

        return redirect()->route('user.payment_method')->with('success','Your payment has been registered!!');
    }
    // delete 
    public function destroy(PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->user_id === Auth::id()) {
            $paymentMethod->delete();
        }
        return back();
    }
}
