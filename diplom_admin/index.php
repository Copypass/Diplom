<!DOCTYPE html>
<?php 
header('Content-Type: text/html; charset=utf-8');
session_start();
include_once("config.php");
$authtxt = "";
if(isset($_POST['username']))
{
	$login=mysqli_real_escape_string($db,$_GET['username']);
    $password = md5(mysqli_real_escape_string($db,$_GET["password"]));
    $query="SELECT id,login,password,type from users
	WHERE login = '$login' and password = '$password'";
	$result =  mysqli_query($db,$query);
	if($result)
	{
		if(mysqli_num_rows($result) > 0)
		{
			$row = mysqli_fetch_row($result);
			$_SESSION['id']=$row[0];
			$_SESSION['login']=$row[1];
			$_SESSION['password']=$row[2];
			$_SESSION['type']=$row[3];
			$authtxt = "Вы успешно авторизированы";
			header("Location:pages/main.php");
		}
	}else
	{
		$authtxt = "Неверный логин или пароль";
	}
}
if(isset($_GET['act']))
{
	if($_GET['act'] == "exit")
	session_destroy();
}
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Авторизация</title>
<link rel="stylesheet" href="bootstrap/css/login.css" type="text/css">

<div id="main-wrapper" class="b-login-main-wrapper"><div class="i-report-wr"><div class="i-form-wr"><div class="i-list-wr">
<div id="overlay" class="hide"></div>
<div id="content" class="tab-content active" data-tabid="tab1"><div id="login-wrapper">

<div id="login-form"><div id="login-form-form">
<form name="login" id="logon-form" method="POST" action="">


<table>
<tbody><tr><td colspan="2"><div id="login-logo"><label><h1>Авторизация </h1></label></div></td></tr>
<tr>
<td class="left"><label>Логин</label></td>
<td><input type="text" class="b-input b-input_for_login" name="username" value="" id="username"></td>
</tr>
<tr>
<td class="left"><label>Пароль</label></td>
<td><input type="password" class="b-input b-input_for_login" name="password" value="" id="password"></td>
</tr>

<tr>
<td class="left"></td>
<td><div class="button"><input type="submit" class="b-button b-button_type_login" value="Войти" id="submit"></div></td>
</tr>
</tbody></table>

</form></div></div>
<div class="b-login-links"><?php echo $authtxt;?></div>

</div></div>
</div></div></div></div>


               

</body></html>