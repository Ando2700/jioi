<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depenses = Depense::paginate(5);
        return view('admin.depense.index', compact('depenses'));

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
            'type_depense' => 'required|string',
            'code' => 'required|size:3|regex:/^[A-Z]{3}$/',
        ]);
        $depenses = new Depense();
        $depenses->type_depense = $validatedData['type_depense'];
        $depenses->code = $validatedData['code'];
        $depenses->save();
        return redirect()->route('depenses.index');
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
        $depense = Depense::findOrFail($id);
        return view('admin.depense.edit', compact('depense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'type_depense' => 'required|string',
            'code' => 'required|size:3|regex:/^[A-Z]{3}$/',
        ]);
        $depenses = Depense::findOrFail($id);
        $depenses->update([
            'type_depense' => $request->type_depense,
            'code' => $request->code,
        ]);

        return redirect()->route("depenses.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $depense = Depense::findOrFail($id);  
        $depense->delete();
        return redirect()->route('depenses.index');
    }
}
