<?php
require './../db/conexao.php';

define('TITLE', 'ALTERAR PERFIL');

include './../includes/header.php';

// RETORNA OS DADDOS JÁ CADASTRADOS DO USUÁRIO
$query = $conn->prepare("SELECT * FROM tb_user
                          WHERE id_user = ?;");
$query->execute([$_SESSION['id_user']]);
$return = $query->fetch(PDO::FETCH_ASSOC);
extract($return);

if (isset($_POST['alterar'])) {
  if (empty($_POST['nm_user']) || empty($_POST['email']) || empty($_POST['dt_nasc'])) {
    $erro_null = '<p>Todos os campos são obrigatórios!</p>';
  } else {
    $u_nm_user = clean($_POST['nm_user']);
    $u_email = clean($_POST['email']);
    $u_dt_nasc = clean($_POST['dt_nasc']);

    // VERIFICA NM_USER -> CHECA SE HÁ APENAS LETRAS, CASO NÃO RETORNA UM ERRO
    if (!preg_match("/^[a-zA-ZÀ-ú]*$/", $u_nm_user)) {
      $erro_nmUser = "* Somente permitido letras";
    }

    // VERIFICA SE O EMAIL É VALIDO, CASO NÃO RETORNA UM ERRO
    if (!filter_var($u_email, FILTER_VALIDATE_EMAIL)) {
      $erro_email = "* Formato de email inválido";
    }

    // VERIFICA SE A DT_NASC É VÁLIDA, CASO NÃO RETORNA UM ERRO
    $current_date = date('Y-m-d');
    if ($u_dt_nasc < '1922-01-01' || $u_dt_nasc > $current_date) {
      $erro_dtNasc = "* Digite uma data de nascimento válida";
    }

    if (!isset($erro_nmUser) && !isset($erro_email) && !isset($erro_dtNasc)) {
      $query = $conn->prepare("SELECT email FROM tb_user WHERE email = ? LIMIT 1");
      $query->execute([$u_email]);
      $result = $query->fetch(PDO::FETCH_ASSOC);

      if ($query->rowCount() > 0 && $u_email != $email) {
        $erro_email = "Email já cadastrado";
      } else {
        $query = $conn->prepare("UPDATE tb_user 
                                  SET nm_user = ?, email = ?, dt_nasc = ? 
                                  WHERE id_user = ? ");
        $query->execute([$u_nm_user, $u_email, $u_dt_nasc, $_SESSION['id_user']]);

        header('Location: ./perfil_view.php?alert');
      }
    }
  }
}
?>
<main class="relative">
  <form class="perfil" method="post">
    <div class="alert-perfil">
      <?php if (isset($erro_null)) echo $erro_null; ?>
    </div>

    <div class="perfil-dados">
      <article>
        <h3 class="<?php if (isset($erro_nmUser)) echo 'error'; ?>">Nome do usuário:</h3>
        <input class="<?php if (isset($erro_nmUser)) echo 'error'; ?>" type="text" name="nm_user" maxlength="45" value="<?= $nm_user ?>">
        <span><?php if (isset($erro_nmUser)) echo $erro_nmUser ?></span>
      </article>

      <article>
        <h3 class="<?php if (isset($erro_email)) echo 'error'; ?>">Email:</h3>
        <input class="<?php if (isset($erro_email)) echo 'error'; ?>" type="email" name="email" maxlength="150" value="<?= $email ?>">
        <span><?php if (isset($erro_email)) echo $erro_email ?></span>
      </article>

      <article>
        <h3 class="<?php if (isset($erro_dtNasc)) echo 'error'; ?>">Data de nascimento:</h3>
        <input class="<?php if (isset($erro_dtNasc)) echo 'error'; ?>" type="date" name="dt_nasc" value="<?= $dt_nasc ?>">
        <span><?php if (isset($erro_dtNasc)) echo $erro_dtNasc ?></span>
      </article>
    </div>

    <div class="perfil-acoes">
      <a href="./perfil_view.php">voltar</a>
      <button type="submit" name="alterar">salvar</button>
    </div>
  </form>
</main>

<?php
include './../includes/footer.php';
?>