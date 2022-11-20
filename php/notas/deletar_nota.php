<?php
  require './../db/conexao.php';

  $query = $conn->prepare("DELETE FROM tb_nota 
                          WHERE id_nota = ? AND fk_user = ?");
  $query->execute([$_GET['id_nota'], $_SESSION['id_user']]);

  header('Location: ./listagem_nota.php?alert=delete');