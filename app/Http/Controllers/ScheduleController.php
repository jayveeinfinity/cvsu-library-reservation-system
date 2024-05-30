<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\LearningSpace;
use App\Http\Controllers\APIController;

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
        $learningSpaces = LearningSpace::all();
        $userId = auth()->user()->id ?? NULL;
        $myReservation = NULL;
        $controlNumber = NULL;

        if($userId) {
            $myReservation = Reservation::where('user_id', $userId)
                ->where('reservation_date', '>=', today()->format('Y-m-d'))
                ->first();

            if($myReservation) {
                $code = NULL;
                switch($myReservation->learningSpace->slug) {
                    case "collaboration-room":
                        $code = "CLB";
                        break;
                    case "learning-commons-1":
                        $code = "LC1";
                        break;
                    case "learning-commons-2":
                        $code = "LC2";
                        break;
                    case "learning-commons-3":
                        $code = "LC3";
                        break;
                }

                $controlNumber = $this->generateControlNumber($code, $myReservation->reservation_date, $myReservation->start_time, $myReservation->end_time, 2);
            }
        }

        $patronData = [];

        if(auth()->user()) {
            $apiController = new APIController();
            $data = $apiController->request('GET', 'http://library.cvsu.edu.ph/sandbox/laravel/api/patrons/' . auth()->user()->email);

            if(array_key_exists('data', $data)) {
                $patronData = $data['data'];
            } else if (array_key_exists('error', $data)) {
                $patronData = $data['error'];
            }
        }
        
        return view('landing.schedules', compact(
            'learningSpaces',
            'facility',
            'myReservation',
            'controlNumber',
            'patronData'
        ));
    }

    public function generateControlNumber($learningSpaceCode, $reservationDate, $startTime, $endTime, $duration) {
        // Format the reservation date
        $formattedDate = date('Ymd', strtotime($reservationDate));
    
        // Ensure start time and end time are in HH format
        $formattedStartTime = str_pad(Carbon::parse($startTime)->format('H'), 2, '0', STR_PAD_LEFT);
        $formattedEndTime = str_pad(Carbon::parse($endTime)->format('H'), 2, '0', STR_PAD_LEFT);
    
        // Concatenate the components to form the control number
        $controlNumber = $learningSpaceCode . '-' . $formattedDate . '-' . $formattedStartTime . '-' . $formattedEndTime . '-' . $duration;
    
        return $controlNumber;
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
        // dd($request);
        // exit;

        // $validatedData = $request->validate([
        //     'purpose' => 'nullable|string|max:255',
        //     'no_of_guests' => 'nullable|integer',
        //     'activity_description' => 'nullable|string',
        //     // Other validation rules
        // ]);
    
        try {
            $reservation = Reservation::create([
                'user_id' => auth()->user()->id,
                'learning_space_id' => $request->learning_space_id,
                'reservation_date' => $request->reservation_date,
                'start_time' => Carbon::parse($request->start_time)->format('H:i:s'),
                'end_time' => Carbon::parse($request->end_time)->format('H:i:s'),
                'duration' => $request->duration,
                'status' => 'Pending',
                'purpose' => $request->purpose,
                'no_of_guests' => $request->no_of_guests,
                'activity_description' => $request->activity_description
            ]);
    
            return response()->json(['success' => 'Reservation created successfully.']);
        } catch (\Exception $e) {
            // return response()->json(['error' => 'An error occurred. Please try again.'], 500);
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
}
