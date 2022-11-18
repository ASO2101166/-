--商品テーブル作成--
CREATE TABLE items
(item_id               CHAR(8), -- 商品ID
 item_name             VARCHAR(255) NOT NULL, -- 商品名
 item_image            VARCHAR(255) -- 商品画像
 explanation           TEXT, -- 説明
 unit_price            INT NOT NULL, -- 単価
 genre_code            CHAR(6) NOT NULL, -- ジャンルID
 set_discount_division CHAR(5), -- セット割引区分
 PRIMARY KEY (item_id),
 FOREIGN KEY genre_id REFERENCES genres(genre_id)
);
