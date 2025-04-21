<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $notifications = [];

        // Bootstrap notification types
        $notificationTypes = ['info', 'success', 'warning', 'danger'];

        // Generate 20 notifications (5 per notification type)
        foreach ($notificationTypes as $notificationType) {
            for ($i = 0; $i < 5; $i++) {
                // Generate random visible_to IDs (always include ID 1, plus random others)
                $visibleToIds = [1]; // Always include 1

                // Add random number of additional IDs
                $additionalCount = $faker->numberBetween(0, 4);

                for ($j = 0; $j < $additionalCount; $j++) {
                    // Add a random ID between 2 and 30
                    $randomId = $faker->numberBetween(2, 30);

                    // Prevent duplicates
                    if (!in_array($randomId, $visibleToIds)) {
                        $visibleToIds[] = $randomId;
                    }
                }

                // Sort and convert to comma-separated string
                sort($visibleToIds);
                $visibleTo = implode(',', $visibleToIds);

                $createdAt = Carbon::now()->subDays($faker->numberBetween(0, 30))->subHours($faker->numberBetween(0, 24));

                // Generate appropriate message and link based on notification type
                $message = '';
                $link = null;

                switch ($notificationType) {
                    case 'info':
                        $message = 'System maintenance scheduled for ' . $faker->date('F d') . ' at ' . $faker->time('h:i A');
                        $link = '/admin/system-updates';
                        break;

                    case 'success':
                        $message = $faker->randomElement(['Weekly', 'Monthly', 'Daily']) . ' database backup completed successfully';
                        $link = '/admin/database';
                        break;

                    case 'warning':
                        $message = 'License expires in ' . $faker->numberBetween(10, 60) . ' days';
                        $link = '/admin/licenses';
                        break;

                    case 'danger':
                        $message = $faker->numberBetween(3, 10) . ' failed login attempts detected';
                        $link = '/admin/security';
                        break;
                }

                $notifications[] = [
                    'visible_to' => $visibleTo,
                    'notification_type' => $notificationType,
                    'message' => $message,
                    'link' => $link,
                    'read' => $faker->boolean(30), // 30% chance of being read
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt
                ];
            }
        }

        DB::table('notifications')->insert($notifications);
    }
}
