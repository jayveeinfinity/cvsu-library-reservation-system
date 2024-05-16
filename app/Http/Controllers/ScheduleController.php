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

        // List down the possible slots during with the selected duration
        $startHour = 7; // Facility opening hour
        $endHour = 17; // Facility closing hour
        $timeSlots = [];
        for ($hour = $startHour; $hour < $endHour; $hour += $duration) {
            $timeSlots[] = [
                'start' => Carbon::createFromTime($hour, 0),
                'end' => Carbon::createFromTime($hour + $duration, 0)
            ];
        }

        // Fetch all reservations for the selected learning space on the specified date
        $reservations = Reservation::where('learning_space_id', $learningSpaceId)
            ->where('reservation_date', $reservationDate)
            ->orderBy('start_time')
            ->get();

        // Define the operational hours (e.g., 7 AM to 5 PM)
        $openingTime = Carbon::createFromTime(7, 0, 0);
        $closingTime = Carbon::createFromTime(17, 0, 0);

        // Initialize available slots array
        $availableSlots = [];

        foreach ($timeSlots as $timeSlot) {
            $slotStart = $timeSlot['start'];
            $slotEnd = $timeSlot['end'];

            $isAvailable = true;

            foreach ($reservations as $reservation) {
                $reservationStart = Carbon::parse($reservation->start_time);
                $reservationEnd = Carbon::parse($reservation->end_time);

                // Check if the time slot overlaps with the reservation
                if (
                    $slotStart->between($reservationStart, $reservationEnd) ||
                    $slotEnd->between($reservationStart, $reservationEnd) ||
                    $reservationStart->between($slotStart, $slotEnd) ||
                    $reservationEnd->between($slotStart, $slotEnd)
                ) {
                    $isAvailable = false;
                    break;
                }
            }

            if ($isAvailable) {
                $availableSlots[] = [
                    'start' => $slotStart->format('H:i'),
                    'end' => $slotEnd->format('H:i')
                ];
            }
        }

        return response()->json($availableSlots);
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
