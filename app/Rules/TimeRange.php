<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TimeRange implements Rule
{
    public function passes($attribute, $value)
    {
        $isPassed = true;

        if (!isset($value['from']) || !$value['from'] || !strtotime($value['from'])) {
            $isPassed = false;
        }

        if (!isset($value['to']) || !$value['to'] || !strtotime($value['to'])) {
            $isPassed = false;
        }

        return $isPassed;
    }

    public function message()
    {
        return 'Поле :attribute должно содержать поля from и to с временными значениями.';
    }
}
