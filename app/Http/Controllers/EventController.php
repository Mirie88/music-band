<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view('events.events', ['events' => $events]);
    }
    public function store(Request $request){
       $validatedform = $request->validate([
        "name" => "required|max:255",
        "date" => "required",
        "price" => "required",
        "location" => "required",
        "coverphoto_url" => "required|file|mimes:jpg,png,jpeg|max:10540"
       ]);

       if ($request->hasFile('coverphoto_url')) {
        $coverPhotoFile = $request->file('coverphoto_url');
        $coverPhotoFileName = Str::uuid() . '_' . $coverPhotoFile->getClientOriginalName();
        $coverPhotoPath = $coverPhotoFile->storeAs('cover_photos', $coverPhotoFileName, 'public');
        $validatedform['coverphoto_url'] = $coverPhotoPath;
    }

       Event::create($validatedform);
       return redirect()->back()->with('success', 'Event added successfully');
    }

    public function updateeventform($id){
        $event = Event::find($id);

        return view('admins.updateevent', compact('event'));
    }

    public function updateevent(Request $request, $id){
        $validatedform = $request->validate([
            "name" => "required|max:255",
            "date" => "required",
            "price" => "required",
            "location" => "required",
            // "coverphoto_url" => "required|file|mimes:jpg,png,jpeg|max:10540"
           ]);
           $event = Event::find($id);

           
        // Handle coverphoto_url upload
        if ($request->hasFile('coverphoto_url')) {
            // Delete the previous cover photo file if it exists
            if ($event->coverphoto_url && Storage::disk('public')->exists($event->coverphoto_url)) {
                Storage::disk('public')->delete($event->coverphoto_url);
            }
    
            // Store the new cover photo file
            $coverPhotoFile = $request->file('coverphoto_url');
            $coverPhotoFileName = Str::uuid() . '_' . $coverPhotoFile->getClientOriginalName();
            $coverPhotoPath = $coverPhotoFile->storeAs('cover_photos', $coverPhotoFileName, 'public');
    
            // Update the coverphoto_url in the database
            $event->coverphoto_url = $coverPhotoPath;
        }
        if(!$request->hasFile('coverphoto_url')){
            $event->coverphoto_url = $event->coverphoto_url;
        }

        $event->name = $validatedform['name'];
        $event->price = $validatedform['price'];
        $event->date = $validatedform['date'];
        $event->location = $validatedform['location'];

        $event->save();
        return redirect()->route('admins.dashboard')->with('success', 'Event Updated successfully');

    }
    public function deleteevent($id){
        $event =- Event::find($id);
        $event->delete();
        return redirect()->back()->with('success', 'Event Deleted successfully');
    }
}
