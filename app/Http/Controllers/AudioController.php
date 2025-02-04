<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use getID3;
class AudioController extends Controller
{
    public function getAudioDuration(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'audio_file' => 'required|file|mimes:mp3,wav,ogg' // Adjust the mime types as needed
        ]);

        // Store the uploaded file temporarily
        $path = $request->file('audio_file')->store('audio');

        // Initialize getID3
        $getID3 = new getID3;
        
        // Analyze the audio file
        //$fileInfo = $getID3->analyze(storage_path('app/' . $path));
        $fileInfo = $getID3->analyze($request->input('file_path'));
        print_r($fileInfo);
        
        // Check if the duration is available
        if (isset($fileInfo['playtime_string'])) {
            $duration = $fileInfo['playtime_string']; // e.g., "00:03:45"
        //    return response()->json(['duration' => $duration]);
        } else {
          //  return response()->json(['error' => 'Duration not found.'], 404);
        }
    }

    

}
