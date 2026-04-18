<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;
use App\Models\Inquiry;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::where('email', 'satonao@kredo.com')->first();

        $inquiry = Inquiry::first();

        if ($user) {

            Notification::create([
                'recipient_type'     => get_class($user), // App\Models\User
                'recipient_id'       => $user->id,
                'title'              => 'Welcome to TableTrip!',
                'message'            => 'We are glad to have you here. Explore our meal kits!',
                'target_type'        => null,
                'target_id'          => null,
                'is_action_required' => false,
                'is_completed'       => false,
            ]);

            if ($inquiry) {
                Notification::create([
                    'recipient_type'     => get_class($user),
                    'recipient_id'       => $user->id,
                    'title'              => 'New Reply on Your Inquiry',
                    'message'            => 'Admin has replied to your message regarding: ' . $inquiry->subject,
                    'target_type'        => get_class($inquiry), // App\Models\Inquiry
                    'target_id'          => $inquiry->id,
                    'is_action_required' => true,  
                    'is_completed'       => false, 
                ]);
            }

            Notification::create([
                'recipient_type'     => get_class($user),
                'recipient_id'       => $user->id,
                'title'              => 'Profile Updated',
                'message'            => 'Your profile information has been successfully updated.',
                'target_type'        => null,
                'target_id'          => null,
                'is_action_required' => false,
                'is_completed'       => true, 
            ]);
        }
    }
}