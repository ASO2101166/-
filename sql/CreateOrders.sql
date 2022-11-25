--注文テーブル作成--
CREATE TABLE orders
(order_id    CHAR(12), --注文番号 
 user_id     INT NOT NULL, -- 会員番号
 total_price INT NOT NULL, -- 合計金額
 PRIMARY KEY (order_id)
 FOREIGN KEY user_id REFERENCES users(user_id)
);
