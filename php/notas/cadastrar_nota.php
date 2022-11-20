<?php
  require './../db/conexao.php';

  define('TITLE', 'ESCREVER');

  include './../includes/header.php';

  if(isset($_POST['escrever'])){
    if(empty($_POST['titulo']) || empty($_POST['conteudo'])){
      $erro_empty = "Todos os campos são obrigatórios!";
    }else{
      $titulo = clean($_POST['titulo']);
      $conteudo = clean($_POST['conteudo']);
      $dt_nota = date('Y-m-d H:i:s');
      $fk_user = clean($_SESSION['id_user']);

      $query = $conn->prepare("INSERT INTO tb_nota (titulo, conteudo, dt_nota, fk_user) 
                              VALUES (?,?,?,?)");
      $query->execute([$titulo, $conteudo, $dt_nota, $fk_user]);
      $id_nota = $conn->lastInsertId();

      header('Location: ./view_nota.php?id_nota='.$id_nota.'&alert=insert');
    }
  }
?>

<main class="relative">
  <form class="nota" method="post">
    <div class="alert-nota">
      <?php if (isset($erro_empty)) echo "<p>$erro_empty</p>"; ?>
    </div>

    <div class="nota-dados" method="post">
      <article class="input-container">
        <input type="text" name="titulo" maxlength="50">
        <label class="label-nota" for="titulo">Titulo</label>
      </article>

      <article class="input-container">
        <textarea name="conteudo"></textarea>
        <label class="label-nota" for="conteudo">Conteúdo</label>
      </article>
    </div>
    
    <div class="nota-acoes">
      <a href="./listagem_nota.php">voltar</a>

      <button type="submit" name="escrever">cadastrar</button>
    </div>
  </form>
</main>

<?php
  include './../includes/footer.php';
?>