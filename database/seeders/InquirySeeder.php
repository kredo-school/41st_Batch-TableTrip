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
        $users = User::where('is_admin', false)->get();
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
                'sender_type'    => get_class($restaurant),
                'recipient_id'   => $users->get(1)->id,
                'recipient_type' => 'user',
                'subject'        => 'Re: Question',
                'message'        => 'Thank you for your inquiry. How can we help you?',
                'status'         => 'replied',
            ]);

           // User ↔ Admin
            $topics = [
                ['Order Issue', 'Where is my order?'],
                ['Reservation', 'Can I change my reservation time?'],
                ['Delivery Delay', 'The delivery was late.'],
                ['Wrong Item', 'I received the wrong item.'],
                ['Refund Request', 'I want a refund.'],
                ['Payment Error', 'My payment failed.'],
                ['Positive Feedback', 'The food was amazing!'],
                ['Cancel Order', 'I want to cancel my order.'],
                ['Address Change', 'Can I change my delivery address?'],
                ['Account Issue', 'I cannot log in.'],
                ['Coupon Issue', 'My coupon is not working.'],
                ['Shipping Cost', 'Why is shipping so expensive?'],
                ['Order Confirmation', 'I didn’t receive a confirmation email.'],
                ['Late Response', 'No one has replied to my inquiry.'],
                ['Menu Question', 'Do you have vegetarian options?'],
            ];

            $replies = [
                'We are checking your request.',
                'Thank you, we will get back to you shortly.',
                'Your issue has been resolved.',
                'Please allow some more time.',
            ];

            $count = rand(1, 3);

            for ($i = 0; $i < $count; $i++) {
                $threadId = (string) Str::uuid();
                $topic = $topics[array_rand($topics)];
                $status = ['open', 'replied', 'flagged'][rand(0, 2)];

                Inquiry::create([
                    'thread_id'      => $threadId,
                    'sender_id'      => $user->id,
                    'sender_type'    => 'user',
                    'recipient_id'   => 1,
                    'recipient_type' => 'admin',
                    'subject'        => $topic[0],
                    'message'        => $topic[1],
                    'status'         => $status,
                ]);

                if ($status === 'replied') {
                    Inquiry::create([
                        'thread_id'      => $threadId,
                        'sender_id'      => 1,
                        'sender_type'    => 'admin',
                        'recipient_id'   => $user->id,
                        'recipient_type' => 'user',
                        'subject'        => 'Re: ' . $topic[0],
                        'message'        => $replies[array_rand($replies)],
                        'status'         => 'replied',
                    ]);
                }
            }
        }
    }
}