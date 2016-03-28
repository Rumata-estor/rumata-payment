<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
        <!-- Awesome font -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/sprite.css">
        <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<div class="container">
    <?php echo $content; ?>
    <p style="color: grey"><small>Сайт payment-service.biz не является аффилированным ни с какими другими сайтами.</small></p>
    <div style="border-top-color: #269abc; border-top-width: 1px; border-top-style: solid; padding-top: 10px; width: 90%; margin: 0 auto;">
        <p style="color: grey"><b>s.r.o. „Moderní technologie správa“ &copy;&nbsp;2009-2015</b></p>
    </div>
    <p>&nbsp;</p>
</div>
<!-- Latest Jqwery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<!-- Дпополнительные скрипы на станице и инициализация -->
<?php echo $scripts; ?>
</body>
</html>