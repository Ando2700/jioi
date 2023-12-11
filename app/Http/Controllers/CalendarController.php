<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\Pays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discipline = DB::table('disciplines')->get();
        $calendar = DB::table('v_calendrier')->get();
        return view('guest.calendar.index', compact('calendar', 'discipline'));
    }

    public function filterCalendar(Request $request)
    {
        // METY AVEC "ET"
        $discipline = Discipline::all();
        $rule = $request->input('discipline');
        $date = $request->input('date');
        $query = DB::table('v_calendrier');

        if ($rule) {
            $query->where('nom', $rule);
        }

        if ($date) {
            $dateOnly = date('Y-m-d', strtotime($date));
            $query->whereDate('date', $dateOnly);
        }

        $calendar = $query->get();
        return view('guest.calendar.index', compact('calendar', 'discipline'));

        // ET
        // $discipline = Discipline::all();
        // $rule = $request->input('discipline');
        // $date = $request->input('date');
        // $dateOnly = date('Y-m-d', strtotime($date));

        // $calendar = DB::table('v_calendrier')
        //     ->where('nom', $rule)
        //     ->whereDate('date', $dateOnly)
        //     ->get();
        // return view('guest.calendar.index', compact('calendar', 'discipline'));


        // OU
        // $discipline = Discipline::all();
        // $rule = $request->input('discipline');
        // $date = $request->input('date');

        // $dateOnly = date('Y-m-d', strtotime($date));

        // $query = DB::table('v_calendrier');

        // if ($rule) {
        //     $query->where('nom', $rule);
        // }

        // if ($date) {
        //     $query->whereDate('date', $dateOnly);
        // }

        // $calendar = $query->get();

        // return view('guest.calendar.index',compact('calendar', 'discipline'));


        // EO EO IHANY
        // $discipline = Discipline::all();

        // $rule = $request->discipline;
        // $date = $request->date;

        // $calendar = DB::table('v_calendrier')
        // ->select('*')
        // ->where('nom', '=', $rule)
        // ->get();

        // $dateOnly = date('Y-m-d', strtotime($date));
        // $calendar = DB::table('v_calendrier')
        //         ->whereDate('date', $dateOnly)
        //         ->get();        

        return view('guest.calendar.index', compact(
            'calendar',
            'discipline',
        ));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
