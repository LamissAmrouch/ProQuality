<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class TestChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */

    public function __construct()
    {
        $this->options([
            'responsive' => true,
        ]);
        parent::__construct();
    }
}
