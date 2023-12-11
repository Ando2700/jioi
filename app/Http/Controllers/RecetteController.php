<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use Illuminate\Http\Request;

class RecetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recettes = Recette::paginate(5);
        return view('admin.recette.index', compact('recettes'));
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
            'type_recette' => 'required|string',
            'code' => 'required|size:3|regex:/^[A-Z]{3}$/',
        ]);
        $recettes = new Recette();
        $recettes->type_recette = $validatedData['type_recette'];
        $recettes->code = $validatedData['code'];
        $recettes->save();
        return redirect()->route('recettes.index');
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
        $recette = Recette::findOrFail($id);
        return view('admin.recette.edit', compact('recette'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'type_recette' => 'required|string',
            'code' => 'required|size:3|regex:/^[A-Z]{3}$/',
        ]);
        $recettes = Recette::findOrFail($id);
        $recettes->update([
            'type_recette' => $request->type_recette,
            'code' => $request->code,
        ]);

        return redirect()->route("recettes.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recette = Recette::findOrFail($id);  
        $recette->delete();
        return redirect()->route('recettes.index');
    }
}
