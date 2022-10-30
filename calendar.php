<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/year.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>萬年曆 PH班第二期</title>
    <style>
        html {
            background-color: #ccc;
        }

        .container {
            width: 52%;
            margin: 0 auto;
            border: 1rem solid #fff;
            box-shadow: 0rem 0rem 0.2rem 0.1rem #333;
            min-width: 60rem;
        }

        .slider {
            /*設定圖片比列(2:1)*/
            width: 100%;
            height: 0;
            padding-bottom: 47%;
            position: relative;
            overflow: hidden;
            border: 0.2rem solid #333;
        }

        #img {
            width: 1300%;
            /*13張的寬度*/
            position: absolute;
            display: grid;
            grid-template-columns: repeat(13, 1fr);
            /*新技術喔，重要*/

        }

        #img img {
            width: 100%;
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
    <div class="container">
        <div class="slider">
            <div id="img">
                <!-- <img src="./images/<?= $month ?>.jpg" alt="">
                <img src="./images/<?= $nextMonth ?>.jpg" alt=""> -->
                <!-- <img src="./images/<?= $month ?>.jpg" alt="">
                <img src="./images/<?= $month ?>.jpg" alt="">
                <img src="./images/<?= $month ?>.jpg" alt="">
                <img src="./images/1.jpg" alt=""> -->
                <?Php

                // if ($prevMonth < 1) {
                //     echo "<img src='images/";
                //     echo 1;
                //     echo ".jpg '>";
                //     echo "<img src='images/";
                //     echo 12;
                //     echo ".jpg '>";
                //     echo $month;
                // } else {
                //     for ($i = 0; $i <= 2; $i++) {
                //         echo "<img src='images/";
                //         echo $month - ($i);
                //         echo ".jpg '>";
                //     }
                // }
                if ($nextMonth > 12) {
                    echo "<img src='images/";
                    echo 12;
                    echo ".jpg '>";
                    echo "<img src='images/";
                    echo 1;
                    echo ".jpg '>";
                    echo $month;
                } else {
                    for ($i = 0; $i <= 1; $i++) {
                        echo "<img src='images/";
                        echo $month + ($i);
                        echo ".jpg '>";
                    }
                }

                $prevMonth = $month - 1;
                $nextMonth = $month + 1;
                $prevYear = $year - 1;
                $nextYear = $year + 1;

                ?>
                <img src="./images/1.jpg" alt="calendar">
            </div>
        </div>
        <div class="tabMiddle">
            <div class="catlog">
                <div><a href="?y=<?= $prevYear ?>&m=<?= $month ?>" class="leftyear"><?= $year - 1 ?><i class="fa-solid fa-backward arrow"></i></a></div>
                <div class="left previmg">&lt;</div>

                <div class="right nextimg">&gt;</div>
                <div><a href="?y=<?= $nextYear ?>&m=<?= $month ?>" class="rightyear"><i class="fa-solid fa-forward arrow"></i><?= $year + 1 ?></a></div>
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
            </div>
        </div>
        <div class="tab">
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
            <div><a href="?y=<?= date("Y") ?>&m=<?= date("n") ?>" class="today"><i>Today : <?= date('Y-m-d') ?></i></a></div>
        </div>
    </div>
    </div>
    <footer>
        <div>&copy; 2022-11-12 &nbsp;&nbsp;&nbsp; <img src="./images/logo.png" alt="勞動力發展署"> : 泰山職訓局 PHP班 第二期 &nbsp;<i class="fa-solid fa-user-ninja"></i> : 15號</div>
    </footer>
</body>
<script>
    var x = 0; //手動用作標
    const k = 12; //5張圖片
    var interval; //間隔時間，自動用
    var banner = $('#img'); //簡化;
    var next = false,
        prev = false;

    $('.nextimg').click(function() { //往右按一下
        if (next == false) {
            next = true;
            if (x >= -((k - 1) * 100)) { //初始0; -100%; -200%; -300%; -400%;
                x -= 100; //-100%; -200%; -300%; -400%; -500%;

            } else {
                banner.css({
                    'left': '0%'
                }); //定位:0;
                x = -100; //-100%;
            };
            banner.animate({
                left: x + '%'
            }, 800);
            setTimeout(function() {
                next = false;
                location.href = "?y=<?= $year ?>&m=<?= $nextMonth ?>";
            }, 801);

        };
    });

    $('.previmg').click(function() { //往左按一下
        // if (prev == false) {
        //     prev = true;
        //     if (x <= -100) { //定位-500%  => -400% => -300% => -200% =>-100%

        //         x += 100; // -400; -300; -200; -100; 0;
        //     } else {
        //         banner.css({
        //             'left': -(k * 100) + '%'
        //         }); //定位-500%
        //         x = -(k - 1) * 100; //-400%;
        //     };
        //     banner.animate({
        //         left: x + '%'
        //     }, 800);
            setTimeout(function() {
                prev = false;
                location.href = "?y=<?= $year ?>&m=<?= $prevMonth ?>";
            }, 101);
        // };
    });
</script>

</html>