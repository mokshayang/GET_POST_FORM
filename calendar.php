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
    $cal = [];
    $year =  (isset($_GET['y'])) ? $_GET['y'] : date("Y");
    $month = (isset($_GET['m'])) ? $_GET['m'] : date("n");
    // $year=2022;
    $prevMonth = $month - 1;
    $nextMonth = $month + 1;

    //要不互相影響，變數直不要用一樣的 $year ，改變超連結的部分 $prevMonth && $nextMonth
    if($month==1){
        $prevMonth=12;//等同效 $month=13 再按一下 $month 從12開始--
        $prevYear=$year-1;
    }else{
        $prevYear=$year;
    }
    
    if($month==12){
        $nextMonth=1;//等同效 month=0 再按一下 $$month 從一開始++
        $nextYear=$year+1;
    }else{ 
        $nextYear=$year;
    }
       


    $firstDay = $year . "-" . $month . "-1"; //第一天
    $firstDayWeek = date("N", strtotime($firstDay)); //N:1-7第一周的星期幾
    $monthDays = date("t", strtotime($firstDay)); //當月的天數
    $lastDay = $year . '-' . $month . '-' . $monthDays; //最後一天
    $spaceDays = $firstDayWeek - 1; //空格的天數
    $weeks = ceil(($monthDays + $spaceDays) / 7); //當月的周數
    //---填入陣列-----//
    for ($i = 0; $i < $spaceDays; $i++) {
        $cal[] = '';
    }
    for ($i = 0; $i < $monthDays; $i++) {
        $cal[] = date("j", strtotime("+$i days", strtotime($firstDay)));
    }
    // echo "<pre>";
    // print_r($cal);
    // echo "</pre>";
    echo "第一天 : " . $firstDay . "星期" . $firstDayWeek;
    echo "<br>";
    echo "該月共" . $monthDays . "天，最後一天是" . $lastDay;
    echo "<br>";
    echo "月曆天數" . ($monthDays + $spaceDays) . "天，" . $weeks . "周";
    ?>
    <!-- 要不互相影響，變數值不要用一樣的 $year ，改變超連結的部分 $prevMonth && $nextMonth -->
    <div style="display:flex;width:80%;justify-content:space-between;align-items:center">
        <a href="?y=<?= $prevYear ?>&m=<?= $prevMonth ?>">上一個月</a>
        <h1><?= $year; ?>年<?= $month ?>月</h1>
        <a href="?y=<?= $nextYear ?>&m=<?= $nextMonth ?>">下一個月</a>
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