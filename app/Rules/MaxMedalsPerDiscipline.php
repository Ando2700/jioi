<?php 
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Resultat;

class MaxMedalsPerDiscipline implements Rule
{
    private $disciplineId;

    public function __construct($disciplineId)
    {
        $this->disciplineId = $disciplineId;
    }

    public function passes($attribute, $value)
    {
        $count = Resultat::where('discipline_id', $this->disciplineId)->count();

        return $count < 4;
    }

    public function message()
    {
        return 'Cannot add more than 4 medals for this discipline.';
    }
}
