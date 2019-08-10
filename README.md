# ShopCart
> 練習目標
> - 原生 PHP 應用
> - 資安
> - Bootstrap3

[資料庫檔案 asstes/homework.sql](./assets/homework.sql)

在XAMPP下執行



網頁登入帳號

admin

admin



### 資料庫

![Homework_ER](./assets/Homework_ER.png)

###### View

| vw_shopcart   | 功能             |
| ------------- | ---------------- |
| productID     | 產品編號         |
| userID        | 使用者編號       |
| productName   | 產品名稱         |
| unitPrice     | 產品單價         |
| quantity      | 目前購買數量     |
| sum           | 目前總價         |
| productPhotoS | 小張的產品圖路徑 |

### 資料夾結構

```bash
+----------------------+
|190807HomeworkShopCart|
+----+---------------+-+
     |               |.htaccess
     |               |index.php
     |     +----+    +---------+
     +-----+Core|
     |     +----+
     |          |App.php
     |          |Controller.php
     |          |Database.php
     |          |Table.php
     |          +--------------+
     |
     |     +------+
     +-----+Models|
     |     +----+-+
     |          |Product.php
     |          |ShopCart.php
     |          |User.php
     |          +------------+
     |
     |     +-----------+
     +-----+Controllers|
     |     +----+------+
     |          |ProductController.php
     |          |MemberController.php
     |          +---------------------+
     |
     |      +-------+         +------+                 +--+
     +------+ Views +----+----+Shared+------------+----+js|
            +-------+    |    +------+            |    +--+
                         |         |Foot.php      |
                         |         |Head.php      |    +---+
                         |         +--------+     +----+css|
                         |                        |    +---+
                         |    +------+            |
                         +----+Member|            |    +---+
                         |    +----+-+            +----+img|
                         |         |Login.php          +---+
                         |         |Register.php
                         |         +------------+
                         |
                         |    +-------+
                         +----+Product|
                              +----+--+
                                   |Product.php
                                   +------------+

```



~~頁面好醜~~