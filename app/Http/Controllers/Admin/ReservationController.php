<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reservation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->status ?? '';
        $date_type = $request->date_type ?? '';
        $selectedDate = today();

        // Build the query
        $query = Reservation::query();

        // Apply status filter if provided
        if ($status) {
            $query->where('status', $status);
        }

        // Apply date range filter if provided
        if ($date_type == 'Today') {
            $query->where('reservation_date', $selectedDate);
        } elseif ($date_type == 'Recent') {
            $query->where('reservation_date', '<', $selectedDate);
        }

        if($status == 'Pending') {
            $query->where('status', 'pending');
        }

        // Execute the query and get the results
        $reservations = $query
            ->orderBy('reservation_date')
            ->orderBy('start_time')
            ->get();

        // $reservations = Reservation::where('reservation_date', $selectedDate)
        //     ->get();

        return view('admin.reservations.index', compact('reservations', 'date_type', 'status'));
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

    public function approve($id) {
        $reservation = Reservation::findOrFail($id);

        $reservation->update([
            'status' => "confirmed",
            'processed_by' => auth()->user()->id,
        ]);

        return response()->json(['message' => 'Reservation approved successfully.']);
    }

    public function reject(Request $request, $id) {
        $reservation = Reservation::findOrFail($id);

        $reservation->update([
            'status' => "rejected",
            'processed_by' => auth()->user()->id,
            'reason' => $request->reason
        ]);

        return response()->json(['message' => 'Reservation rejected successfully.']);
    }
}
