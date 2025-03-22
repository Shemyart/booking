<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $message = new MailMessage();
        $message->subject("Your booking");
        if(!empty($this->booking->deleted_at)){
            $message->line("Your booking of resource '{$this->booking->resource->name}' successfully deleted.");
        }else{
            $message->line("Your booking of resource '{$this->booking->resource->name}' successfully created.");
        }
        return $message->line("Date: {$this->booking->start_time} - {$this->booking->end_time}");
    }
}
