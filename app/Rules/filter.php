<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class filter implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (str_contains(strtolower($value), 'admin')) {
            // هنا بدل دالة message()، تقوم باستدعاء $fail مباشرة
            $fail('The :attribute cannot contain the word "admin".');
        }
    }
}
