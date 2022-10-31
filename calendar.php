<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/year.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js" integrity="sha512-0QbL0ph8Tc8g5bLhfVzSqxe9GERORsKhIn1IrpxDAgUsbBGz/V7iSav2zzW325XGd1OMLdL4UiqRJj702IeqnQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>萬年曆 PH班第二期</title>
    <style>
        .container {
            width: 48%;
            margin: 0 auto;
            border: 1rem solid #fff;
            box-shadow: 0.1rem 0.1rem 0.2rem 0.1rem #333;
            min-width: 60rem;
            background: linear-gradient(green, #ccf, pink, #ccf);
        }

        .slider {
            /*設定圖片比列(2:1)*/
            width: 100%;
            height: 0;
            padding-bottom: 47%;
            position: relative;
            overflow: hidden;
            border: 0.3rem double #009393;
            box-shadow: inset 0.1rem 0.1rem 0.1rem 0.1rem #999;
        }

        #img {
            width: 1300%;
            position: absolute;
            display: grid;
            grid-template-columns: repeat(13, 1fr);
        }

        #img img {
            width: 100%;
        }

        .dis {
            width: 90%;
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            grid-auto-rows: 4.2rem;
            justify-items: center;
            align-items: center;
            margin-top: 3rem;
            margin: 3rem auto 0 auto;
            /* position: relative; */
        }

        .dis div {
            width: 98%;
            height: 4rem;
            align-self: center;
            border: 1px solid #000;
            line-height: 3.9rem;
            text-align: center;
            font-family: 'Franklin Gothic Medium', sans-serif;
            font-weight: bold;
            border-radius: 1.2rem;
            font-size: 2.4rem;
            background-color: #02e44060;
            transition: transform 2s 0s ease-out,background 5s ,color 5s  ;
        }

        .dis div:hover {
            cursor: pointer;
            background: linear-gradient(blue, #eef);
            background-color: #66f;
            color: #fff;
            font-weight: 800;
            transform: rotateY(360deg);      
        }
    </style>
    <link rel="stylesheet" href="css/media.css">
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
    $lastSpace = $weeks * 7 - $spaceDays - $monthDays;
    //--------------------填入陣列--------------------//
    for ($i = 0; $i < $spaceDays; $i++) {
        $cal[] = '';
    }
    for ($i = 0; $i < $monthDays; $i++) {
        $cal[] = date("j", strtotime("+$i days", strtotime($firstDay)));
    }
    for ($i = 0; $i < $lastSpace; $i++) {
        $cal[] = '';
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
                <?Php
                if ($nextMonth > 12) {
                    echo "<img src='images/";
                    echo 12;
                    echo ".jpg '>";
                    echo "<img src='images/";
                    echo 1;
                    echo ".jpg '>";
                    echo $month;
                } else {
                    for ($i = 0; $i < 12; $i++) {
                        echo "<img src='images/";
                        echo $month + ($i);
                        echo ".jpg '>";
                    }
                }

                ?>

            </div>
        </div>
        <div class="tabMiddle">
            <div class="catlog">
                <div><a href="?y=<?= $prevYear ?>&m=<?= $month ?>" class="leftyear"><?= $year - 1 ?><i class="fa-solid fa-backward arrow"></i></a></div>
                <div class="left previmg" title="上個月">&lt;</div>

                <div class="select">
                    <label>
                        <select name='y' onChange="location = this.value;" title="選擇年份">
                            <?php
                            for ($i = date("Y") - 50; $i < date("Y") + 50; $i++) {
                                if ($i == $year) {
                                    echo "<option selected>";
                                    echo $i;
                                } else {
                                    echo "<option value=\"?y=$i&m=$month\">";
                                    echo $i;
                                }
                                echo "</option>";
                            }
                            ?>
                        </select>
                        <span>年</span>
                    </label>

                    <label>
                        <select name="m" onChange="location = this.value;" title="選擇月份">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                if ($i == $month) {
                                    echo "<option selected value=\"?y=$year&m=$i\">";
                                    echo $i;
                                } else {
                                    echo "<option value=\"?y=$year&m=$i\">";
                                    echo $i;
                                }
                                echo "</option>";
                            }
                            ?>
                        </select>
                        <span>月</span>
                    </label>
                </div>
                <div class="right nextimg" title="下個月">&gt;</div>
                <div><a href="?y=<?= $nextYear ?>&m=<?= $month ?>" class="rightyear"><i class="fa-solid fa-forward arrow"></i><?= $year + 1 ?></a></div>
            </div>
        </div>
        <div class="tab">
            <!-- <table> -->
            <div class="dis">
                <?php
                $week = ['日', '一', '二', '三', '四', '五', '六'];
                // echo "<tr>";
                for ($i = 0; $i < count($week); $i++) {
                    echo "<div id='firstr'>" . $week[$i] . "</div>";
                }
                // echo "</tr>";
                foreach ($cal as $i => $day) {
                    // if ($i % 7 == 0) {
                    //     echo "<tr>";
                    // }
                    // if ($cal[$i] == date("j")) {
                    //     echo "<td id='today'>";
                    //     echo $day;
                    //     echo "</td>";
                    // } else {
                    //     echo "<td>$day</td>";
                    // }
                    // if ($i % 7 == 6) {
                    //     echo "</tr>";
                    // }
                    if ($cal[$i] == date("j")) {
                        echo "<div id='today'>";
                        echo $day;
                        echo "</div>";
                    } else {
                        echo "<div>";
                        echo $day;
                        echo "</div>";
                    }
                }
                ?>
            </div>
            <!-- </table> -->
            <div><a href="?y=<?= date("Y") ?>&m=<?= date("n") ?>" class="today"><i>Today : <?= date('Y-m-d') ?></i></a></div>
        </div>
    </div>
    <footer>
        <div>&copy; 2022-11-12 &nbsp;&nbsp;&nbsp; <img src="./images/logo.png" alt="勞動力發展署"> : 泰山職訓局 PHP班 第二期 &nbsp;<i class="fa-solid fa-user-ninja"></i> : 15號
        </div>
    </footer>
</body>
<script>
    var x = 0; //手動用作標
    const k = 12; //12張圖片
    var banner = $('#img'); //簡化;
    var next = false,
        prev = false;

    $('.nextimg').click(function() { //往右按一下
        if (next == false) {
            next = true;
            if (x >= -((k - 1) * 100)) {
                x -= 100;
            } else {
                banner.css({
                    'left': '0%'
                }); //定位:0;
                x = -100; //-100%;
            };
            banner.animate({
                left: x + '%'
            }, 1500, "easeOutBounce");
            setTimeout(function() {
                next = false;
                location.href = "?y=<?= $year ?>&m=<?= $nextMonth ?>";
            }, 1501);

        };
    });
    $('.previmg').click(function() { //往左按一下
        if (prev == false) {
            prev = true;
            // if (x <= -100) { //定位-500%  => -400% => -300% => -200% =>-100%
            //     x += 100; // -400; -300; -200; -100; 0;
            // } else {
            //     banner.css({
            //         'left': -(k * 100) + '%'
            //     }); //定位-500%
            //     x = -(k - 1) * 100; //-400%;
            // };
            // banner.animate({
            //     left: x + '%'
            // }, 1500, "easeOutBounce");
            setTimeout(function() {
                prev = false;
                location.href = "?y=<?= $year ?>&m=<?= $prevMonth ?>";
            }, 20);
        };
    });
</script>

</html>