<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆</title>
</head>

<body>
    <?php
    $cal_test = ['', '', '', '', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14];
    $month = (isset($_GET['m'])) ? $_GET['m'] : date("n");
    $year = (isset($_GET['y'])) ? $_GET['y'] : date("Y");
    $cal[]='';
    $nextMonth = $month + 1;
    $prevMonth = $month - 1;

    $firstDay = $year . "-" . $month . "-1";
    $firstDayWeek = date("N", strtotime($firstDay));
    $monthDays=date("t",strtotime($firstDay));
    $lastDay=$year.'-'.$month.'-'.$monthDays;
    $spaceDays=$firstDayWeek-1;
    $weekd=ceil(($monthDays+$spaceDays)/7);

    for($i=0;$i<$spaceDays;$i++){
        $cal[]='';
    }
    for($i=0;$i<$monthDays;$i++){
        $cal[]=date("",strtotime("+$i days",strtotime($firstDay)));
    }
    echo "<pre>";
    print_r($cal);
    echo "</pre>";
    echo "第一天".$firstDay."星期".$firstDayWeek;
    echo "<br>";
    echo "該月共".$monthDays."天，最後一天是".$lastDay;

        ?>
    <div>

        <a href="?y=2022&m=<?= $nextMonth ?>">上一個月</a>
        <h1><?= $year; ?><?= $month ?></h1>
        <a href="?y=2022&m=<?= $prevMonth ?>">下一個月</a>
    </div>
    <table>
        <?php
        foreach ($cal as $i => $day) {
            if ($i % 7 == 0) {
                echo "<tr>";
            }
            echo "<td>$day</td>";
            if ($i % 7 == 6) {
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>

</html>