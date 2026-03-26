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
   
    $cardNumber = str_replace(' ', '', $request->card_number);

    $request->merge([
        'card_number' => $cardNumber
    ]);

    $request->validate([
        'card_number' => 'required|digits_between:14,16',
        'exp_month'   => 'required',
        'exp_year'    => 'required',
        'holder_name' => 'required|string|max:50',
    ]);

    $last4 = substr($cardNumber, -4);
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
   public function destroy(PaymentMethod $payment_method) 
    {
        if ($payment_method->user_id === Auth::id()) {
            $payment_method->delete();
        }
        return back()->with('success', 'Your card has been  deleted successfully.');
    }

    // update
   public function update(Request $request, PaymentMethod $payment_method) 
        {

            if ($payment_method->user_id !== Auth::id()) {
                abort(403);
            }

            $request->validate([
                'exp_month' => 'required',
                'exp_year'  => 'required',
            ]);

            
            $payment_method->update([
                'exp_month' => $request->exp_month,
                'exp_year'  => $request->exp_year,
            ]);

            return back()->with('success', 'Your card has been updated successfully.');
        }
    }

