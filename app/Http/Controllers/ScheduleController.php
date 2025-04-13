<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('slot')) {
            $slot = $request->input('slot');
            
            // Store slot in the database
            Schedule::updateOrCreate(['key' => 'delivery_slots'], ['value' => $slot]);
            
            
            return back()->with('message', 'Delivery slots updated successfully.');
        }
        
        return view('schedule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'slot' => 'required|integer|min:1',
        ]);

        // Retrieve the input
        $slot = $request->input('slot');

        // Store the slot value in the database
        Schedule::updateOrCreate(
            ['key' => 'delivery_slots'],
            ['value' => $slot]
        );

        // Redirect back with a success message
        return redirect()->route('schedule.index')->with('message', 'Delivery slots updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
