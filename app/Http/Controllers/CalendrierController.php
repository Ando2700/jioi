<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Calendrier;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendrierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calendrier = DB::table('v_calendrier')->paginate(10);
        $site = Site::all();
        $disciplines = Discipline::all();
        return view('other.calendrier.index', compact('calendrier', 'site', 'disciplines'));
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
        $validatedData = $request->validate([
            'date' => 'required',
            'site' => 'required|string',
            'discipline' => 'required|string',
        ]);
        $site = Site::firstOrCreate(['site' => $request->input('site')]);
        $discipline = Discipline::firstOrCreate(['nom' => $request->input('discipline')]);

        $calendrier = new Calendrier();
        $calendrier->date = $validatedData['date'];
        $calendrier->site_id = $site->id;
        $calendrier->discipline_id = $discipline->id;
        $calendrier->save();
        return redirect()->route('calendriers.index');
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
