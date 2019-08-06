<?php

namespace App\Classes;

class Reports {
    public static function getEmbeededChartURL($id)
    {
        $timestamp = time();
        $payload = "id=$id&tenant=a22fc6fe-6a07-4ceb-8e77-3238ed241751&timestamp=$timestamp&expires-in=300";
        $signature = hash_hmac('sha256', $payload, env('MONGODB_EMBEEDING_KEY'));
        $url = "https://charts.mongodb.com/charts-project-0-ntzrn/embed/charts?$payload&signature=$signature";
        return $url;
    }

    public static function showPostsByUserChart()
    {
        $id = "be307d9d-71bc-496b-8fd2-a70cdfbdc58d";
        return self::getEmbeededChartURL($id);
    }

    public static function showPostsByCategoryChart()
    {
        $id = "3aaf07d3-f2b5-439c-ad15-e8a7ad42f748";
        return self::getEmbeededChartURL($id);
    }
}

?>