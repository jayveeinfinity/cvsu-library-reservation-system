<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facility = NULL;
        
        return view('landing.schedules', compact('facility'));
    }

    public function getAvailableSlots(Request $request) {
        $learningSpaceId = $request->learning_space_id;
        $reservationDate = $request->reservation_date;
        $duration = $request->duration; // Duration in hours

        $carbonReservationdata = Carbon::parse($reservationDate);

        // List down the possible slots during with the selected duration
        $startHour = 7; // Facility opening hour
        $endHour = 17; // Facility closing hour

        $timeSlots = [];
        
        for ($hour = $startHour; $hour < $endHour; $hour++) {
            for ($duration = 1; $duration <= 5; $duration++) {
                if ($hour + $duration <= $endHour) {
                    $timeSlots[] = [
                        'start' => Carbon::createFromTime($hour, 0)->setDate($carbonReservationdata->format('Y'), $carbonReservationdata->format('m'), $carbonReservationdata->format('d')),
                        'end' => Carbon::createFromTime($hour + $duration, 0)->setDate($carbonReservationdata->format('Y'), $carbonReservationdata->format('m'), $carbonReservationdata->format('d')),
                        'duration' => $duration,
                        'availability' => "Available"
                    ];
                }
            }
        }

        // Fetch all reservations for the selected learning space on the specified date
        $reservations = Reservation::where('learning_space_id', $learningSpaceId)
            ->where('reservation_date', $reservationDate)
            ->orderBy('start_time')
            ->get();

        $index = 0;

        foreach ($timeSlots as $timeSlot) {
            $slotStart = $timeSlot['start'];
            $slotEnd = $timeSlot['end'];
            $slotDruation = $timeSlot['duration'];
        
            $isAvailable = true;
        
            foreach ($reservations as $reservation) {
                $reservationStart = Carbon::createFromTimestamp(strtotime($reservation->reservation_date . $reservation->start_time));
                $reservationEnd = Carbon::createFromTimestamp(strtotime($reservation->reservation_date . $reservation->end_time));

                // Check if the time slot overlaps with the reservation
                if (
                    ($reservationStart->copy()->addSecond()->between($slotStart, $slotEnd)) ||
                    ($reservationEnd->copy()->subSecond()->between($slotStart, $slotEnd))
                ) {
                    $isAvailable = false;
                    break;
                }
            }

            $timeSlots[$index] = [
                'start' => $slotStart->format('g:i A'),
                'end' => $slotEnd->format('g:i A'),
                'duration' => $slotDruation,
                'availability' => $isAvailable ? "Available" : "Reserved"
            ];

            $index++;
        }

        return response()->json($timeSlots);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
