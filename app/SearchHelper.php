<?php


namespace App;


use App\Models\Order;

class SearchHelper
{
    public static function setDefaultConditions()
    {
        $conditions = [
            'where' => [
                ['status', '<>', Order::TEMP],
                ['status', '<>', Order::DELETED]
            ],
            'wherein' => [0, Order::ACTIVE, Order::SIGNED, Order::CLOSED],
            'status_order' => [
                'active' => 'checked',
                'signed' => 'checked',
                'closed' => ''
            ],
            'sort' => 'desc',
            'date' => [
                'fromDate' => date('Y-m-d', (time()-60*60*24*14)),
                'toDate' => date('Y-m-d')
            ],
        ];
        session(['ls-conditions' => $conditions]);
    }

    public static function setDateRange($fromDate, $toDate)
    {
        $conditions = session()->get('ls-conditions');
        $conditions['date']['fromDate'] = $fromDate;
        $conditions['date']['toDate'] = $toDate;
        session(['ls-conditions' => $conditions]);
    }

    public static function setSortType($sortType = 'desc')
    {
        $conditions = session()->get('ls-conditions');
        $conditions['sort'] = $sortType;
        session(['ls-conditions' => $conditions]);
    }

    public static function setStatusCriteria($types)
    {
        if (!$types) { $types = ['none']; }
        $conditions = session()->get('ls-conditions');
        $conditions['wherein'] = [];
        $conditions['wherein'][] = 0;
        $orderStatus = array_keys($conditions['status_order']);
        for($i=0;$i<=(count($orderStatus)-1); $i++) {
            if (in_array($orderStatus[$i], $types))
            {
                $conditions['status_order'][$orderStatus[$i]] = 'checked';
                $conditions['wherein'][] = Order::getStatusOrderNumber()[$orderStatus[$i]];
            }
            else
            {
                $conditions['status_order'][$orderStatus[$i]] = '';
            }
        }
        session(['ls-conditions' => $conditions]);
    }

    public static function getConditions()
    {
        return session()->get('ls-conditions');
    }
}
