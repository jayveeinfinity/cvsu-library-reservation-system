<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    public function index() {
        $amenities = Amenity::all();
        $amenitiesCount = Amenity::count();

        return view('admin.amenities.index', compact('amenities', 'amenitiesCount'));
    }

    public function create() {
        return view('admin.amenities.create');
    }

    public function store(Request $request) {
        $amenity = Amenity::where('name', $request->name)->first();

        if(!$amenity) {
            Amenity::create([
                'name' => $request->name,
                'icon' => $request->icon,
            ]);

            return response()->json([
                'icon' => 'success',
                'title' => 'Saved!',
                'message' => 'Successfully created an amenity!'
            ]);
        }

        return response()->json([
            'icon' => 'info',
            'title' => 'Duplicate entry!',
            'message' => 'It seems like you have a duplicate entry.'
        ]);
    }
}
