<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
// use App\Models\Categorieathlete;
use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categorie = Categorieathlete::all();
        $disciplines = Discipline::paginate(10);
        return view('admin.discipline.index', compact('disciplines'));
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
            // 'categorie' => 'required|string',
            'type' => 'required|string',
            'code_discipline' => 'required|size:3|regex:/^[A-Z]{3}$/',
        ]);
        // $categorie = Categorieathlete::firstOrCreate(['categorie' => $request->input('categorie')]);
        
        $disciplines = new Discipline();
        $disciplines->nom = $validatedData['nom'];
        $disciplines->type = $validatedData['type'];
        $disciplines->code_discipline = $validatedData['code_discipline'];
        $disciplines->save();
        return redirect()->route('disciplines.index');
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
        $discipline = Discipline::findOrFail($id);
        // $categorie = Categorieathlete::all();
        return view('admin.discipline.edit', compact('discipline'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nom' => 'required|string',
            'type' => 'required|string',
            'code_discipline' => 'required|size:3|regex:/^[A-Z]{3}$/',
        ]);
        $disciplines = Discipline::findOrFail($id);
        $disciplines->update([
            'nom' => $request->nom,
            'type' => $request->type,
            'code_discipline' => $request->code_discipline,
        ]);

        return redirect()->route("disciplines.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $discipline = Discipline::findOrFail($id);  
        $discipline->delete();
        return redirect()->route('disciplines.index');
    }
}

