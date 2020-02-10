USE jukebox;

CREATE TABLE users (
    id int auto_increment primary key,
    name varchar(50) not null,
    nickname varchar(25) not null,
    email varchar(50) not null,
    hash_pass varchar(255) not null,
    role varchar(25)
);

INSERT INTO users(
    name,nickname,email,hash_pass,role
    ) VALUES(
        'bob','marlon','bob@gmail.com','ABC$208f','ROLE_USER'
        ),
        ('booba','B2O','booba@hotgame.fr','BGRltlo6','ROLE_ADMIN'
        );
    