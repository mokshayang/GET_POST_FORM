<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員登入</title>
</head>

<body>
    <a href="index.php">回首頁</a>
    <br>
    <h1>會員登入</h1>
    <?php
    $showForm = true;
    if (isset($_GET['result'])) {
        switch ($_GET['result']) {
            case 'success':
                echo "<div style='color:blue;'>";
                echo "帳密正確，登入成功";
                echo "</div>";
                $showForm = false;
                break;
            case 'fail':
                echo "<div style='color:red;'>";
                echo "帳密錯誤，登入失敗";
                echo "</div>";
                break;
        }
    }
    ?>
    <?php
    if ($showForm) {
    ?>
        <form action="check.php" method="post" autocomplete="off">
            <div>帳號: <input type="munber" name="acc" size="8"></div>
            <div>密碼: <input type="munber" name="pw" size="8"></div>
            <p></p>
            <div><input type="submit" value="登入"></div>
        </form>
    <?php
    }
    ?>

</body>

</html>