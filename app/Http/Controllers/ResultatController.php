<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use App\Models\Resultat;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rules\MaxMedalsPerDiscipline;

class ResultatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discipline = Discipline::all();
        $pays = Pays::all();
        $rang = $pays->count();
        $resultats = DB::table('v_resultat')->orderBy('discipline')->get();
        return view('other.resultat.index', compact(
            'resultats',
            'discipline',
            'pays',
            'rang'
        ));
    }

    public function filterResult(Request $request)
    {
        $query = DB::table('v_resultat');

        if ($request->has('discipline')) {
            $query->where('discipline', $request->input('discipline'));
        }

        if ($request->has('pays')) {
            $query->where('pays', $request->input('pays'));
        }

        $results = $query->get();

        // Affichez les résultats, par exemple, retournez-les à une vue
        return view('other.resultat.index', ['results' => $results]);
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
        $discipline = Discipline::firstOrCreate(['nom' => $request->input('discipline')]);
        $validatedData = $request->validate([
            'pays' => 'required|string',
            'discipline' => [
                'required',
                'string',
                new MaxMedalsPerDiscipline($discipline->id)
            ],
            'rang' => 'required|integer',
        ]);
        
        $pays = Pays::firstOrCreate(['pays' => $request->input('pays')]);
        $resultat = new Resultat();
        $resultat->rang = $validatedData['rang'];
        $resultat->pays_id = $pays->id;
        $resultat->discipline_id = $discipline->id;
        $resultat->save();
        return redirect()->route('resultats.index');
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
