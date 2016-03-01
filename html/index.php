<!DOCTYPE html>
<link href="style/login.css" type="text/css" rel="stylesheet">
<link href="style/base.css" type="text/css" rel="stylesheet">
    
<html>
    <head>
        <title>460DB - LOGIN</title>
    </head>
    <body style="background-color:#EEE">
        <div class="flex vertCenter horiCenter pageContent">
            <div>
                <div class="roundGrayLoginBox">
        <h2 class="centerHori login_header">Welcome!</h2>
        <div class="centerHori">
        User: <input id="username" type="text"></br>
        Pass: <input id="password" type="password"></br>
        <a href="home.html"><button id="submit" type="button"> Login </button></a>
        </div>
                </div>
            </div>
        </div>
        </hr>
        <div style="text-align:center"><?php date(M-D-Y); ?> </div>
    </body>
</html>
