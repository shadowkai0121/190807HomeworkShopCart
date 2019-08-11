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
	
	$db->beginTransaction();
	
	echo "Transaction State: {$db->inTransaction()}<br>";
	
	$query = "call pro_test(:userid)";
	
	$stmt = $db->prepare($qㄇuery);
	
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

   

  ## 測試
  
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
  
  		
  
  
  
  ![question](./assets/question.jpg)

- **好像有回傳值**

	```php
	<?php
	$db = new PDO("mysql:host=localhost;dbname=test", "root", "");
	echo "Transaction State: {$db->inTransaction()}<hr>";
	if ($stmt = $db->query("call pro_test('55555555')")) {
	    
	    echo "query executed<hr>";
	    
	    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	        var_dump($row);
	        echo "<br>";
	    }
	    
	    echo "<hr>";
	}
	```

	- PHP

		```php
		Transaction State:
		query executed
		array(2) { ["@oldData := a"]=> string(1) "1" ["@idx := idx"]=> string(1) "1" } 
		```

		

	- MySQL

		```mysql
		MariaDB [test]> select * from test;
		+-----+----------+------+
		| idx | a        | b    |
		+-----+----------+------+
		|   1 |        1 | NULL |
		|  16 | 55555555 | 1_1  |
		+-----+----------+------+
		2 rows in set (0.000 sec)
		-- 清除資料
		DELETE FROM test WHERE idx != 1;
		```

		


- 加上 transaction 看看

   ```php
   <?php
   
   $db = new PDO("mysql:host=localhost;dbname=test", "root", "");
   
   
   $db->beginTransaction();
   
   echo "Transaction State: {$db->inTransaction()}<hr>";
   
   if ($stmt = $db->query("call pro_test('55555555')")) {
       echo "query executed<hr>";
   
       while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
           var_dump($row);
           echo "<br>";
       }
       
       echo "<hr>";
   }
   
   if ($db->commit()) {
       echo "commit<br>";
   }
   ?>
   ```

   **測試結果**: 再次死去

   - PHP

     ```php
     Transaction State: 1
     query executed
     array(2) { ["@oldData := a"]=> string(1) "1" ["@idx := idx"]=> string(1) "1" } 
     // 沒有 commit
     ```
   
  - MySQL
  	```mysql
  	MariaDB [test]> select * from test;
  	+-----+------+------+
  	| idx | a    | b    |
  	+-----+------+------+
  	|   1 |    1 | NULL |
  	+-----+------+------+
  	1 row in set (0.000 sec)
  	```
  
  ![question](./assets/question.jpg)



- 關掉 fetch cursor 看看

	```php
	<?php
	
	$db = new PDO("mysql:host=localhost;dbname=test", "root", "");
	
	
	$db->beginTransaction();
	
	echo "Transaction State: {$db->inTransaction()}<hr>";
	
	if ($stmt = $db->query("call pro_test('55555555')")) {
	    echo "query executed<hr>";
	
	    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	        var_dump($row);
	        echo "<br>";
	    }
	    
	    echo "<hr>";
	}
	
	// 關閉 curosr
	if ($stmt->closeCursor()) {
	    echo "close cursor<br>";
	}
	
	if ($db->commit()) {
	    echo "commit<br>";
	}
	?>
	```

	**測試結果**: 正常運作

	- PHP

		```php
		Transaction State: 1
		query executed
		array(2) { ["@oldData := a"]=> string(1) "1" ["@idx := idx"]=> string(1) "1" } 
		close cursor
		commit
		```

		

	- MySQL

		``` mysql
		MariaDB [test]> select * from test;
		+-----+----------+------+
		| idx | a        | b    |
		+-----+----------+------+
		|   1 |        1 | NULL |
		|  19 | 55555555 | 1_1  |
		+-----+----------+------+
		```

		![scaredjpg](./assets/scaredjpg.jpg)

- 換回 prepare 看看

	```php
	<?php
	
	$db = new PDO("mysql:host=localhost;dbname=test", "root", "");
	
	$db->beginTransaction();
	
	echo "Transaction State: {$db->inTransaction()}<hr>";
	
	$query = "call pro_test(:userid)";
	
	$stmt = $db->prepare($query);
	
	$stmt->bindValue(":userid", floor(rand(1000, 10000)));
	
	if ($stmt->execute()) {
	    echo "executed<hr>";
	
	    // 試試看不使用 fetch
	    // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	    //     var_dump($row);
	    //     echo "<hr>";
	    // }
	}
	
	if ($stmt->closeCursor()) {
	    echo "close cursor<br>";
	}
	
	if ($db->commit()) {
	    echo "commit<br>";
	}
	?>
	```

	**測試結果**: 正常運作

	- PHP

		```php
		Transaction State: 1
		executed
		close cursor
		commit
		```

		

	- MySQL

		```mysql
		MariaDB [test]> select * from test;
		+-----+------+------+
		| idx | a    | b    |
		+-----+------+------+
		|   1 |    1 | NULL |
		|  21 | 1839 | 1_1  |
		+-----+------+------+
		2 rows in set (0.000 sec)
		```



### 問題原因

> cursor 被偷偷打開沒關掉 ?!!!

### 解決方法

- 放棄治療

- 丟給資料庫處理

- 關 cursor