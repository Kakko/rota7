<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/login.css">
</head>
<body>
    <div class="bg_login">
        <div class="login_form">
            <h1>Sistema Market</h1>
            <div class="login_data">
                <form method="POST">    
                    <label>E-mail:</label>
                    <div class="input_mk">
                        <div class="user_icon"></div>
                        <div class="form_input">
                            <input type="mail" name="email" autocomplete="off">
                        </div>
                    </div>
                    <label>Password:</label>
                    <div class="input_mk">
                        <div class="pass_icon"></div>
                        <div class="form_input">
                            <input type="password" name="password" autocomplete="off">
                        </div>
                    </div>
                    <input type="submit" class="sub_button" value="ENTRAR">
                </form>
            </div>
        </div>
    </div>
</body>
</html>