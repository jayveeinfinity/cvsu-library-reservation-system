<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Mail\StatusApprovedEmail;
use App\Mail\StatusRejectedEmail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmailApproved($recipient, Reservation $reservation)
    {
        $details = [
            'title' => 'Reservation confirmed!',
            'body' => 'Your reservation has been approved.',
            'reservation' => $reservation
        ];

        Mail::to($recipient)->send(new StatusApprovedEmail($details));

        return 'Email sent successfully';
    }

    public function sendEmailRejected($recipient, Reservation $reservation)
    {
        $details = [
            'title' => 'Reservation rejected!',
            'body' => 'Your reservation has been rejected.',
            'reservation' => $reservation
        ];

        Mail::to($recipient)->send(new StatusRejectedEmail($details));

        return 'Email sent successfully';
    }
}
