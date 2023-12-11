<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use App\Models\Genre;
use App\Models\Athlete;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AthleteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $athletes = DB::table('v_athlete')->paginate(10);
        $pays = Pays::all();
        $discipline = DB::table('disciplines')->where('type', 'individuel')->get();
        $genre = Genre::all();
        return view('admin.athlete.index', compact('athletes', 'discipline', 'pays', 'genre'));
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
            'nom' => 'required|string',
            'date_naissance' => 'required|date|before_or_equal:today',
            'longueur' => 'required|integer',
            'poids' => 'required|numeric|min:0',
            'genre' => 'required|string',
            'pays' => 'required|string',
            'discipline' => 'required|string',
        ]);
        $genre = Genre::firstOrCreate(['genre' => $request->input('genre')]);
        $pays = Pays::firstOrCreate(['pays' => $request->input('pays')]);
        $discipline = Discipline::firstOrCreate(['nom' => $request->input('discipline')]);

        $athletes = new Athlete();
        $athletes->nom = $validatedData['nom'];
        $athletes->date_naissance = $validatedData['date_naissance'];
        $athletes->longueur = $validatedData['longueur'];
        $athletes->poids = $validatedData['poids'];
        $athletes->genre_id = $genre->id;
        $athletes->pays_id = $pays->id;
        $athletes->discipline_id = $discipline->id;
        $athletes->save();
        return redirect()->route('athletes.index');
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
        $athletes = Athlete::findOrFail($id);
        return view('admin.pays.edit', compact('athletes'));
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
        $athletes = Athlete::findOrFail($id);  
        $athletes->delete();
        return redirect()->route('athletes.index');
    }
}
