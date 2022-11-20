USE blocozin_0369;

CREATE TABLE IF NOT EXISTS tb_user(
	id_user INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nm_user VARCHAR(45) NOT NULL,
    email VARCHAR(150) NOT NULL,
    senha VARCHAR(50) NOT NULL,
    dt_nasc DATE NOT NULL
)ENGINE=InnoDB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS tb_nota(
	id_nota INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(50) NOT NULL,
    conteudo TEXT NOT NULL,
    dt_nota TIMESTAMP NOT NULL,
    fk_user INT NOT NULL,
    FOREIGN KEY (fk_user) REFERENCES tb_user(id_user)
)ENGINE=InnoDB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;