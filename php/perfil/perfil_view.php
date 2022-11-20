<?php
  require './../db/conexao.php';

  define('TITLE', 'PERFIL');

  include './../includes/header.php';

  $query = $conn->prepare("SELECT * FROM tb_user
                          WHERE id_user = ?;");
  $query->execute([$_SESSION['id_user']]);
  $return = $query->fetch(PDO::FETCH_ASSOC);
  extract($return);
?>

<section id="fade" class="hide"></section>
<section id="modal" class="hide">
  <article>
    <h5>Tem certeza que quer deletar seu usuário?</h5>
    <p><?=$nm_user?></p>
  </article>

  <div>
    <button id="close">Não</button>
    <button id="delete">Sim</button>
  </div>
</section>

<main class="relative">
  <section class="perfil">
    <div class="alert-perfil">
      <?php if (isset($_GET['alert'])) echo '<p>Usuário alterado com sucesso!</p>'; ?>
    </div>

    <div class="perfil-dados">
      <article>
        <h3>Nome do usuário:</h3>
        <p class="perfil-dados-text"><?=$nm_user?></p>
      </article>

      <article>
        <h3>Email:</h3>
        <p class="perfil-dados-text"><?=$email?></p>
      </article>

      <article>
        <h3>Data de nascimento:</h3>
        <p class="perfil-dados-text"><?=date('d/m/Y', strtotime($dt_nasc))?></p>
      </article>
    </div>

    <div class="perfil-acoes">
      <a href="./perfil_alterar.php">editar</a>

      <button id="confirm">deletar</button>
    </div>
  </section>
</main>

<?php
  include './../includes/footer.php';
?>