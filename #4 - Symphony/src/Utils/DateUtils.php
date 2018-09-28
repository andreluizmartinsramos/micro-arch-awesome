<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 04/05/2018
 * Time: 15:22
 */

namespace App\Utils;


class DateUtils
{
    public static function formatDateTime(string $dateTime, string $timezone): string {
        $newDateTime = new \DateTime($dateTime);
        $newDateTime->setTimezone(new \DateTimeZone($timezone));
        $newDateTimeFormated = $newDateTime->format(\DateTime::RFC3339);
        return mb_substr($newDateTimeFormated, 0, 19);
    }
}