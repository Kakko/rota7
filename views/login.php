<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rota 7 - Gerenciamento</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/login.css">
</head>
<body>
    <div class="loginPage">
        <div class="loginArea">
            <form method="POST">
                <input type="text" name="login_action" value="login" hidden>
                <div class="loginTitle">
                    <span>Rota 7 - Gerenciamento</span>
                </div>
                <div class="loginInput">
                    <div class="inputArea">
                        <div class="iconInput">
                            <img src="<?php BASE_URL; ?>assets/icons/user_icon.svg">
                        </div>
                        <div class="inputField">
                            <input type="text" class="loginField" name="email" placeholder="Digite seu e-mail" autocomplete="no">
                        </div>
                    </div>
                    <div class="inputArea">
                        <div class="iconInput">
                            <img src="<?php BASE_URL; ?>assets/icons/pass_icon.svg">
                        </div>
                        <div class="inputField">
                            <input type="password" class="loginField" name="password" placeholder="Digite sua senha" autocomplete="no">
                        </div>
                    </div>
                </div>
                <div class="loginButton">
                    <button>Entrar</button>
                </div>
                <div class="loginDisclaimer">
                    <span>Desenvolvido por TechWeb7</span>
                </div>
            </form>
        </div>
    </div>
</body>
</html>