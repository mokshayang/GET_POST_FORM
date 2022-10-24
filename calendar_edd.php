<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP萬年曆</title>
    <style>
        table {
            border: 3px double blue;
        }

        td {
            border: 1px solid #ccc;
            text-align: center;
        }

        td:nth-child(6),
        td:nth-child(7) {
            background-color: #fca;
        }
    </style>
</head>

<body>
    <h1>月曆</h1>
    <?php
    $year = date("Y");
    $month = 4; //表示可計算月份
    $today = date("Y") . '-' . $month . '-' . date("j"); //當天
    echo "今天是$today 號";
    echo "<br>";
    // echo $year.'-'.$month;
    $firstDate = $year . '-' . $month . '-' . date("1"); //取第一天
    $firstDateWeek = date("N", strtotime($firstDate)); //第一天是星期?(1-7)
    // $monthDays = date("t", strtotime($firstDate)); //月份有幾天;
    $monthDays = date("t", strtotime($firstDate)); //月份有幾天;
    // $monthDays = cal_days_in_month(CAL_GREGORIAN,$month,$year); //月份有幾天;
    // $Days = date("Y").'-'.date("m",$month).'-'.date("d",$monthDays); //月份有幾天;
    // $monthDays=date('t', mktime(0, 0, 0, $month, 1, $year)); 
    $lastDate = $year . '-' . $month . '-' . $monthDays;
    echo "本月最後一天是$lastDate 號";
    // echo $firstDate;
    echo "<br>";
    echo $month . "月有" . $monthDays . "天"; //ex:10月有31天
    echo "<br>";
    echo "本月第一天是星期:";
    echo $firstDateWeek;
    ?>
    <table>
        <tr>
            <td>一</td>
            <td>二</td>
            <td>三</td>
            <td>四</td>
            <td>五</td>
            <td>六</td>
            <td>日</td>
        </tr>
        <?php
        for ($i = 1; $i <= 7; $i++) {
            echo "<tr>";
            for ($j = 1; $j <= 7; $j++) {
                // $date = ((7 * ($i - 1)) + $j - ($firstDateWeek - 1));//原本的
                $date = $year . '-' . $month . '-' . ((7 * ($i - 1)) + $j - ($firstDateWeek - 1));
                if ($i == 1) { //第一周
                    if ($j >= $firstDateWeek) {
                        if ($date == $today) {
                            echo "<td style='background-color:lightblue'>";
                            echo date("d", strtotime($date));
                            echo "</td>";
                        }
                        echo "<td>";
                        echo date("d", strtotime($date));
                        echo "</td>";
                    } else {
                        echo "<td></td>";
                    }
                } else {
                    // echo $date."=>".strtotime($date) ."<=". strtotime($lastDate)."<br>";
                    // if(strtotime($date) <= strtotime($lastDate)){
                    if (strtotime($date) && date("n", strtotime($date)) == $month) {
                        if ($date == $today) {
                            echo "<td style='background-color:lightblue'>";
                            echo date("d", strtotime($date));
                            echo "</td>";
                        } else {
                            echo "<td>";
                            echo date("d", strtotime($date));
                            echo "</td>";
                        }
                    }
                }
            }
        }
        echo "</tr>";
        ?>

    </table>
</body>

</html>