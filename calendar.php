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
        html {
            background-color: #ccc;
        }

        .container {
            width: 62.5%;
            margin: 0 auto;
            border: 1rem solid #fff;
            box-shadow: 0.1rem 0.1rem 0.2rem 0.1rem #333;
            min-width: 40rem;
            position: relative;

        }

        .slider {
            /*設定圖片比列(2:1)*/
            width: 100%;
            height: 0;
            padding-bottom: 50%;
            position: relative;
            /* overflow: hidden; */
            border: 1rem solid #333;
            /* z-index: 999; */
        }

        #img {
            width: 500%;
            /*4張的寬度*/
            position: relative;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            /*新技術喔，重要*/
            z-index: 999;
        }

        #img img {
            width: 100%;
        }

        .tab {
            top: 10%;
            left: 20%;
        }

        .page1 {
            background: url("./images/1.jpg");

        }

        .page2 {
            background: url("./images/2.jpg");
        }

        .page3 {
            background: url("./images/3.jpg");
        }

        .page4 {
            background: url("./images/4.jpg");
        }
    </style>
</head>

<body onselectstart="return false;" ondragstart="return false;" oncontextmenu="return false;">
    <header id=header>
        <marquee scrollamount=20>
            ~ 萬 年 曆 作 業 練 習 ~
        </marquee>
    </header>

    <div class="container">
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
        <div class="slider">
            <div id="img">
                <!-- <?Php
                        // for($i=1;$i<=4;$i++){
                        //     echo "<img class='";
                        //     echo "page".$i;
                        //     echo "'>";
                        // }
                        ?> -->
                <!-- <img  class="<?= 'page' . $month ?>"> -->
                <img src="./images/page1.jpg" alt="">
                <img src="./images/page2.jpg" alt="">
                <img src="./images/page3.jpg" alt="">
                <img src="./images/page4.jpg" alt="">
                <img src="./images/page1.jpg" alt="">

            </div>
        </div>
        <?php echo "page" . $month ?>
        <div class="tab">
            <div class="catlog">
                <div><a href="?y=<?= $prevYear ?>&m=<?= $month ?>" class="leftyear"><?= $year - 1 ?><i class="fa-solid fa-backward arrow"></i></a></div>
                <div class="left previmg">&lt;</div>
                <div style="font-family:'標楷體';font-size:3.2rem;">萬</div>
                <div class="right nextimg">&gt;</div>
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
    const k = 4; //5張圖片
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
                location.href="?y=<?= $year ?>&m=<?= $nextMonth ?>";
            }, 801);

        };
    });

    $('.previmg').click(function() { //往左按一下
        if (prev == false) {
            prev = true;
            if (x <= -100) { //定位-500%  => -400% => -300% => -200% =>-100%

                x += 100; // -400; -300; -200; -100; 0;
            } else {
                banner.css({
                    'left': -(k * 100) + '%'
                }); //定位-500%
                x = -(k - 1) * 100; //-400%;
            };
            banner.animate({
                left: x + '%'
            }, 800);
            setTimeout(function() {
                prev = false;
                location.href="?y=<?= $year ?>&m=<?= $prevMonth ?>";
            }, 801);
        };
    });
</script>

</html>