<?php

namespace App\Http\Controllers;

use App\Models\Calendrier;
use Illuminate\Http\Request;

class CalendrierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('calendrier');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $events = Calendrier::all();

        $events = $events->map(function ($e) {
            return [
                "start" => $e->start,
                "end" => $e->end,
                "color" => "#fcc102",
                "passed" => false,
                "title" => $e->user
            ];
        });

        return response()->json([
            "events" => $events
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "start" => "required",
            "end" => "required"
        ]);

        Calendrier::create([
            "start" => $request->start . ":00",
            "end" => $request->end . ":00",
            "user" => $request->user,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Calendrier $calendrier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calendrier $calendrier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calendrier $calendrier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calendrier $calendrier)
    {
        //
    }
}
