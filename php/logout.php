<?php
    require './db/conexao.php';

    session_destroy();

    header("Location: ./../index.php");