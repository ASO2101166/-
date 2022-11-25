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
