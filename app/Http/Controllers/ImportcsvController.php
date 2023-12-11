<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\Recette;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ImportcsvController extends Controller
{
    public function index()
    {
        return view('other.import.importcsv');
    }

    public function importCSV(Request $request)
    {
        $file = $request->file('csv_file')->getRealPath();
        if (File::exists($file)) {
            $data = array_map('str_getcsv', file($file));

            $data = array_filter($data, function ($row) {
                return !empty($row[0]);
            });

            $insertDatadepense = [];
            $insertDatarecette = [];

            foreach ($data as $row) {
                $rowData = explode(';', $row[0]);

                echo $date = date('Y-m-d', strtotime(str_replace('/', '-', $rowData[0])));
                echo $table = $rowData[1];
                echo $code = $rowData[2];
                echo $montant = $rowData[3];
                echo $code_discipline = $rowData[4];
                if ($table == "DEPENSE" || $table == "depense") {
                $insertDatadepense[] = [
                        'date' => $date,
                        'code_depense' => $code,
                        'montant_depense' => $montant,
                        'code_discipline' => $code_discipline
                    ];
                }
                if ($table == "RECETTE" || $table == "recette") {
                $insertDatarecette[] = [
                        'date' => $date,
                        'code_recette' => $code,
                        'montant_recette' => $montant,
                        'code_discipline' => $code_discipline
                    ];
                }
            }

            DB::table('newdepenses')->insert($insertDatadepense);
            DB::table('newrecettes')->insert($insertDatarecette);
            Session::flash('success', 'Reussi');

            return redirect()->back()->with('success', 'Insert succesfully.');
        } else {
            Session::flash('error', 'Error');
            return redirect()->back();
        }
    }
}

// <?php

// namespace App\Http\Controllers;

// use App\Models\Depense;
// use App\Models\Discipline;
// use App\Models\Recette;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\File;

// class ImportcsvController extends Controller
// {
//     public function import(Request $request)
//     {
//         $file = $request->file('csv_file')->getRealPath();
//         if (File::exists($file)) {
//             $data = array_map('str_getcsv', file($file));

//             $data = array_filter($data , function($row){
//                 return !empty($row[0]);
//             });

//             $insertDatadepense = [];
//             $insertDatarecette = [];

//             foreach ($data as $row) {
//                 $rowData = explode(';', $row[0]);

//                 echo $date = date('d-m-Y', strtotime(str_replace('/', '-', $rowData[0])));
//                 echo $table = $rowData[1];
//                 echo $montant = $rowData[3];
//                 echo $code_discipline = $rowData[4];
//                 echo $codedr = $rowData[2];
//                 if($table == "DEPENSE" || $table == "depense"){
//                     $iddpense = DB::table('depenses')->select('depense_id')
//                         ->where('code', '=', $codedr)
//                         ->first();
//                         $insertDatadepense[] = [
//                             'date' => $date,
//                             'iddepense' => $iddpense->id,
//                             'montant_depense' => $montant,
//                             'code_discipine'=> $code_discipline
//                         ];
//                 }
//                 if($table == "RECETTE" || $table == "recette"){
//                     $idrecette = DB::table('recettes')->select('id')
//                         ->where('code', '=', $codedr)
//                         ->first();
//                         $insertDatarecette[] = [
//                             'date' => $date,
//                             'recette_id' => $idrecette->id,
//                             'montant_recette' => $montant,
//                             'code_discipine'=> $code_discipline
//                         ];
//                 }

//             }

//             DB::table('newdepenses')->insert($insertDatadepense);
//             DB::table('newrecette')->insert($insertDatarecette);


//             return redirect()->back()->with('success', 'Insert succesfully.');
//         } else {
//             echo "error";
//         }
//     }
// }


// public function importCSV(Request $request)
//     {
//         $file = $request->file('csv_file');

//         if ($file->isValid()) {
//             $csvData = file_get_contents($file);
//             $rows = array_map('str_getcsv', explode("\n ", $csvData));

//             foreach ($rows as $row) {
//                 if (count($row) < 5) {
//                     continue;
//                 }

//                 list($date, $type, $code, $montant, $code_discipline) = $row;

//                 if ($type === 'recette' || $type === 'RECETTE') {
//                     Newdepense::create([
//                         'date' => $date,
//                         'code_recette' => $code,
//                         'montant_recette' => $montant,
//                         'code_discipline' => $code_discipline,
//                     ]);
//                 } 
//                 if ($type === 'depense' || $type === 'DEPENSE') {
//                     Newrecette::create([
//                         'date' => $date,
//                         'code_depense' => $code,
//                         'montant_depense' => $montant,
//                         'code_discipline' => $code_discipline,
//                     ]);
//                 }
//             }
//         }

//         return redirect()->back();
//     }
