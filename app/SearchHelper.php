<?php


namespace App;


use App\Models\Order;

class SearchHelper
{
    public static function setDefaultConditions()
    {
        $conditions = [
            [
                'where' => [
                    ['status', '<>', Order::TEMP],
                    ['status', '<>', Order::DELETED]
                ],
                'sort' => [
                    'order_date' => 'desc'
                ],
                'date' => [
                    'fromDate' => date('Y-m-d', (time()-60*60*24*7)),
                    'toDate' => date('Y-m-d')
                ],
            ],
        ];
        session(['ls-conditions' => $conditions]);
    }

    public static function setDateRange($fromDate, $toDate)
    {
        $conditions = session()->get('ls-conditions');
        $conditions[0]['date']['fromDate'] = $fromDate;
        $conditions[0]['date']['toDate'] = $toDate;
        session(['ls-conditions' => $conditions]);
    }

    public static function setSortType($sortType = 'desc')
    {
        $conditions = session()->get('ls-conditions');
        $conditions[0]['sort']['order_date'] = $sortType;
        session(['ls-conditions' => $conditions]);
    }

    public static function getConditions()
    {
        return session()->get('ls-conditions');
    }
}
