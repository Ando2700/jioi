<?php

namespace App\Rules;

use Closure;
use App\Models\Resultat;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueRankInDiscipline implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
    private $pays_id;
    private $discipline_id;

    public function __construct($pays_id, $discipline_id)
    {
        $this->pays_id = $pays_id;
        $this->discipline_id = $discipline_id;
    }

    public function passes($attribute, $value)
    {
        if (!in_array($value, [1, 2, 3])) {
            return true;
        }
        return !Resultat::where('pays_id', $this->pays_id)
            ->where('discipline_id', $this->discipline_id)
            ->where('rang', $value)
            ->exists();
    }

    public function message()
    {
        return 'This combination of country and discipline already exists.';
    }
}

