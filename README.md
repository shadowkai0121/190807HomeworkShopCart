# ShopCart

### 資料庫

![Homework_ER](C:/Users/admin/Downloads/Homework_ER.png)

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

