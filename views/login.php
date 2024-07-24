<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rota 7 Acessórios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/login.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="loginContainer">
        <div class="loginArea">
            <div class="titleArea">
                <h1>Rota 7 Acessórios - Login</h1>
            </div>
            <div class="inputArea">
                <form method="POST">
                    <div class="loginInput">
                        <div class="input-group">
                            <span class="input-group-text"><img src="<?php BASE_URL; ?>assets/icons/login_icon.png"></span>
                            <input type="text" class="form-control form-control-sm" placeholder="E-mail" name="email">
                        </div>
                    </div>
                    <div class="loginInput">
                        <div class="input-group">
                            <span class="input-group-text"><img src="<?php BASE_URL; ?>assets/icons/password_icon.png"></span>
                            <input type="password" class="form-control form-control-sm" placeholder="Senha" name="password">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-sm w-100 loginButton" value="Entrar">
                </form>
            </div>
            <div class="footerArea">
                <span>Desenvolvido por TechWeb7 - Todos os direitos reservados</span>
            </div>
        </div>
    </div>
</body>
</html>