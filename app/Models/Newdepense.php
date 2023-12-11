<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newdepense extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'montant_depense', 'code_discipline', 'code_depense'];
    public $timestamps = false;
}
