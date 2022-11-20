<?php
  require './../db/conexao.php';

  define('TITLE', 'RESCREVER');

  include './../includes/header.php';

  $query = $conn->prepare("SELECT * FROM tb_nota
                          WHERE id_nota = ? AND fk_user = ?");
  $query->execute([$_GET['id_nota'], $_SESSION['id_user']]);
  
  if($query->rowCount() > 0){
    $result = $query->fetch(PDO::FETCH_ASSOC);
    extract($result);
  }else{
    header('Location: ./listagem_nota.php?alert=null');
  }

  if(isset($_POST['rescrever'])){
    if(empty($_POST['titulo']) || empty($_POST['conteudo'])){
      $erro_empty = "Todos os campos são obrigatórios!";
    }else{
      $titulo = clean($_POST['titulo']);
      $conteudo = clean($_POST['conteudo']);
      $fk_user = clean($_SESSION['id_user']);

      $query = $conn->prepare("UPDATE tb_nota 
                              SET titulo = ?, conteudo = ? 
                              WHERE id_nota= ? AND fk_user = ?");
      $query->execute([$titulo, $conteudo, $_GET['id_nota'], $fk_user]);

      header('Location: ./view_nota.php?id_nota='.$_GET['id_nota'].'&alert=update');
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
        <input type="text" name="titulo" maxlength="70" value="<?=$titulo?>">
        <label class="label-nota" for="titulo">Titulo</label>
      </article>

      <article class="input-container">
        <textarea name="conteudo"><?=$conteudo?></textarea>
        <label class="label-nota" for="conteudo">Conteúdo</label>
      </article>
    
    <div class="nota-acoes">
      <a href="./view_nota.php?id_nota=<?=$_GET['id_nota']?>">voltar</a>

      <button type="submit" name="rescrever">salvar</button>
    </div>
  </form>
</main>

<?php
  include './../includes/footer.php';
?>