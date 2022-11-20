<?php
  require './../db/conexao.php';

  if(!isset($_SESSION['id_user'])){
    session_unset();
    session_destroy();
    header('Location: ./../../index.php?alert');
  }

  // DELETA AS NOTAS
  $query = $conn->prepare("DELETE n FROM tb_nota n
                          JOIN tb_user u ON n.fk_user = u.id_user
                          WHERE fk_user = ?");
  $query->execute([$_SESSION['id_user']]);

  // DELETA O USUÁRIO
  $query = $conn->prepare("DELETE FROM tb_user 
                          WHERE id_user = ?");
  $query->execute([$_SESSION['id_user']]);

  // DIRECIONA PARA INDEX COM ALERT DE DELETE
  session_unset();
  session_destroy();
  header('Location: ./../../index.php?alert=delete');
?>
