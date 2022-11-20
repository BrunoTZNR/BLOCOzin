<?php
    require './php/db/conexao.php';

    if (isset($_POST['login'])) {
        if (!empty($_POST['email']) || !empty($_POST['password'])) {
            $email = clean($_POST['email']);
            $password = sha1(clean($_POST['password']));

            // CONSULTA O EMAIL E A SENHA DO USUÁRIO
            $query = $conn->prepare("SELECT id_user, email, senha FROM tb_user WHERE email = ? AND senha = ?");
            $query->execute([$email, $password]);

            if ($query->rowCount() > 0) {
                $return = $query->fetch(PDO::FETCH_ASSOC);

                // CASO HAJA RETORNO LEVARÁ PARA A PÁGINA DE LISTAGEM DAS NOTAS QEU O USUÁRIO POSSUI E IRÁ SETAR '$_SESSION['id_user']'
                $_SESSION['id_user'] = $return['id_user'];
                header('Location: ./php/notas/listagem_nota.php');
            } else {
                // CASO NAO HAJA NENHUM RETORNO SE DEFAZ DA SESSÃO E RETORNA PARA A PÁGINA DE LOGIN COMO INVÁLIDO
                session_unset();
                session_destroy();
                header('Location: ./index.php?alert=falid');
            }
        } else {
            header('Location: ./index.php?alert=null');
        }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Site para armazenar notas em blocos">
    <meta name="Author" content="Bruno TZNR">
    <title>Blocozin - LOGIN</title>

    <link rel="website icon" href="./assets/img/icon_blocozin.png" type="png">

    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- SCRIPT JS -->
    <script src="./assets/js/script.js" defer></script>
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <main class="static">
        <section class="static-container">
            <div class="alert">
                <?php if (isset($_GET['alert'])) echo alertLogin($_GET['alert']) ?>
            </div>

            <form class="form-user" method="post">
                <h1 class="title-user">LOGIN</h1>

                <article class="input-container">
                    <input type="email" name="email" maxlength="150">
                    <label class="label-user" for="email">Email</label>
                    <span></span>
                </article>

                <article class="input-container">
                    <input type="password" name="password" minlength="5" maxlength="50">
                    <label class="label-user" for="password">Senha</label>
                    <span></span>
                </article>

                <section>
                    <a class="user-button" href="./php/cadastrar_user.php">cadastrar-se</a>

                    <button class="user-button" type="submit" name="login">entrar</button>
                </section>
            </form>
        </section>
    </main>
</body>

</html>