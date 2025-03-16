create table utilisateur(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) not null,
    email VARCHAR(150) unique not null,
    password VARCHAR(255) not null,
    salt BINARY(16) not null
);

create table transacations(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT(100) not null,
    montant INT(1000) not null,
    type_transaction ENUM('achat','vente') not null,
    date_transaction DATE not null,
    constraint FK_USER_ID FOREIGN KEY (user_id) references utilisateur(id)
);