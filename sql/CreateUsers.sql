--ユーザーテーブル作成--
CREATE TABLE users
(user_id      CHAR(8), -- 会員番号
 user_name    VARCHAR(30) NOT NULL, -- 会員名
 mail_address VARCHAR(255) NOT NULL, -- メールアドレス
 password     VARCHAR(255) NOT NULL, -- パスワード
 address      VARCHAR(255) NOT NULL, -- 住所
 point        INT NOT NULL, -- 所持ポイント
 PRIMARY KEY (user_id)
);
