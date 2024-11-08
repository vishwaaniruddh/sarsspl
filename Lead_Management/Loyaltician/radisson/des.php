<?
$chartConfigArr = "{
  type: 'doughnut',
  data: {
    datasets: [
      {
        data: [10, 20],
        backgroundColor: [ '#f6d036', '#c5c6c8'],
      },
    ],
    labels: ['Gold', 'Platinum'],
  },
  options: {
    plugins: {
      datalabels: {
        formatter: (value) => {
          return value + '%';
        }
      }
    }
  }
}";

$chartUrl = 'https://quickchart.io/chart?w=500&h=300&c=' . urlencode($chartConfigArr);

// $chartConfig = json_encode($chartConfigArr);

// $chartUrl = 'https://quickchart.io/chart?w=500&h=300&c=' . urlencode($chartConfig);



?>


<img src="<?php echo $chartUrl; ?>">