<?php
namespace App\Http\Controllers;

use App\Classes\Reports;

class ReportsController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showPostsByAuthorChart()
    {
        $url = Reports::showPostsByAuthorChart();
        return view('reports.show-mongodb-chart', ['url' => $url] );
    }

    // public function showMap()
    // {
    //     return view('reports.show-map');
    // }
}

?>