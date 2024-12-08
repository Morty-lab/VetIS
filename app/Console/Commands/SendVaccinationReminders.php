<?php

namespace App\Console\Commands;

use App\Mail\AppointmentSet;
use App\Mail\VaccinationReminder;
use App\Models\Pets;
use App\Models\Vaccination;
use App\Models\Pet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendVaccinationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vaccinations:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders for vaccinations scheduled tomorrow';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $tomorrow = Carbon::now()->addDay()->format('Y-m-d');

            // Get all vaccinations scheduled for tomorrow
            $vaccinations = Vaccination::where('status', 0)
                ->whereDate('next_vaccine_date', $tomorrow)
                ->get();

            $this->info('Found ' . $vaccinations->count() . ' vaccinations scheduled for tomorrow.');

            foreach ($vaccinations as $vaccination) {
                $pet = Pets::find($vaccination->pet_id);

                if (!$pet) {
                    $this->error("No pet found for vaccination ID: {$vaccination->id}");
                    continue;
                }

                $owner = User::find($pet->owner_ID);

                if (!$owner || !$owner->email) {
                    $this->error("No owner or email found for pet ID: {$pet->id}");
                    continue;
                }

                $date = Carbon::parse($vaccination->next_vaccine_date)->format('l, F j, Y');
                $vaccineType = ucfirst($vaccination->vaccine_type);

                $data = [
                    'subject' => 'Vaccination Reminder',
                    'content' => "Dear {$owner->name},\n\n" .
                        "This is a friendly reminder about your pet's upcoming vaccination appointment. " .
                        "The vaccine type is: {$vaccineType}, scheduled for {$date}.\n\n" .
                        "Please contact us if you have any questions or need to reschedule.\n\n" .
                        "Thank you for keeping your pet healthy!",
                    'status' => 'Scheduled'
                ];

                $this->info("Sending reminder to {$owner->name} ({$owner->email}) for vaccination ID: {$vaccination->id}");

                try {
                    Mail::to($owner->email)->send(new AppointmentSet($data));
                    $this->info("Email sent to {$owner->email}");
                } catch (\Exception $e) {
                    $this->error("Failed to send email to {$owner->email}: " . $e->getMessage());
                }
            }

            $this->info("Vaccination reminders have been sent successfully.");
        } catch (\Exception $e) {
            $this->error("Error sending vaccination reminders: " . $e->getMessage());
        }
    }
}
