<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['type_depense', 'code'];
    public $timestamps = false;
}
