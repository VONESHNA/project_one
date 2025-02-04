<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistanceController extends Controller
{
    public function calculateDistance(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'lat1' => 'required|numeric',
            'lon1' => 'required|numeric',
            'lat2' => 'required|numeric',
            'lon2' => 'required|numeric',
        ]);

        // Get the coordinates from the request
        $lat1 = deg2rad($request->input('lat1'));
        $lon1 = deg2rad($request->input('lon1'));
        $lat2 = deg2rad($request->input('lat2'));
        $lon2 = deg2rad($request->input('lon2'));

        // Haversine formula
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;

        $a = sin($dlat / 2) * sin($dlat / 2) +
             cos($lat1) * cos($lat2) *
             sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Radius of Earth in kilometers
        $R = 6371;

        // Calculate the distance
        $distance = round($R * $c);
        $unit=' kilometers';
        $r=['distance' => $distance.$unit];
        print_r($r);
       // return response()->json(['distance' => $distance.$unit]);
    }
}
