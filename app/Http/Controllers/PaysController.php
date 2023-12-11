<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Pays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pays = Pays::paginate(10);
        return view('admin.pays.index', compact('pays'));
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
        try {
            $validatedData = $request->validate([
                'pays' => 'required|string',
            ]);
            $pays = new Pays();
            $pays->pays = $validatedData['pays'];
            $pays->save();
            Session::flash('success', 'Reussi');
            return redirect()->route('pays.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Error');
            return redirect()->back()->withInput($request->input());
        }
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
        $pays = Pays::findOrFail($id);
        return view('admin.pays.edit', compact('pays'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'pays' => 'required|string',
        ]);
        $pays = Pays::findOrFail($id);
        $pays->update([
            'pays' => $request->pays,
        ]);

        return redirect()->route("pays.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pays = Pays::findOrFail($id);
        $pays->delete();
        return redirect()->route('pays.index');
    }
}
