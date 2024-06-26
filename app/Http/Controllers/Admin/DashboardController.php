<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\LearningSpace;
use App\Http\Controllers\Controller;
use App\Models\Reservation;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservationsToday = Reservation::where('reservation_date', today());
        $reservationsPending = Reservation::where('status', 'pending');
        $reservationsRecent = Reservation::where('reservation_date', '<', today());
        
        $learningSpaceCount = LearningSpace::count();
        $usersCount = User::count();
        $reservationCount = Reservation::count();
        $rejectedReservation = Reservation::where('status', 'rejected')->count();

        return view('admin.dashboard', compact(
            'reservationsToday',
            'reservationsPending',
            'reservationsRecent',
            'usersCount',
            'learningSpaceCount',
            'reservationCount',
            'rejectedReservation'
        ));
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
