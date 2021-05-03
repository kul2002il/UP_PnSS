<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Главная</title>
</head>
<body>
	<nav>
		<ul>
			<?php
				$pages = scandir("application/controllers");
				unset($pages[0]);
				unset($pages[1]);
				foreach ($pages as $value)
				{
					$matches = [];
					preg_match("#controller_(.*).php#", $value, $matches);
					$page = $matches[1];
					?>
			<li>
				<a href="<?= $page ?>">
					<?= $page ?>
				</a>
			</li>
					<?php
				}
			?>
		</ul>
	</nav>
	<?php include 'application/views/'.$content_view; ?>
</body>
</html>
