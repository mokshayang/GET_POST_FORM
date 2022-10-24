<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>計算結果 </title>
</head>

<body>
    <a href="index.php">回首頁</a>
    <br>
    <a href="bmi.php">重新測量</a>
    <br>
    <?php
    if(!empty($_GET)){
        $height = $_GET['height']; //標單陣列
        $weight = $_GET['weight']; //標單陣列
    }else{
        $height = $_POST['height']; //標單陣列
        $weight = $_POST['weight']; //標單陣列
    }
    echo "<br>";
    $bmi = round($weight / (($height / 100) * ($height / 100)), 1);
    echo "您的身高為" . $height . "<br>";
    echo "您的體重為" . $weight . "<br>";
    if ($bmi < 18.5) {
        $level = "體重過經";
    } else if ($bmi < 24) {
        $level = "標準體態";
    } else if ($bmi < 27) {
        $level = "稍微超標";
    } else if ($bmi < 30) {
        $level = "輕度肥胖";
    } else if ($bmi < 35) {
        $level = "中度肥胖";
    } else if ($bmi < 40) {
        $level = "重度肥胖";
    } else if ($bmi >= 40) {
        $level = "超重度肥胖";
    }
    ?>

    <h3>你的BMI計算結果為:<?= $bmi ?></h3>
    <div></div>
    <div>你的體位判定為:<?= $level ?></div>
</body>

</html>