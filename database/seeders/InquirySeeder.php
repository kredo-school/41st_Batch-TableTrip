<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\Restaurant; 
use Illuminate\Support\Str;

class InquirySeeder extends Seeder
{
    public function run(): void
    {

        $users = User::all();
        $restaurant = Restaurant::first() ?? Restaurant::factory()->create();

        if ($users->isEmpty()) {
            $users = collect([User::factory()->create()]);
        }

        foreach ($users as $user) {
            $threadId = (string) Str::uuid();

            Inquiry::create([
                'thread_id'      => $threadId,
                'sender_id'      => $user->id,
                'sender_type'    => get_class($user), 
                'recipient_id'   => $restaurant->id,
                'recipient_type' => get_class($restaurant), 
                'subject'        => 'Question from ' . $user->first_name,
                'message'        => 'Hello, I have a question about my reservation.',
                'status'         => 'open',
            ]);

            Inquiry::create([
                'thread_id'      => $threadId,
                'sender_id'      => $restaurant->id,
                'sender_type'    => get_class($restaurant),
                'recipient_id'   => $user->id,
                'recipient_type' => get_class($user),
                'subject'        => 'Re: Question',
                'message'        => 'Thank you for your inquiry. How can we help you?',
                'status'         => 'replied',
            ]);
        }
    }
}