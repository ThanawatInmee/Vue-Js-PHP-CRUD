# โค้ดนี้ทำเพื่อการศึกษานะครับ

- เคดิตเจ้าของ : [Ohmiler](https://github.com/ohmiler)
- พัฒนาระบบโดย : PHP, VUE JS
- ผมได้ทำการจัดโค้ดให้เรียบง้ายต่อการอ่าน และ ทำความเข้าใจนะครับ
- ที่เหลือต้องศึกษาเพิ่มเอาเองนะครับ

# แก้ไขไฟล์ที่จำเป็น | config.php

```php
<?php 

	$host = "localhost"; // ตั้งโฮรส แต่ ปกติแล้วไม่จำเป็นต้องไปยุ่งกับมันก็ได้นะครับ
	$user = "root"; // ตั้งชื่อ
	$pass = ""; // ตั้งรหัสผ่านฐานข้อมูล
	$database = ""; // ตั้งชื่อฐานข้อมูล

	try {
		$db = new PDO("mysql:host=$host;dbname=$database", $user, $pass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}

 ?>
```
