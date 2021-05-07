<h1>Страница для тестов</h1>
<?php
$sol = md5("соль");
?>
sudo  - <?= crypt("sudo" , $sol) ?> <br>
admin - <?= crypt("admin", $sol) ?> <br>
user  - <?= crypt("user" , $sol) ?> <br>
