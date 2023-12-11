<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultat extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['rang', 'medaille'];

    public function setRangAttribute($value)
    {
        $this->attributes['rang'] = $value;
        switch ($value) {
            case 1:
                $this->attributes['medaille'] = 'or';
                break;
            case 2:
                $this->attributes['medaille'] = 'argent';
                break;
            case 3:
                $this->attributes['medaille'] = 'bronze';
                break;
            default:
                $this->attributes['medaille'] = null;
                break;
        }
    }
}
