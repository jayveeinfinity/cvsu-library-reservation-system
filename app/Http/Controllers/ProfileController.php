<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->id ?? NULL;
        $myReservation = NULL;
        $pastReservation = NULL;
        $controlNumber = NULL;

        if($userId) {
            $myReservation = Reservation::where('user_id', $userId)
                ->where('reservation_date', '>=', today()->format('Y-m-d'))
                ->where('status', '<>', 'rejected')
                ->first();

                
            $pastReservation = Reservation::where('user_id', $userId)
                ->where('reservation_date', '>', today()->format('Y-m-d'))
                ->orderBy('reservation_date')
                ->take(10)
                ->get();

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

                // $controlNumber = $this->generateControlNumber($code, $myReservation->reservation_date, $myReservation->start_time, $myReservation->end_time, 2);
            }
        }
        return view('pages.profile', compact('myReservation', 'pastReservation', 'controlNumber'));
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
