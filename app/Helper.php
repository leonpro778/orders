<?php

if (!function_exists('displayCurrency')) {
    function displayCurrency(int $amount) {
        return number_format(($amount/100), 2, ',', ' ').' '.config('app.currency');
    }
}

if (!function_exists('changeCurrencyToInt')) {
    function changeCurrencyToInt($amount = '0'): int {
        $multiplier = 100;
        if ((strpos($amount, '.')) || (strpos($amount, ','))) { $multiplier = 1; }
        $separatorArray = ['.', ',', ' '];
        $amount = intval(str_replace($separatorArray, "", $amount))*$multiplier;
        return $amount;
    }
}
