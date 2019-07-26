<?php
namespace App\Http\Controllers;

use App\Classes\Reports;

class ReportsController extends Controller {
    public function showGraph()
    {
        $url = Reports::getEmbeededChartURL();
        return view('reports.show-graph', ['url' => $url] );
    }
}

?>