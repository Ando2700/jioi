<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    protected $fillable = ['type_recette', 'code'];
    use HasFactory;
    public $timestamps = false;
}
