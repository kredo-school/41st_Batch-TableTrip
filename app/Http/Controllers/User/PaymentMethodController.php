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
    $last4 = substr($cardNumber, -4);

    $exists = PaymentMethod::where('user_id', Auth::id())
                            ->where('last4', $last4)
                            ->exists();

    if ($exists) {
        return back()->withErrors(['card_number' => 'This card is already registered.'])->withInput();
    }

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

    if ($request->input('from') === 'confirm') {
        return redirect()->route('cart.confirm')->with('success', 'Your payment has been registered!!');
    }
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
            'card_number' => 'nullable|digits_between:14,16',
            'exp_month'   => 'required',
            'exp_year'    => 'required',
            'holder_name' => 'required|string|max:50',
        ]);

        $data = [
            'exp_month'   => $request->exp_month,
            'exp_year'    => $request->exp_year,
            'holder_name' => $request->holder_name,
        ];

        if ($request->filled('card_number')) {
            $cardNumber = str_replace(' ', '', $request->card_number);
            $data['last4'] = substr($cardNumber, -4);
            
            $brand = 'Visa';
            if (str_starts_with($cardNumber, '5')) { $brand = 'Mastercard'; }
            if (str_starts_with($cardNumber, '3')) { $brand = 'JCB'; }
            $data['brand'] = $brand;
        }

        $payment_method->update($data);

        if ($request->input('from') === 'confirm') {
            return redirect()->route('cart.confirm')->with('success', 'Your card has been updated successfully.');
        }

        return back()->with('success', 'Your card has been updated successfully.');
    }
    public function setDefault(PaymentMethod $payment_method)
    {
        
        if ($payment_method->user_id !== Auth::id()) {
            abort(403);
        }

        PaymentMethod::where('user_id', Auth::id())->update(['is_default' => false]);

        $payment_method->update(['is_default' => true]);

        return back()->with('success', 'Default payment method updated.');
    }
}

