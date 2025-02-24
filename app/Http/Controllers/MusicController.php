<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateMusicRequest;



class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $musics = Music::all();

        return view('index', ["musics"=>$musics]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(Request $request)
    {
        // dd($request);
        // Validate the form inputs
        $validatedform = $request->validate([
            "title" => 'required',
            'album' => 'required',
            'artist' => 'required',
            'category' => 'required',
            'cost' => 'required',
            'track_path' => 'required|file|mimes:mp3,wav|max:15000',
            'coverphoto_url' => 'required|file|mimes:jpeg,png,jpg|max:5120', // Max size: 5MB
            
        ]);

       
    
        // Handle track_path upload
        if ($request->hasFile('track_path')) {
            $trackFile = $request->file('track_path');
            $trackFileName = Str::uuid() . '_' . $trackFile->getClientOriginalName();
            $trackPath = $trackFile->storeAs('tracks', $trackFileName, 'public');
        }
    
        // Handle coverphoto_url upload
        if ($request->hasFile('coverphoto_url')) {
            $coverPhotoFile = $request->file('coverphoto_url');
            $coverPhotoFileName = Str::uuid() . '_' . $coverPhotoFile->getClientOriginalName();
            $coverPhotoPath = $coverPhotoFile->storeAs('cover_photos', $coverPhotoFileName, 'public');
        }


    
        Music::create([
            'title' => $validatedform['title'],
            'album' => $validatedform['album'],
            'artist' => $validatedform['artist'],
            'category' => $validatedform['category'],
            'cost' => $validatedform['cost'],
            'track_path' => $trackPath,
            'coverphoto_url' => $coverPhotoPath,
        ]);
    
        return back()->with('success', 'Music uploaded successfully!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMusicRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Music $music)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Music $music)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
 
    
    public function updatemusic(Request $request,  $music)
    {
        $music = Music::find($music);
        $validated = $request->validate([
            "title" => 'required',
            'album' => 'required',
            'artist' => 'required',
            'category' => 'required',
            'cost' => 'required',
            // 'track_path' => 'sometimes|mimes:mp3,wav|max:15000',
            // 'coverphoto_url' => 'sometimes|mimes:jpeg,png,jpg|max:5120', // Max size: 5MB
        ]);
        
    
        // Handle track_path upload
        if ($request->hasFile('track_path')) {

            // Delete the previous track file if it exists
            if ($music->track_path && Storage::disk('public')->exists($music->track_path)) {
                Storage::disk('public')->delete($music->track_path);
            }
    
            // Store the new track file
            $trackFile = $request->file('track_path');
            $trackFileName = Str::uuid() . '_' . $trackFile->getClientOriginalName();
            $trackPath = $trackFile->storeAs('tracks', $trackFileName, 'public');
    
            // Update the track_path in the database
            $music->track_path = $trackPath;   
           
        }
        if(!$request->hasFile('track_path')){
                $music->track_path= $music->track_path;
        }
    
        // Handle coverphoto_url upload
        if ($request->hasFile('coverphoto_url')) {
            // Delete the previous cover photo file if it exists
            if ($music->coverphoto_url && Storage::disk('public')->exists($music->coverphoto_url)) {
                Storage::disk('public')->delete($music->coverphoto_url);
            }
    
            // Store the new cover photo file
            $coverPhotoFile = $request->file('coverphoto_url');
            $coverPhotoFileName = Str::uuid() . '_' . $coverPhotoFile->getClientOriginalName();
            $coverPhotoPath = $coverPhotoFile->storeAs('cover_photos', $coverPhotoFileName, 'public');
    
            // Update the coverphoto_url in the database
            $music->coverphoto_url = $coverPhotoPath;
        }
        if(!$request->hasFile('coverphoto_url')){
            $music->coverphoto_url = $music->coverphoto_url;
        }
    
        // Update other fields in the database
        $music->title = $validated['title'];
        $music->album = $validated['album'];
        $music->artist = $validated['artist'];
        $music->category = $validated['category'];
        $music->cost = $validated['cost'];
            
        // Save the updated model
        $music->save();
    
        return redirect()->route('admins.dashboard')->with('success', 'Music Updated successfully');
    }
    

    public function updatemusicform($id){
        $music = Music::find($id);
        return view('musics.updatemusic', ["music"=>$music]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $music = Music::find($id);
       if ($music){
        $music->delete();

        return redirect()->back()->with('success', 'Music Deleted successfully');
       }

        return redirect()->back()->with('error', 'Music not found');
    }


    public function downloadmusic($id)
    {
        // dd($track_path); 
        $music = Music::findOrFail($id);

        
        $filePath = $music->track_path;

    
        // if (!$filePath)
        // {
        //     return back()->witherrors([
        //         'music_unavailable' => 'Music not found'
        //     ]);
        // }

    
        // $fileName = $music->title . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
        // Storage::disk('public')->download($filePath, $fileName);

        $file = public_path('storage/' . $filePath);
        // dd($file);
        
        return response()->download($file, 'music' . 'mp3');

    }
}

