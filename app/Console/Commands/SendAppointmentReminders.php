<?php

namespace App\Console\Commands;

use App\Mail\AppointmentSet;
use App\Models\Appointments;
use App\Models\Clients;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendAppointmentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */


    protected $signature = 'appointments:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders for appointments scheduled tomorrow';

    /**
     * Execute the console command.
     */
    public function handle()
    {



        try {
            $tomorrow = Carbon::now()->addDay()->format('Y-m-d');
            $startTime = '08:00:00';  // 8 AM
            $endTime = '17:00:00';    // 5 PM
            // Get all appointments scheduled for tomorrow
            $appointments = Appointments::where('status', 0)
                ->whereDate('appointment_date', $tomorrow)  // Ensures appointments are for tomorrow
                ->whereBetween('appointment_time', [$startTime, $endTime])  // Filters by time range (8 AM to 5 PM)
                ->get();
            $this->info('Found ' . $appointments->count() . ' appointments for tomorrow.');
            // Send email notifications
            foreach ($appointments as $appointment) {
                $user = Clients::where('id', $appointment->owner_ID)->get()->first();
                if (!$user) {
                    $this->error("No client found for appointment ID: {$appointment->id}");
                    continue;
                }

                $email = User::where('id', $user->user_id)->value('email');
                if (!$email) {
                    $this->error("No email found for user ID: {$user->id}");
                    continue;
                }

                $date = Carbon::parse($appointment->appointment_date)->format('l, F j, Y');
                $time = Carbon::parse($appointment->appointment_time)->format('g:i A');

                $data = [
                    'subject' => 'Appointment Reminder',
                    'content' => "Dear $user->client_name,\n\n" .
                        "This is a friendly reminder about your upcoming appointment scheduled for $date at $time. " .
                        "Please let us know if you have any questions or need to reschedule.\n\n" .
                        "We look forward to seeing you!\n\n" .
                        "Thank you for choosing us!",
                    'status' => 'Reminder'
                ];

                // Log the email being sent
                $this->info("Sending reminder to {$user->client_name} ({$email}) for appointment ID: {$appointment->id}");

                try {
                    Mail::to($email)->send(new AppointmentSet($data));
                    $this->info("Email sent to {$email} ");
                } catch (\Exception $e) {
                    $this->error("Failed to send email to {$email}: " . $e->getMessage());
                }
            }


            $this->info("Appointment reminders have been sent successfully. ");
        } catch (\Exception $e) {
            $this->error("Error sending appointment reminders:" . $e->getMessage());
        }
    }
}
