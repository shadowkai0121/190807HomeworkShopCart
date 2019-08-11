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





## Bug?? Transaction 死掉了

### 死亡現場還原

- 測試 db

	```mysql
	DROP DATABASE IF EXISTS test;
	CREATE DATABASE test;
	USE test;
	
	CREATE TABLE test(
	    idx int PRIMARY KEY AUTO_INCREMENT,
	    a int,
	    b varchar(10)
	);
	
	INSERT INTO test(a) VALUES(1);
	
	DELIMITER $$
	DROP PROCEDURE IF EXISTS pro_test;
	CREATE PROCEDURE `pro_test` (uid int)  
	    BEGIN
	        SELECT @oldData := a, @idx := idx FROM test;
	        SET @newData = CONCAT(@idx, "_", @oldData);
	        INSERT INTO test(a, b) VALUES (uid, @newData);
	        SELECT * FROM test;
	    END$$
	DELIMITER ; 
	```

- 測試 php 程式

	```php
	<?php
	$db = new PDO("mysql:host=localhost;dbname=test", "root", "");
	
	$query = "call pro_test(:userid)";
	
	$stmt = $db->prepare($query);
	
	$stmt->bindValue(":userid", floor(rand(1000, 10000)));
	
	if ($stmt->execute()) {
	    echo "executed<br>";
	}
	?>
	```

	**測試結果**: 正常運作

	- PHP
	
		```
		executed
		```
	
	- MySQL
	
		``` mysql
		MariaDB [test]> select * from test;
		+-----+------+------+
		| idx | a    | b    |
		+-----+------+------+
		|   1 |    1 | NULL |
		|   2 | 7875 | 1_1  |
		+-----+------+------+
		
		-- 清除資料
		DELETE FROM test WHERE idx != 1;
		```


- 加入 transaction

	```php
	<?php
	
	$db = new PDO("mysql:host=localhost;dbname=test", "root", "");
	
	$query = "call pro_test(:userid)";
	
	$db->beginTransaction();
	
	echo "Transaction State: {$db->inTransaction()}<br>";
	
	$stmt = $db->prepare($query);
	
	$stmt->bindValue(":userid", floor(rand(1000, 10000)));
	
	if ($stmt->execute()) {
	    echo "executed<br>";
	}
	
	if ($db->commit()) {
	    echo "commit<br>";
	}
	?>
```
	
**測試結果**:  無生命跡象
	
- PHP
	
		```php
		Transaction State: 1
		executed
		// 沒有 commit
	```
	
- MySQL
	
		```bash
		MariaDB [test]> select * from test;
		+-----+------+------+
		| idx | a    | b    |
		+-----+------+------+
		|   1 |    1 | NULL |
		+-----+------+------+
		# 無生命跡象
	```
	
	### 測試
	
	- 改用 query
	
		```php
		<?php
		
		$db = new PDO("mysql:host=localhost;dbname=test", "root", "");
		
		
		$db->beginTransaction();
		
		echo "Transaction State: {$db->inTransaction()}<br>";
		
		if ($db->query("call pro_test('55555555')")) {
		    echo "query executed<br>";
		}
		
		if ($db->commit()) {
		    echo "commit<br>";
		}
		
		// if ($db->rollBack()) {
		//     echo "rollBack<br>";
		// }
		>?
		```
	
		**測試結果**: 正常運作
	
		- PHP
	
			```php
			Transaction State: 1
			query executed
			commit
			// rollBack 一樣正常運作
			```
	
		- MySQL
	
			```mysql
			MariaDB [test]> select * from test;
			+-----+----------+------+
			| idx | a        | b    |
			+-----+----------+------+
			|   1 |        1 | NULL |
			|   4 | 55555555 | 1_1  |
			+-----+----------+------+
			-- 清除資料
			DELETE FROM test WHERE idx != 1;
			```
	
			![question](assets/question.jpg)
	
	- 

