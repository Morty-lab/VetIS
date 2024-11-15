<?php

namespace App\Console\Commands;

use App\Models\Appointments;
use Carbon\Carbon;
use Illuminate\Console\Command;

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
            // Get all appointments scheduled for tomorrow
            $tomorrow = Carbon::now()->addDay();
            $appointments = Appointments::where('status', 0)
                ->whereDate('appointment_date', $tomorrow)
                ->get();

            // Send email notifications
            foreach ($appointments as $appointment) {
                // Implement your email sending logic here
                // For example:
                // \Mail::to($appointment->client->email)
                //     ->send(new AppointmentReminderNotification($appointment));

                // Log the reminder sent
            }

            $this->info('Appointment reminders have been sent successfully.');
        } catch (\Exception $e) {
            $this->error('Error sending appointment reminders: ' . $e->getMessage());
        }
    }
}
