-- カートテーブル作成-- 
CREATE TABLE carts
(cart_id                  INT AUTO_INCREMENT, -- カートID
 user_id                  INT NOT NULL, -- 会員番号
 item_id                  INT NOT NULL, -- 商品ID
 quantity                 INT NOT NULL, -- 数量
 registration_status      BOOLEAN NOT NULL, -- 登録情報フラグ
 PRIMARY KEY (user_id)
 FOREIGN KEY user_id REFERENCES users(user_id)
 FOREIGN KEY item_id REFERENCES items(item_id)
);
