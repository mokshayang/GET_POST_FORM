<?php
$acc='moksha';
$pw='1234';

$formAcc=$_POST['acc'];
$formPw=$_POST['pw'];

if($acc==$formAcc && $pw==$formPw){
    header("location:login.php?result=success");
} else{
    header("location:login.php?result=fail");
    
}
?>