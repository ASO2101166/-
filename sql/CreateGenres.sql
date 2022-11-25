-- ジャンルテーブル作成-- 
CREATE TABLE genres
(genre_code        CHAR(6), -- ジャンルID
 genre_name        VARCHAR(30) NOT NULL, -- ジャンル名
 genre_level       INT NOT NULL, -- 階層
 parent_genre_code CHAR(6), -- 親ジャンルID
 PRIMARY KEY (genre_code),
 FOREIGN KEY (parent_genre_code) REFERENCES genres(genre_code)
);
