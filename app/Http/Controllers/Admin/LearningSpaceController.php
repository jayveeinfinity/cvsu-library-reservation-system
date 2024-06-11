<?php

namespace App\Http\Controllers\Admin;

use App\Models\Amenity;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LearningSpace;
use App\Http\Controllers\Controller;
use App\Models\LearningSpaceAmenity;

class LearningSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $learningSpaces = LearningSpace::all();

        return view('admin.learningspaces.index', compact('learningSpaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $learningSpace = NULL;
        $amenities = Amenity::all();

        return view('admin.learningspaces.create', compact('learningSpace', 'amenities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $learningSpace = new LearningSpace();
        $learningSpace->name = $request->name;
        $learningSpace->slug = Str::slug($request->name);
        $learningSpace->location = $request->location;
        $learningSpace->description = $request->description;
        $learningSpace->min_capacity = $request->min_capacity;
        $learningSpace->max_capacity = $request->max_capacity;
        $learningSpace->save();

        $id = $learningSpace->id;

        if($id) {
            $amenities = explode(',', $request->amenities);

            foreach($amenities as $amenity) {
                $learningSpaceAmenity = new LearningSpaceAmenity();
                $learningSpaceAmenity->learning_space_id = $id;
                $learningSpaceAmenity->amenity_id  = $amenity;
                $learningSpaceAmenity->save();
            }

            return response()->json([
                'icon' => 'success',
                'title' => 'Saved!',
                'message' => 'Successfully created new learning space.'
            ]);
        }

        return response()->json([
            'icon' => 'error',
            'title' => 'Oopsss!',
            'message' => 'An error has occured!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $learningSpace = LearningSpace::where('id', $id)->firstOrFail();

        return view('admin.learningspaces.create', compact('learningSpace'));
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

    public function setAsCover(Request $request) {
        $id = $request->id;
        $learningSpaceId = $request->learningspaceid;

        $learningSpace = LearningSpace::where('id', $learningSpaceId)->firstOrFail();
        
        if($learningSpace) {
            $learningSpace->update([
                'cover_image_id' => $id
            ]);

            return response()->json([
                'icon' => 'success',
                'title' => 'Saved!',
                'message' => 'Successfully set as new cover!'
            ]);
        }

        return response()->json([
            'icon' => 'error',
            'title' => 'Oopsss!',
            'message' => 'An error has occured!'
        ]);
    }
}
