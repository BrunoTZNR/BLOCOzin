<?php
require './../db/conexao.php';

define('TITLE', 'LISTAGEM');

include './../includes/header.php';

$query = $conn->prepare("SELECT id_nota, titulo, dt_nota 
                          FROM tb_user u 
                          JOIN tb_nota n ON u.id_user = n.fk_user
                          WHERE id_user = ?");
$query->execute([$_SESSION['id_user']]);

if ($query->rowCount() > 0) {
  $bloco = '';
  while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
    $bloco .= '<div class="listagem-bloco">
                <h4 class="listagem-bloco-title">' . $result['titulo'] . '</h4>

                <span>' . $result['dt_nota'] . '</span>

                <a href="./view_nota.php?id_nota=' . $result['id_nota'] . '">ver nota</a>
              </div>';
  }
} else {
  $bloco = '<div class="listagem-bloco listagem-bloco-null">
              <a href="./cadastrar_nota.php">escreva sua primeria nota agora</a>
            </div>';
}
?>

<div class="alert-listagem">
  <?php if(isset($_GET['alert'])) echo alertListagem($_GET['alert']) ?>
</div>

<main class="relative">
  <section class="listagem">
    <?=$bloco?>
  </section>
</main>

<?php
include './../includes/footer.php';
?>