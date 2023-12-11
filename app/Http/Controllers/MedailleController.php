<?php

namespace App\Http\Controllers;

use App\Models\Resultat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedailleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $medaille = Resultat::select()
        $medaille = DB::table('pays')
        ->leftJoin('v_resultat', 'pays.pays', '=', 'v_resultat.pays')
        ->select(
            'pays.pays',
            DB::raw("SUM(CASE WHEN medaille = 'or' THEN 1 ELSE 0 END) AS gold"),
            DB::raw("SUM(CASE WHEN medaille = 'argent' THEN 1 ELSE 0 END) AS silver"),
            DB::raw("SUM(CASE WHEN medaille = 'bronze' THEN 1 ELSE 0 END) AS bronze"),
            DB::raw("DENSE_RANK() OVER(ORDER BY 
                                        SUM(CASE WHEN medaille = 'or' THEN 1 ELSE 0 END) DESC, 
                                        SUM(CASE WHEN medaille = 'argent' THEN 1 ELSE 0 END) DESC, 
                                        SUM(CASE WHEN medaille = 'bronze' THEN 1 ELSE 0 END) DESC
                                     ) AS rang")
        )
        ->groupBy('pays.pays')
        ->get();
        return view('guest.medaille.index', compact('medaille'));
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
