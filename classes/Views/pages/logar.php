<?php
if(!file_exists('classes/config.php')){

    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/");
    die();
}
?>

<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--========== BOX ICONS ==========-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <!--========== CSS ==========-->
        <link rel="stylesheet" href="<?= INCLUDE_CSS_T01 ?>login.css">
    </head>
    <body>

        <!--========== SECTION ==========-->


        <section id="" class="section-login-redefirnir">
            <div class="form-box">
                <div class="button-box">
                    <div id="btn"></div>
                    <button type="button" id="redefinir-senha-btn" class="toggle-btn">Redefinir Email</button>
                    <button type="button" id="entrar-btn" class="toggle-btn">Entrar</button>
                    <button type="button" id="redefinir-email-btn" class="toggle-btn">Redefinir Senha</button>
                </div>
                <form method="post" id="redefinir-senha" class="input-grupo">
                    <input type="text" name="emailantigo" class="input-field" placeholder="Email atual" required>
                    <input type="text" name="emailnovo" class="input-field" placeholder="Email novo" required>
                    <input type="password" name="pass" class="input-field" placeholder="Senha" required>
                    <button type="submit" name="acaoEM" class="submit-btn">Redefinir</button>
                </form>
                <form method="post" id="entrar" class="input-grupo">
                    <input type="text" name="user" class="input-field" placeholder="Email" required>
                    <input type="password" name="password" class="input-field" placeholder="Senha" required>
                    <input type="checkbox" class="chech-box"><span class="chech-box-txt">Lembra senha</span>
                    <button type="submit"name="acaoLo" class="submit-btn">Entrar</button>
                </form>
                <form method="post" id="redefinir-email" class="input-grupo">
                    <h1 class="txt-redefirnir">Escreva seu email a baixo para redefir sua senha!</h1>
                    <input type="text" name="email" class="input-field redefinir" placeholder="Email" required>
                    <button type="submit" name="acaoRe" class="submit-btn">Redefinir</button>
                </form>
            </div>
        </section>
    </body>
</html>