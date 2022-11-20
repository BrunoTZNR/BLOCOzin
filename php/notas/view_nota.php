<?php
  require './../db/conexao.php';

  define('TITLE', 'NOTA');

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
?>

<section id="fade" class="hide"></section>
<section id="modal" class="hide">
  <article>
    <h5>Tem certeza que quer deletar a nota:</h5>
    <p><?=$titulo?></p>
  </article>

  <div>
    <button id="close">Não</button>
    <button id="delete" value="<?=$_GET['id_nota']?>">Sim</button>
  </div>
</section>

<main class="relative">
  <section class="nota">
    <div class="alert-nota">
      <?php if (isset($_GET['alert'])) echo alertView($_GET['alert']); ?>
    </div>

    <div class="nota-dados">
      <article class="input-container">
        <input type="text" name="titulo" maxlength="70" value="<?=$titulo?>" disabled>
        <label class="label-nota" for="titulo">Título</label>
      </article>

      <article class="input-container">
        <textarea name="conteudo" disabled><?=$conteudo?></textarea>
        <label class="label-nota" for="conteudo">Conteúdo</label>
      </article>
    </div>
    
    <div class="nota-acoes">
      <button id="confirm">deletar</button>

      <a href="./alterar_nota.php?id_nota=<?=$_GET['id_nota']?>">editar</a>
    </div>
  </section>
</main>

<?php
  include './../includes/footer.php';
?>