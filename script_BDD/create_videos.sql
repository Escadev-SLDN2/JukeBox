USE jukebox;

CREATE TABLE videos (
    id int  auto_increment primary key,
    id_yt varchar(12) not null,
    user_id int
);

/* cles etrangeres*/

ALTER TABLE videos
ADD CONSTRAINT fk_user_id_video FOREIGN KEY (user_id) REFERENCES users(id);