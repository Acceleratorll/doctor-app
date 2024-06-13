<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\ReservationReminder;

class SendReservationReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send reservation reminders for today\'s appointments';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = now()->toDateString();

        $usersWithReservationsToday = User::whereHas('patient', function ($query) use ($today) {
            $query->whereHas('reservations', function ($query) use ($today) {
                $query->whereHas('schedule', function ($query) use ($today) {
                    $query->where('schedule_date', $today);
                });
            });
        })->get();

        foreach ($usersWithReservationsToday as $user) {
            $reservationsToday = $user->patient->reservations()->whereHas('schedule', function ($query) use ($today) {
                $query->where('schedule_date', $today);
            })->first();

            Notification::send($user, new ReservationReminder($reservationsToday));
            $user->notify(new ReservationReminder($reservationsToday));
        }

        $this->info('Reservation reminders sent successfully!');
    }
}