CREATE TABLE videos_tags_mapping (
video_id int ,
tag_id int ,
user_id int ,
PRIMARY KEY (video_id, tag_id)
);

/* ici keys secondaire*/

ALTER TABLE videos_tags_mapping
ADD CONSTRAINT fk_video_id FOREIGN KEY (video_id) REFERENCES videos(id);

ALTER TABLE videos_tags_mapping
ADD CONSTRAINT fk_user_id_mapping FOREIGN KEY (user_id) REFERENCES users(id);

ALTER TABLE videos_tags_mapping
ADD CONSTRAINT fk_tag_id FOREIGN KEY (tag_id) REFERENCES tags(id);