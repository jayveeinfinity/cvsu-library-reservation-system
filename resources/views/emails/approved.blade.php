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
        $created_at = Carbon\Carbon::parse($reservation->created_at);
    @endphp
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
    <h6>Learning space: {{ $reservation->learningSpace->name }}</h6>
    <h6>Date: {{ $reservation_date }}</h6>
    <h6>Schedule: {{ $start_time }} - {{ $end_time }}</h6>
    <p>Thank you!</p>
</body>
</html>