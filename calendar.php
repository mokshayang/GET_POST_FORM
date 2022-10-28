<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/year.css">

    <title>萬年曆</title>
    <style>
        body {
            background: url("./images/04.jpg") no-repeat;
            background-size: 100% 100%;
        }
    </style>
</head>

<body onselectstart="return false;" ondragstart="return false;" oncontextmenu="return false;">
    <?php
    date_default_timezone_set("Asia/Taipei");
    $cal = [];
    $year =  (isset($_GET['y'])) ? $_GET['y'] : date("Y");
    $month = (isset($_GET['m'])) ? $_GET['m'] : date("n");
//
    if ($month < 1) {
        $month = 12;
        $year = $year - 1;
    }
    if ($month > 12) {
        $month = 1;
        $year = $year + 1;
    }
    $prevMonth = $month - 1;
    $nextMonth = $month + 1;

    $firstDay = $year . "-" . $month . "-1"; //第一天
    $firstDayWeek = date("w", strtotime($firstDay)); //N:1-7第一周的星期幾
    $monthDays = date("t", strtotime($firstDay)); //當月的天數
    $lastDay = $year . '-' . $month . '-' . $monthDays; //最後一天
    $spaceDays = $firstDayWeek; //空格的天數
    $weeks = ceil(($monthDays + $spaceDays) / 7); //當月的周數
    //--------------------填入陣列--------------------//
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
    <div class="tab">
        <div class="catlog">
            <a href="?y=<?= $year ?>&m=<?= $prevMonth ?>" class="left">&lt;</a>
            <div><?= $year; ?>&nbsp;年&nbsp;<?= $month ?>&nbsp;月</div>
            <a href="?y=<?= $year ?>&m=<?= $nextMonth ?>" class="right">&gt;</a>
        </div>
        <!-- <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get"> -->
        <!-- <form action="<?php echo $_SERVER['PHP_SELF'] ?>" mothed="get"> -->
        <label>
            <select name='y' id=year>
                <?php

                for ($i = date("Y") - 50; $i < date("Y") + 50; $i++) {
                    if ($i == $year) {
                        echo "<option selected>";
                        echo $i;
                    } else {
                        echo "<option >";
                        echo $i;
                    }
                    echo "</option>";
                }
                ?>
            </select>
            年</label>
        <script>
           // var x = document.getElementById("month").selectedIndex;
        //     document.getElementsByTagName("option")[x] = [x].value;
            document.getElementById("year").addEventListener('change', function() {
                 var x = document.getElementById("month").selectedIndex;
                 var y= document.getElementsByTagName("option")[x].value;
                 var z= y[x].value; 
            }, false);​
        </script>
        <?php 
            $year="<sprict type=text/javascript>document.write('z')</script>";
?>
        <?php echo $year ?>
        <label>
            <!-- <select id="month" onChange="location = this.options[this.selectedIndex].value;">  -->
            <!-- <select id="month" onChange="location = this.value;"> -->
            <!-- option:selected -->
            <select name="m" onChange="location = this.value;">
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    if ($i == $month) {
                        echo "<option selected>";
                        echo $i;
                    } else {

                        echo "<option value=\"calendar.php?y=$year&m=$i\">";
                        echo $i;
                    }
                    echo "</option>";
                }
                ?>
            </select>
            月
        </label>
        <!-- <input type="submit" value="查詢"> -->
        <!-- </form> -->
        <!-- </form> -->
        <table>
            <?php
            $week = ['日', '一', '二', '三', '四', '五', '六'];
            echo "<tr>";
            for ($i = 0; $i < count($week); $i++) {
                echo "<td id='firstr'>" . $week[$i] . "</td>";
            }
            echo "</tr>";
            foreach ($cal as $i => $day) {
                if ($i % 7 == 0) {
                    echo "<tr>";
                }
                if ($cal[$i] == date("j")) {
                    echo "<td id='today'>";
                    echo $day;
                    echo "</td>";
                } else {
                    echo "<td>$day</td>";
                }
                if ($i % 7 == 6) {
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>
    <!-- <select id="month" onChange="location = this.options[this.selectedIndex].value;"> -->
    <script>
        // document.getElementById("month").addEventListener('change', function() {
        //     window.location = this.value;
        // }, true);​
        // function displayResult() {
        //     var x = document.getElementById("month").selectedIndex;
        //     document.getElementsByTagName("option")[x] = [x].value;
        // }
    </script>
</body>

</html>