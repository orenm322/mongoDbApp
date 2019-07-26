<?php

namespace App\Classes;

class Reports {
    public static function getEmbeededChartURL()
    {
        $timestamp = time();
        $payload = "id=bd57a1ff-7fa7-4385-86aa-de4a56c8cf04&tenant=a22fc6fe-6a07-4ceb-8e77-3238ed241751&timestamp=$timestamp&expires-in=300";
        $signature = hash_hmac('sha256', $payload, env('MONGODB_EMBEEDING_KEY'));
        $url = "https://charts.mongodb.com/charts-project-0-ntzrn/embed/charts?$payload&signature=$signature";
        return $url;
    }
}

?>