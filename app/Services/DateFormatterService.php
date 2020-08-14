<?php


namespace App\Services;

use Carbon\Carbon;

class DateFormatterService
{
    public static function fullDatetime($date)
    {
        $fdate = $date->day. ' de '. self::monthName($date).' del '.$date->year;
//        $fDate .= ', '. $date->format('h:i A');

        return $fdate;
    }

    private static function monthName($date)
    {
        switch ($date->month) {
            case 1:
                return "Enero";
            case 2:
                return "Febrero";
            case 3:
                return "Marzo";
            case 4:
                return "Abril";
            case 5:
                return "Mayo";
            case 6:
                return "Junio";
            case 7:
                return "Julio";
            case 8:
                return "Agosto";
            case 9:
                return "Septiembre";
            case 10:
                return "Octubre";
            case 11:
                return "Noviembre";
            case 12:
                return "Diciembre";
        }
    }

    private static function dayName($date)
    {
        switch ($date->dayOfWeek) {
            case 0:
                return "Domingo";
            case 1:
                return "Lunes";
            case 2:
                return "Martes";
            case 3:
                return "Miércoles";
            case 4:
                return "Jueves";
            case 5:
                return "Viernes";
            case 6:
                return "Sábado";
        }
    }
}
