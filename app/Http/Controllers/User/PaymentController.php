<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;

class PaymentController extends Controller
{
    // illutlate all cards Database
    public function index(){
        $cards = Auth::user()->cards; 
        return view('payment.index', compact('cards'));
    }
    // create use
    public function create(){
        return view('payment.create');
    }

    // store card
    public function store(Request $request){
        $request->validate([
            'card_number'=>'required|digits:16',
            'card_name'  =>'required|string',
            'expiry_date'=>'required|date_format:m/y',
            'security_code'=>'required|digits:3',           
        ]);
        Auth::user()->cards()->create($request->all());
        return redirect()->route('payments.index')->with('success', 'Your payment has been registered successfully!');
    }
    // delete card
    public function destroy(Card $card){
        if($card->user_id===Auth::id()){
            $card->delete();
        }
        return redirect()->route('payment.index')->with('success','Your payment has been deleted successfully!');
    }
}
