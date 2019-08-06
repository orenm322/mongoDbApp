<?php
namespace App\Http\Controllers;

use App\Classes\Reports;

class ReportsController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showPostsByUserChart()
    {
        $url = Reports::showPostsByUserChart();
        return view('reports.show-mongodb-chart', ['url' => $url] );
    }

    public function showPostsByCategoryChart()
    {
        $url = Reports::showPostsByCategoryChart();
        return view('reports.show-mongodb-chart', ['url' => $url] );
    }

    // public function showMap()
    // {
    //     return view('reports.show-map');
    // }
}

?>