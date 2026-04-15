<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Naoya）
        PaymentMethod::create([
            'user_id' => '1',
            'brand' => 'VISA',
            'last4' => '4431',
            'exp_month' => '05',
            'exp_year' => '33',
            'gateway_token' => 'tok_visa_1', 
            'stripe_id' => 'cus_1',         
        ]);

        PaymentMethod::create([
            'user_id' => '1',
            'brand' => 'JCB',
            'last4' => '4432',
            'exp_month' => '03',
            'exp_year' => '34',
            'gateway_token' => 'tok_jcb_1',
            'stripe_id' => 'cus_1',
        ]);

        // xuan）
        PaymentMethod::create([
            'user_id' => '2',
            'brand' => 'VISA',
            'last4' => '5655',
            'exp_month' => '03',
            'exp_year' => '34',
            'gateway_token' => 'tok_visa_2',
            'stripe_id' => 'cus_2',
        ]);

        PaymentMethod::create([
            'user_id' => '2',
            'brand' => 'Mastercard',
            'last4' => '4431',
            'exp_month' => '07',
            'exp_year' => '32',
            'gateway_token' => 'tok_master_2',
            'stripe_id' => 'cus_2',
        ]);

        // （Haruto）
        PaymentMethod::create([
            'user_id' => '3',
            'brand' => 'Mastercard',
            'last4' => '4452',
            'exp_month' => '03',
            'exp_year' => '31',
            'gateway_token' => 'tok_master_3a',
            'stripe_id' => 'cus_3',
        ]);

        PaymentMethod::create([
            'user_id' => '3',
            'brand' => 'Mastercard',
            'last4' => '2595',
            'exp_month' => '06',
            'exp_year' => '33',
            'gateway_token' => 'tok_master_3b',
            'stripe_id' => 'cus_3',
        ]);
    }
}