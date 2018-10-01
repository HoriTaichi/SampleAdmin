<?php

namespace App\Utils;


class DateUtil
{
    public static function getStartDateForMonth($date)
    {
        return date('Y-m', strtotime(($date)));
    }

    public static function getEndDateForMonth($date)
    {
        return date('Y-m', strtotime(($date . '+ 5 month')));
    }

    public static function getAllDateListForMonth($startDate, $endDate)
    {
        $result = [];
        $startDatetime = strtotime($startDate);
        $endDatetime = strtotime($endDate);
        while($startDatetime <= $endDatetime){
            $result[]['date'] = date('Y-m', $startDatetime);
            $startDatetime = strtotime(date('Y-m', $startDatetime) . '+ 1 month');
        }

        return $result;
    }
}
