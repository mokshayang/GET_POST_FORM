<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆</title>
    <style>
        html{
            font-size: 10px;
        }
        *{
            box-sizing: border-box;
            text-align: center;
        }

        .catlog {
            width: 48%;
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            align-items: center;
            margin: 0 auto;
        }
        .catlog div{
            font-size: 2.8rem;
        }

        .left, .right {
            display: block;
            align-self: center;
            width: 3.2rem;
            height: 3.2rem;
            border-radius: 50%;
            color: #eee;
            text-decoration: none;
            font-weight: bold;
            font-size: 2.4rem;
            margin: 0 auto;
            line-height: 31px;
            text-align: center;
            background: linear-gradient(to left, blue, #ccf);
            border: 0.1rem solid blue;;
        }
        .right{
            background: linear-gradient(to right, blue, #ccf);

        }
        .left:hover{
            background: linear-gradient(to left, #99f, blue);
            font-size: 28px;
        }
        .right:hover{
            background: linear-gradient(to right, #99f, blue);
            font-size: 28px;
        }
        .catlog a:active{
        box-shadow:inset 0.1rem 0.1rem 0.1rem 0rem #006 ;
        }
        .left:active{
            box-shadow:inset -0.1rem 0.1rem 0.1rem 0rem #206 ;
        }
        table{
            width: 48%;
            margin: 32px auto;
            font-size: 2.4rem;
        }
        tr,td{
            border: 0.1rem solid lightblue;
            margin: 0.8rem;
        }
        td:hover{
            cursor: pointer;
            background:linear-gradient(blue,#eef);
            color:#fff;
            font-weight: bold;
        }
        td:nth-child(1),td:nth-child(7){
            background:	#00DB00;
            border: 0.2rem solid green;
        }
        #today{
            background: #ccc;
            border: 0.2rem solid green;
            border-radius: 0.4rem;
        }
    </style>
</head>

<body>
    <?php
    $cal = [];
    $year =  (isset($_GET['y'])) ? $_GET['y'] : date("Y");
    $month = (isset($_GET['m'])) ? $_GET['m'] : date("n");
    // $year=2022;
    $prevMonth = $month - 1;
    $nextMonth = $month + 1;

    if ($month == 1) {
        $prevMonth = 12; //等同效 $month=13 再按一下$prevMonth $month會從12開始--
        $prevYear = $year - 1;
    } else {
        $prevYear = $year;
    }

    if ($month == 12) {
        $nextMonth = 1; // 等同效 $month=0  再按一下$nextMonth  $month會從 1開始++
        $nextYear = $year + 1;
    } else {
        $nextYear = $year;
    }



    $firstDay = $year . "-" . $month . "-1"; //第一天
    $firstDayWeek = date("w", strtotime($firstDay)); //N:1-7第一周的星期幾
    $monthDays = date("t", strtotime($firstDay)); //當月的天數
    $lastDay = $year . '-' . $month . '-' . $monthDays; //最後一天
    $spaceDays = $firstDayWeek; //空格的天數
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
    <div class="catlog">
        <a href="?y=<?= $prevYear ?>&m=<?= $prevMonth ?>" class="left">&lt;</a>
        <div><?= $year; ?>年<?= $month ?>月</div>
        <a href="?y=<?= $nextYear ?>&m=<?= $nextMonth ?>" class="right">&gt;</a>
    </div>
    <table>
        <?php
        $week = ['日', '一', '二', '三', '四', '五', '六'];
        echo "<tr>";
        for ($i = 0; $i < count($week); $i++) {
            echo "<td>" . $week[$i] . "</td>";
        }
        echo "</tr>";
        foreach ($cal as $i => $day) {
            if ($i % 7 == 0) {
                echo "<tr>";
            }
            if($cal[$i]==date("j")){
                echo "<td id='today'>";
                echo $day;
                echo "</td>";
            }else{
                echo "<td>$day</td>";
            }
            if ($i % 7 == 6) {
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>

</html>