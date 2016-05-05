<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Panamerican::Login</title>
<style>

@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,600,700);

*, *:after, *:before {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    font-weight: normal;
    margin: 0;
    outline: 0 none;
    font-family: "Open Sans";
    padding: 0;
}

body {
  background: #F7F7F7;
  font-family: "Open Sans";
}
.loading {
    margin: 10% auto 15px;
    position: relative;

    height: 40px;
    width: 40px;
}


.login {
    width: 300px;
    margin: 0 auto;
}
.login form {
  width: 100%;
}
input {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(0, 0, 0, 0.3);
    border-radius: 4px 4px 4px 4px;
    box-shadow: 0 -5px 45px rgba(100, 100, 100, 0.2) inset, 0 1px 1px rgba(255, 255, 255, 0.2);
    color: #333;
    font-size: 18px;
    margin-bottom: 10px;
    outline: medium none;
    padding: 10px;
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
    width: 100%;
}

button {
    background: linear-gradient(to bottom, #009EFF 0px, #0075BC 100%) repeat scroll 0 0 transparent;
    border: 1px solid rgba(0, 0, 0, 0.3);
    border-bottom: 1px solid rgba(0, 0, 0, 0.55);
    border-radius: 6px 6px 6px 6px;
    box-shadow: 0 1px 0 #E6F5FF inset;
    color: #FFFFFF;
    cursor: pointer;
    display: block;
    margin: 0 auto;
    padding: 10px 25px;
    text-shadow: 0 1px rgba(0, 0, 0, 0.3);
    width: 100%;
}
</style>

</head>
<body id="login-bg" > 
<div class="loading">
  <div class="circle light"></div>
  <div class="circle dark"></div>
  <div class="branding"></div>
</div>

<div class="login">
 
  <form method="post">
  <div id="logo-login">
		<a href="index.html" style="margin:auto"><img src="<?php  config::ruta();?>images/shared/logo.png" width="" height="" alt="" /></a>
      <h4 style=" margin:auto; text-align:center; font-weight:bold;color:#666"><?PHP  echo SUCURSAL;?></h4>
	</div>
    <input type="text" name="username" placeholder="Username" required="required" />
    <input type="password" name="password" placeholder="Password" required="required" />
    <button type="submit" class="btn btn-primary btn-block btn-large">INGRESAR</button>
     <input type="hidden" name="grabar" value="si"/>
    </form>
</div>

</body>
</html>