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
        <link rel="icon" href="<?= INCLUDE_PATH?>classes/Views/imgsistem/icon.png" type="image/gif">
        <!--========== BOX ICONS ==========-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="<?= INCLUDE_PATH_FULL?>javascript/jquery.mask.min.js"></script>
        <!--========== CSS ==========-->
        <link rel="stylesheet" href="<?= INCLUDE_PATH?>classes/Views/pages/css/stylePainel.css">
        <title>Redefinir Senha - Digital Audience</title>
    </head>
    <body>

        <!--========== SECTION ==========-->


        <section id="" class="section-login-redefirnir">
            <div class="form-box">
                <div class="button-box">
                    <div id="btn" class="edit-redefinir"></div>
                    
                    <button type="button" id="entrar-btn" class="toggle-btn">Redefina sua senha</button>
                    
                </div>
                <form method="post" id="redefinir-senha" class="input-grupo">
                
                <form method="post" id="redefinir-senha" class="input-grupo">
                <input type="text" name="email" class="input-field" placeholder="Email de login" required>
                    <input type="password" name="password" class="input-field" placeholder="Nova Senha" required>
                    <input type="password" name="Cpassword" class="input-field" placeholder="Confirme Senha" required>
                    <button type="submit" name="acaoSe" class="submit-btn">Redefinir</button>
                </form>
                
            </div>
        </section>
    </body>
</html>