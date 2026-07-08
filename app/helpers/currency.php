<?php

namespace App\Helpers;

use NumberFormatter;

class Currency
{

    public static function format($amount, $currency = null)
    {

        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
        $currency = $currency ?? config('app.currency');

        return $formatter->formatCurrency($amount, $currency);
    }
}
