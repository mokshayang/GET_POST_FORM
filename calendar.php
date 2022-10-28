<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/year.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>萬年曆 PH班第二期</title>
    <style>
        body {
            background: url("./images/04.jpg") no-repeat;
            background-size: 100% 100%;
        }
    </style>
</head>

<body onselectstart="return false;" ondragstart="return false;" oncontextmenu="return false;">
    <header id=header>
        <marquee scrollamount=20>
            ~ 萬 年 曆 作 業 練 習 ~
        </marquee>
    </header>
    <?php
    date_default_timezone_set("Asia/Taipei");
    $cal = [];
    $year =  (isset($_GET['y'])) ? $_GET['y'] : date("Y");
    $month = (isset($_GET['m'])) ? $_GET['m'] : date("n");
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
    $prevYear = $year - 1;
    $nextYear = $year + 1;

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
    // echo "第一天 : " . $firstDay . "星期" . $firstDayWeek;
    // echo "<br>";
    // echo "該月共" . $monthDays . "天，最後一天是" . $lastDay;
    // echo "<br>";
    // echo "月曆天數" . ($monthDays + $spaceDays) . "天，" . $weeks . "周";
    ?>
    <div class="tab">
        <div class="catlog">
            <div><a href="?y=<?= $prevYear ?>&m=<?= $month ?>" class="leftyear"><?= $year - 1 ?><i class="fa-solid fa-backward arrow"></i></a></div>
            <div><a href="?y=<?= $year ?>&m=<?= $prevMonth ?>" class="left">&lt;</a></div>
            <div style="font-family:'標楷體';font-size:3.2rem;">萬年曆</div>
            <div><a href="?y=<?= $year ?>&m=<?= $nextMonth ?>" class="right">&gt;</a></div>
            <div><a href="?y=<?= $nextYear ?>&m=<?= $month ?>" class="rightyear"><i class="fa-solid fa-forward arrow"></i><?= $year + 1 ?></a></div>
        </div>
        <div class="select">
            <label>
                <select name='y' onChange="location = this.value;">
                    <?php
                    for ($i = date("Y") - 50; $i < date("Y") + 50; $i++) {
                        if ($i == $year) {
                            echo "<option selected>";
                            echo $i;
                        } else {
                            echo "<option value=\"calendar.php?y=$i&m=$month\">";
                            echo $i;
                        }
                        echo "</option>";
                    }
                    ?>
                </select>
                <span>年</span>
            </label>

            <label>
                <select name="m" onChange="location = this.value;">
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        if ($i == $month) {
                            echo "<option selected value=\"calendar.php?y=$year&m=$i\">";
                            echo $i;
                        } else {
                            echo "<option value=\"calendar.php?y=$year&m=$i\">";
                            echo $i;
                        }
                        echo "</option>";
                    }
                    ?>
                </select>
                <span>月</span>
            </label>
        </div>
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
    <footer>
        <div>&copy;2022-11-12 &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-user-ninja"></i> : 泰山職訓局PHP班 第二期 15號</div>
    </footer>
</body>

</html>