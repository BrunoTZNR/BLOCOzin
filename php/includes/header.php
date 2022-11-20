<?php
if (!isset($_SESSION['id_user'])) {
  session_unset();
  session_destroy();
  header('Location: ./../../index.php');
}

switch (TITLE) {
  case 'PERFIL':
    $navbar = '<li><a class="" href="./../notas/listagem_nota.php">notas</a></li>
              <li><a class="" href="./../notas/cadastrar_nota.php">escrever</a></li>
              <li><a class="active" href="./perfil_view.php">perfil</a></li>';
    $script = '<script src="./../../assets/js/perfil.js" defer></script>
              <script src="./../../assets/js/modal-perfil.js" defer></script>';
    break;

  case 'ALTERAR PERFIL':
    $navbar = '<li><a class="" href="./../notas/listagem_nota.php">notas</a></li>
              <li><a class="" href="./../notas/cadastrar_nota.php">escrever</a></li>
              <li><a class="active" href="./perfil_view.php">perfil</a></li>';
    $script = '<script src="./../../assets/js/perfil.js" defer></script>';
    break;

  case 'ESCREVER':
    $navbar = '<li><a class="" href="./listagem_nota.php">notas</a></li>
              <li><a class="active" href="./cadastrar_nota.php">escrever</a></li>
              <li><a class="" href="./../perfil/perfil_view.php">perfil</a></li>';
    $script = '<script src="./../../assets/js/nota.js" defer></script>';
    break;

  case 'LISTAGEM':
    $navbar = '<li><a class="active" href="./listagem_nota.php">notas</a></li>
              <li><a class="" href="./../notas/cadastrar_nota.php">escrever</a></li>
              <li><a class="" href="./../perfil/perfil_view.php">perfil</a></li>';
    $script = '<script src="./../../assets/js/home.js" defer></script>';
    break;

  case 'NOTA':
    $navbar = '<li><a class="" href="./listagem_nota.php">notas</a></li>
              <li><a class="" href="./cadastrar_nota.php">escrever</a></li>
              <li><a class="" href="./../perfil/perfil_view.php">perfil</a></li>';
    $script = '<script src="./../../assets/js/nota.js" defer></script>
                <script src="./../../assets/js/modal.js" defer></script>';
    break;

  default:
    $navbar = '<li><a class="" href="./listagem_nota.php">notas</a></li>
              <li><a class="" href="./cadastrar_nota.php">escrever</a></li>
              <li><a class="" href="./../perfil/perfil_view.php">perfil</a></li>';
    $script = '<script src="./../../assets/js/nota.js" defer></script>';
    break;
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
  <title>Blocozin - <?= TITLE ?></title>

  <link rel="website icon" href="./../../assets/img/icon_blocozin.png" type="png">

  <!-- CSS -->
  <link rel="stylesheet" href="./../../assets/css/style.css">
  <!-- SCRIPT JS -->
  <?= $script ?>
  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body>
  <header class="header-container">
    <section class="header">
      <h1 class="header-title">BLOCO<span>zin</span></h1>

      <nav class="header-navbar">
        <ul>
          <?= $navbar ?>

          <li><a href="./../logout.php">sair</a></li>
        </ul>
      </nav>

      <div class="header-menu">
        <span></span>
        <span></span>
      </div>
    </section>
  </header>