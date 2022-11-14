--ジャンルテーブル作成--
CREATE TABLE genres
(genre_id        CHAR(5), -- ジャンルID
 genre_name      VARCHAR(30) NOT NULL, -- ジャンル名
 parent_genre_id CHAR(5), -- 親ジャンルID
 PRIMARY KEY (genre_id),
 FOREIGN KEY (parent_genre_id) REFERENCES genres(genre_id)
);