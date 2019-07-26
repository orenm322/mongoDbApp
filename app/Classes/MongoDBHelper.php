<?php

namespace App\Classes;

use DateTimeZone;

class MongoDBHelper
{
    public static function getLocalDatetime($utcdatetime, $timezone = 'America/New_York')
    {
        return $utcdatetime->toDateTime()->setTimezone(new DateTimeZone($timezone))->format('Y-m-d H:i:s');
    }
}

?>