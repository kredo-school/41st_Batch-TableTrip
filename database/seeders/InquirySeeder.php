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
            // User ↔ Restaurant
            $restaurantThreadId = (string) Str::uuid();

            Inquiry::create([
                'thread_id'      => $restaurantThreadId,
                'sender_id'      => $users->get(1)->id,
                'sender_type'    => 'user',
                'recipient_id'   => $restaurant->id,
                'recipient_type' => 'restaurant',
                'subject'        => 'Question from ' . $user->first_name,
                'message'        => 'Hello, I have a question about my reservation.',
                'status'         => 'pending',
            ]);

            Inquiry::create([
                'thread_id'      => $restaurantThreadId,
                'sender_id'      => $restaurant->id,
                'sender_type'    => 'restaurant',
                'recipient_id'   => $users->get(1)->id,
                'recipient_type' => 'user',
                'subject'        => 'Re: Question',
                'message'        => 'Thank you for your inquiry. How can we help you?',
                'status'         => 'replied',
            ]);

            // User ↔ Admin
            $adminThreadId = (string) Str::uuid();

            Inquiry::create([
                'thread_id'      => $adminThreadId,
                'sender_id'      => $user->id,
                'sender_type'    => 'user',
                'recipient_id'   => 1,
                'recipient_type' => 'admin',
                'subject'        => 'Order Issue',
                'message'        => 'Where is my order?',
                'status'         => 'pending',
            ]);

            Inquiry::create([
                'thread_id'      => $adminThreadId,
                'sender_id'      => 1,
                'sender_type'    => 'admin',
                'recipient_id'   => $user->id,
                'recipient_type' => 'user',
                'subject'        => 'Re: Order Issue',
                'message'        => 'Your order is being prepared.',
                'status'         => 'replied',
            ]);

            $topics = [
                ['Reservation Question', 'Can I change my reservation time?', 'pending'],
                ['Order Delivery', 'When will my order arrive?', 'replied'],
                ['Complaint', 'The food quality was terrible.', 'flagged'],
                ['Refund Request', 'I want a refund.', 'pending'],
                ['Account Issue', 'I cannot log in.', 'pending'],
            ];

            foreach ($topics as $topic) {
                $threadId = (string) Str::uuid();

                Inquiry::create([
                    'thread_id'      => $threadId,
                    'sender_id'      => $user->id,
                    'sender_type'    => 'user',
                    'recipient_id'   => 1,
                    'recipient_type' => 'admin',
                    'subject'        => $topic[0],
                    'message'        => $topic[1],
                    'status'         => $topic[2],
                ]);

                if ($topic[2] === 'replied') {
                    Inquiry::create([
                        'thread_id'      => $threadId,
                        'sender_id'      => 1,
                        'sender_type'    => 'admin',
                        'recipient_id'   => $user->id,
                        'recipient_type' => 'user',
                        'subject'        => 'Re: ' . $topic[0],
                        'message'        => 'Thank you for your inquiry.',
                        'status'         => 'replied',
                    ]);
                }
            }
        }

        // 追加で別件のadmin問い合わせ
        if ($users->count() >= 2) {
            $threadId2 = (string) Str::uuid();

            Inquiry::create([
                'thread_id'      => $threadId2,
                'sender_id'      => $users[1]->id,
                'sender_type'    => 'user',
                'recipient_id'   => 1,
                'recipient_type' => 'admin',
                'subject'        => 'Refund Request',
                'message'        => 'I want a refund.',
                'status'         => 'pending',
            ]);
        }
    }
}