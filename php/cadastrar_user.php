<?php
require './db/conexao.php';

$email = '';
$nm_user = '';
$dt_nasc = '';

if (isset($_POST['cadastrar'])) {
    if (empty($_POST['nm_user']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['rePassword']) || empty($_POST['dt_nasc'])) {
        $erro_empty = "Todos os campos são obrigatórios!";
    } else {
        $nm_user = clean($_POST['nm_user']);
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        $rePassword = clean($_POST['rePassword']);
        $dt_nasc = clean($_POST['dt_nasc']);

        // VERIFICA NM_USER -> CHECA SE HÁ APENAS LETRAS, CASO NÃO RETORNA UM ERRO
        if (!preg_match("/^[a-zA-ZÀ-ú]*$/", $nm_user)) {
            $erro_nmUser = "Somente permitido letras";
        }

        // VERIFICA SE O EMAIL É VALIDO, CASO NÃO RETORNA UM ERRO
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erro_email = "Formato de email inválido";
        }

        // VERIFICAR SE PASSWORD TEM MAIS QUE 5 DIGITOS, CASO NÃO RETORNA UM ERRO
        if (strlen($password) < 5) {
            $erro_password = "Senha deve ter 5 caracteres ou mais";
        }
        // VERIFICAR SE REpASSWORD É IGUAL A PASSWORD, CASO NÃO RETORNA UM ERRO
        if ($password !== $rePassword) {
            $erro_rePassword = "Senha e repetição de senha diferentes";
        }
        // CASO NOA HAJA ERROS NA SENHA ENCRIPTOGRAFA A MESMA
        if (!isset($erro_password) && !isset($erro_rePassword)) {
            $password = sha1($password);
        }

        // VERIFICA SE A DT_NASC É VÁLIDA, CASO NÃO RETORNA UM ERRO
        $current_date = date('Y-m-d');
        if ($dt_nasc < '1922-01-01' || $dt_nasc > $current_date) {
            $erro_dtNasc = "Digite uma data de nascimento válida";
        }

        if (!isset($erro_nmUser) && !isset($erro_email) && !isset($erro_password) && !isset($erro_rePassword) && !isset($erro_dtNasc)) {
            $query = $conn->prepare("SELECT email FROM tb_user WHERE email = ? LIMIT 1");
            $query->execute([$email]);

            if ($query->rowCount() > 0) {
                $erro_email = "Email já cadastrado";
            } else {
                $query = $conn->prepare("INSERT INTO tb_user (nm_user, email, senha, dt_nasc) VALUES (?,?,?,?)");
                $query->execute([$nm_user, $email, $password, $dt_nasc]);

                header('location: ./../index.php?alert=sucess');
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="Author" content="Bruno TZNR">
    <title>Blocozin - LOGIN</title>

    <link rel="website icon" href="./../assets/img/icon_blocozin.png" type="png">

    <!-- CSS -->
    <link rel="stylesheet" href="./../assets/css/style.css">
    <!-- SCRIPT JS -->
    <script src="./../assets/js/script.js" defer></script>
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <main class="static">
        <section class="static-container">
            <div class="alert">
                <?php if (isset($erro_empty)) echo "<p>$erro_empty</p>"; ?>
            </div>

            <form class="form-user" method="post">
                <h1 class="title-user">cadastrar</h1>

                <article class="input-container <?php if (isset($erro_nmUser)) echo 'error' ?>">
                    <input class="<?php if (isset($erro_nmUser)) echo 'ierror' ?>" type="text" name="nm_user" maxlength="45" 
                        value="<?php if (!isset($erro_nmUser) || isset($erro_empty)) echo $nm_user ?>">
                    <label class="label-user <?php if (isset($erro_nmUser)) echo 'lerror' ?>" for="nm_user">Nome do usuário</label>
                    <span><?php if (isset($erro_nmUser)) echo $erro_nmUser ?></span>
                </article>

                <article class="input-container <?php if (isset($erro_email)) echo 'error' ?>">
                    <input class="<?php if (isset($erro_email)) echo 'ierror' ?>" type="email" name="email" maxlength="150" 
                        value="<?php if (!isset($erro_email) || isset($erro_empty)) echo $email ?>">
                    <label class="label-user <?php if (isset($erro_email)) echo 'lerror' ?>" for="email">Email</label>
                    <span><?php if (isset($erro_email)) echo $erro_email ?></span>
                </article>

                <article class="input-container <?php if (isset($erro_password)) echo 'error' ?>">
                    <input class="<?php if (isset($erro_password)) echo 'ierror' ?>" type="password" name="password" minlength="5" maxlength="50">
                    <label class="label-user <?php if (isset($erro_password)) echo 'lerror' ?>" for="password">Senha</label>
                    <span><?php if (isset($erro_password)) echo $erro_password ?></span>
                </article>

                <article class="input-container <?php if (isset($erro_rePassword)) echo 'error' ?>">
                    <input class="<?php if (isset($erro_rePassword)) echo 'ierror' ?>" type="password" name="rePassword" minlength="5" maxlength="50">
                    <label class="label-user <?php if (isset($erro_rePassword)) echo 'lerror' ?>" for="rePassword">Repetir senha</label>
                    <span><?php if (isset($erro_rePassword)) echo $erro_rePassword ?></span>
                </article>

                <article class="input-container <?php if (isset($erro_dtNasc)) echo 'error' ?>">
                    <input class="<?php if (isset($erro_dtNasc)) echo 'ierror' ?>" type="date" name="dt_nasc" 
                        value="<?php if (!isset($erro_dtNasc) || isset($erro_empty)) echo $dt_nasc ?>">
                    <label class="label-user <?php if (isset($erro_dtNasc)) echo 'lerror' ?>" for="dt_nasc">Data de nascimento</label>
                    <span><?php if (isset($erro_dtNasc)) echo $erro_dtNasc ?></span>
                </article>

                <section>
                    <a class="user-button" href="./../index.php">login</a>

                    <button class="user-button" type="submit" name="cadastrar">cadastrar-se</button>
                </section>
            </form>
        </section>
    </main>
</body>

</html>