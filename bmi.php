<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI計算</title>
</head>
<body>
    <a href="index.php">回首頁</a>
    <br>
    <h1>BMI計算</h1>
    <!-- <a href="result.php?height=180&weight=80">我的資料</a> -->
    <form action="result.php" method="post" autocomplete="off">
        <div>身高: <input type="munber" name="height" size="5"> cm</div>
        <div>體重: <input type="munber" name="weight" size="5"> m</div>
        <p></p>
        <div><input type="submit" value="計算BMI"></div>
    </form>
</body>
</html>