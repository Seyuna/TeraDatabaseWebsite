<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use dosamigos\chartjs\ChartJs;
use yii\bootstrap\ActiveForm;

$this->title = $region . ' class by date';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="body-content">

    <?php
    $backgroundColor = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
    ];
    $borderColor = [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
    ];
    $i = 0;
    foreach ($data as $date => $date_data) {

        $data_count = [];
        foreach ($date_data[1] as $count) {
            $data_count[] = round(($count * 100) / $date_data[2], 3);
        }

        $dataset[] = [
            'label' => $date,
            'backgroundColor' => $backgroundColor[$i % 6],
            'borderColor' => $borderColor[$i % 6],
            'borderWidth' => 1,
            'data' => $data_count,
        ];
        $i++;
    }

    echo "<h1>$region class usage statistics by date</h1>";
    echo ChartJs::widget([
        'type' => 'bar',
        'options' => [
            'responsive' => true,
            'title' => [
                'display' => false,
                'text' => $region . ' class usage statistics by date'
            ],
        ],

        'data' => [
            'labels' => $date_data[0],
            'datasets' => $dataset
        ]
    ]);

    ?>
</div>
