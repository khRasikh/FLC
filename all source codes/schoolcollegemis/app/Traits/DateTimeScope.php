<?php
namespace App\Traits;

use App\Models\Day;
use App\Models\Month;
use App\Models\Year;

trait DateTimeScope{

    public function getYearById($id)
    {
        $year = Year::find($id);
        if ($year) {
            return $year->title;
        }else{
            return "Unknown";
        }
    }

    public function getMonthById($id)
    {
        $month = Month::find($id);
        if ($month) {
            return $month->title;
        }else{
            return "Unknown";
        }
    }

    public function getDayById($id)
    {
        $day = Day::find($id);
        if ($day) {
            return $day->title;
        }else{
            return "Unknown";
        }
    }
}