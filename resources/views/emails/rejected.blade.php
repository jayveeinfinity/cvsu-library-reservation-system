<!DOCTYPE html>
<html>
<head>
    <title>Reservation Confirmation</title>
</head>
<body>
    @php
        $reservation = $details['reservation'];
        $reservation_date = Carbon\Carbon::parse($reservation->reservation_date);
        $start_time = Carbon\Carbon::createFromTimestamp(strtotime(today()->format('Y-m-d') . $reservation->start_time));
        $end_time = Carbon\Carbon::createFromTimestamp(strtotime(today()->format('Y-m-d') . $reservation->end_time));
        $duration = $end_time->diff($start_time);
        $created_at = Carbon\Carbon::parse($reservation->created_at);
    @endphp
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
    <h4 style="padding: 0; margin: 0;">Learning space: {{ $reservation->learningSpace->name }}</h4>
    <h4 style="padding: 0; margin: 0;">Date: {{ $reservation_date->format('F d, Y') }} ({{$reservation_date->format('l')}})</h4>
    <h4 style="padding: 0; margin-top: 0;">Schedule: {{ Carbon\Carbon::parse($reservation->start_time)->format('h:i A') }} - {{ Carbon\Carbon::parse($reservation->end_time)->format('h:i A') }} ({{ $duration->format('%h') }} hours)</h4>
    <p>Reason: <b>{{ $reservation->reason }}</b></p>
    <p>Thank you!</p>
</body>
</html>