<?php

namespace App\Acme\Helpers;

class Helper
{
    /**
     * { function_description }
     *
     * @param      integer  $size   The size
     *
     * @return     <type>   ( description_of_the_return_value )
     */
    public static function formatSize($size)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $power = $size > 0 ? floor(log((Int) $size, 1024)) : 0;

        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }

    /**
     * { function_description }
     *
     * @param      integer  $view   The view
     *
     * @return     <type>   ( description_of_the_return_value )
     */
    public static function formatView(int $view, bool $convertUnit = false)
    {
        if ($convertUnit) {
            $units = ['', 'Nghìn', 'Triệu', 'Tỉ'];
            $power = $view > 0 ? floor(log((Int) $view, 1000)) : 0;

            return number_format($view / pow(1000, $power), 0, '.', ',') . ' ' . $units[$power];
        } else {
            return number_format($view, 0, '.', ',');
        }
    }
}
