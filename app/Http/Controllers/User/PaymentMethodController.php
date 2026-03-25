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
        return view('user.paymentmethod.index',compact('methods'));
    }

    // register
   public function store(Request $request)
{
    dd($request->all());
    $request->validate([
        'card_number' => 'required|numeric|digits_between:14,16',
        'exp_month'   => 'required',
        'exp_year'    => 'required',
        'cvc'         => 'required|digits_between:3,4',
        'holder_name' => 'required|string|max:50',
    ]);

   
    $last4 = substr($request->card_number, -4); 
    $token = 'tok_test_' . uniqid(); 
    
    
    $brand = 'Visa'; 
    if (str_starts_with($request->card_number, '5')) { $brand = 'Mastercard'; }
    if (str_starts_with($request->card_number, '3')) { $brand = 'JCB'; }

    
    $isFirstCard = !PaymentMethod::where('user_id', Auth::id())->exists();

   
    PaymentMethod::create([
        'user_id'       => Auth::id(),
        'gateway_token' => $token, 
        'brand'         => $brand, 
        'last4'         => $last4, 
        'exp_month'     => $request->exp_month,
        'exp_year'      => $request->exp_year,
        'is_default'    => $isFirstCard,
    ]);

    return redirect()->route('user.payment_method.index')->with('success', 'Your payment has been registered!!');
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
