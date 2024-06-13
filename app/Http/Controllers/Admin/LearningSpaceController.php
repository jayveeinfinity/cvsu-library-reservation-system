<?php

namespace App\Http\Controllers\Admin;

use App\Models\Amenity;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LearningSpace;
use App\Http\Controllers\Controller;
use App\Models\LearningSpaceAmenity;
use Illuminate\Support\Facades\Route;

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
        $myAmenities = NULL;

        return view('admin.learningspaces.create', compact('learningSpace', 'amenities', 'myAmenities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->id) {
            $learningSpace = LearningSpace::where('id', $request->id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'location' => $request->location,
                'description' => $request->description,
                'min_capacity' => $request->min_capacity,
                'max_capacity' => $request->max_capacity
            ]);
            $id = $request->id;
        } else {
            $learningSpace = new LearningSpace();
            $learningSpace->name = $request->name;
            $learningSpace->slug = Str::slug($request->name);
            $learningSpace->location = $request->location;
            $learningSpace->description = $request->description;
            $learningSpace->min_capacity = $request->min_capacity;
            $learningSpace->max_capacity = $request->max_capacity;
            $learningSpace->save();
            $id = $learningSpace->id;
        }

        if($id) {
            $amenities = explode(',', $request->amenities);

            $learningSpaceAmenity = LearningSpaceAmenity::where('learning_space_id', $id)->delete();

            foreach($amenities as $amenity) {
                $learningSpaceAmenity = new LearningSpaceAmenity();
                $learningSpaceAmenity->learning_space_id = $id;
                $learningSpaceAmenity->amenity_id  = $amenity;
                $learningSpaceAmenity->save();
            }
            
            return response()->json([
                'icon' => 'success',
                'title' => 'Saved!',
                'message' => (empty($request->id) ? 'Successfully created new learning space.' : 'Successfully updated learning space.')
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
        $amenities = Amenity::all();
        
        $myAmenities = LearningSpaceAmenity::where('learning_space_id', $id)->get();

        return view('admin.learningspaces.create', compact('learningSpace', 'amenities', 'myAmenities'));
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
