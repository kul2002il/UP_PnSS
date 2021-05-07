<h1>Страница для тестов</h1>
<?php
global $passwordSalt;
?>
sudo  - <?= crypt("sudo" , $passwordSalt) ?> <br>
admin - <?= crypt("admin", $passwordSalt) ?> <br>
user  - <?= crypt("user" , $passwordSalt) ?> <br>
