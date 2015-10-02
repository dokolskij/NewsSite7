<!DOCTYPE html>
<html lang="en">
<head>
	<title>Все новости</title>
</head>
<body>
<?php foreach ($items as $item): ?>
	<h1><?php echo $item->title; ?></h1>
	<div><?php echo $item->text; ?></div>
<?php endforeach; ?>
</body>
</html>
