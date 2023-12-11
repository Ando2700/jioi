<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newrecette extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'montant_recette', 'code_discipline', 'code_recette'];
    public $timestamps = false;
}
