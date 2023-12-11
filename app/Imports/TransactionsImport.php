<?php

namespace App\Imports;

use App\Models\Depense;
use App\Models\Recette;
use App\Models\Newdepense;
use App\Models\Newrecette;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class TransactionsImport implements ToModel, WithHeadingRow, WithCustomCsvSettings{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function model(array $row)
    {
        $code_depense = Depense::where('code', $row['code'])->first();
        $code_recette = Recette::where('code', $row['code'])->first();
        if ($row['type'] === 'depense') {
            return new Newdepense([
                'date'            => $row['date'],
                'type'      => $row['type'],
                'depense_id'      => $code_depense->id,
                'montant_depense' => $row['montant_depense'],
                'code_discipline' => $row['code_discipline'],
            ]);
        }

        if ($row['type'] === 'recette') {
            return new Newrecette([
                'date'            => $row['date'],
                'type'      => $row['type'],
                'recette_id'      => $code_recette->id,
                'montant_recette' => $row['montant_recette'],
                'code_discipline' => $row['code_discipline'],
            ]);
        }
    }
}
