START TRANSACTION;
-- ジャンルテーブル作成-- 
CREATE TABLE genres
(genre_code        CHAR(6), -- ジャンルID
 genre_name        VARCHAR(30) NOT NULL, -- ジャンル名
 genre_level       INT NOT NULL, -- 階層
 parent_genre_code CHAR(6), -- 親ジャンルID
 PRIMARY KEY (genre_code),
 FOREIGN KEY (parent_genre_code) REFERENCES genres(genre_code)
);
-- 商品テーブル作成-- 
CREATE TABLE items
(item_id               INT AUTO_INCREMENT, -- 商品ID
 item_name             VARCHAR(255) NOT NULL, -- 商品名
 item_image            VARCHAR(255), -- 商品画像
 explanation           TEXT, -- 説明
 unit_price            INT NOT NULL, -- 単価
 genre_code            CHAR(6) NOT NULL, -- ジャンルコード
 set_discount_division CHAR(5), -- セット割引区分
 PRIMARY KEY (item_id),
 FOREIGN KEY (genre_code) REFERENCES genres(genre_code)
);
-- ユーザーテーブル作成-- 
CREATE TABLE users
(user_id      INT AUTO_INCREMENT, -- 会員番号
 user_name    VARCHAR(30) NOT NULL, -- 会員名
 mail_address VARCHAR(255) NOT NULL, -- メールアドレス
 password     VARCHAR(255) NOT NULL, -- パスワード
 address      VARCHAR(255) NOT NULL, -- 住所
 point        INT NOT NULL, -- 所持ポイント
 PRIMARY KEY (user_id)
);
-- カートテーブル作成-- 
CREATE TABLE carts
(cart_id                  INT AUTO_INCREMENT, -- カートID
 user_id                  INT NOT NULL, -- 会員番号
 item_id                  INT NOT NULL, -- 商品ID
 quantity                 INT NOT NULL, -- 数量
 registration_status      BOOLEAN NOT NULL, -- 登録情報フラグ
 PRIMARY KEY (cart_id),
 FOREIGN KEY (user_id) REFERENCES users(user_id),
 FOREIGN KEY (item_id) REFERENCES items(item_id)
);
-- 注文テーブル作成-- 
CREATE TABLE orders
(order_id    CHAR(12), -- 注文番号 
 user_id     INT NOT NULL, -- 会員番号
 total_price INT NOT NULL, -- 合計金額
 PRIMARY KEY (order_id),
 FOREIGN KEY (user_id) REFERENCES users(user_id)
);
-- 注文明細テーブル作成-- 
CREATE TABLE orderdetails
(order_id                CHAR(12), -- 注文番号
 order_detail_id         INT AUTO_INCREMENT NOT NULL, -- 注文明細番号
 item_id                 INT NOT NULL, -- 商品ID
 quantity                INT NOT NULL, -- 数量
 estimated_delivery_date DATE NOT NULL, -- 配送予定日
 PRIMARY KEY (order_detail_id, order_id),
 FOREIGN KEY (order_id) REFERENCES orders(order_id),
 FOREIGN KEY (item_id) REFERENCES items(item_id)
);
COMMIT;