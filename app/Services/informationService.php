<?php

namespace App\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use RealRashid\SweetAlert\Facades\Alert;

class informationService
{
    public static function get_hebdo_informations_by_weeks($value, $lastDay, $firstDate, $lastDate)
    {
        $get_month_week_number = Carbon::now()->month(session()->get('option_2'))->daysInMonth;
        $nbreWeek = 0;
        for ($i=1; $i <= $get_month_week_number; $i++) {
            if($i % 7 == 0){
                $nbreWeek++;
            }
        }
        $period = CarbonPeriod::create($firstDate, $lastDate);
        foreach($period as $date)
        {
            if($date->format('D') != 'Sun' && $date->format('D') != 'Sat'){
                $dates[] = $date->format('d-m-Y');
            }
        }

        list($tab_1, $tab_2, $tab_3, $tab_4, $tab_5) = array_chunk($dates, 5,($date->format('D') == 'Fri') == true);
        if($value == 1){
            return ['item' => $tab_1];
        }
        if($value == 2){
            return ['item' => $tab_2];
        }
        if($value == 3){
            return ['item' => $tab_3];
        }
        if($value == 4){
            return ['item' => $tab_4];
        }
        if($value == 5){
            return ['item' => $tab_5];
        }
        if($value == 'all'){
            return array_chunk($dates, 5,($date->format('D') == 'Fri') == true);
        }
    }

    public static function get_period_for_tag($all_date_for_month){
        if(count($all_date_for_month) != 1){
            $date_start = $all_date_for_month[0][0];
            $date_end = end($all_date_for_month)[count(end($all_date_for_month))-1];
            return date('d/m/Y', strtotime($date_start)).' au '.date('d/m/Y', strtotime($date_end));
        }else{
            $date_start = $all_date_for_month['item'][0];
            $date_end = end($all_date_for_month['item']);
            return date('d/m/Y', strtotime($date_start)).' au '.date('d/m/Y', strtotime($date_end));
        }
    }
}
