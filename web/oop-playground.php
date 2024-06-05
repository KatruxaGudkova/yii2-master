<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

const PROJECT_ROOT = __DIR__ . '/../';
require_once PROJECT_ROOT . "src/components/HtmlTag.php";
?>

<!DOCTYPE html>
<html lang="ru-RU" class="h-100">
<head>
    <title>
        ООП Песочница
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link type="image/x-icon" href="favicon.ico" rel="icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="d-flex flex-column h-100">
    <main id="main" class="flex-shrink-0" role="main">

        <div class="container" id="main-block">
            <div class="text-center mb-4 mt-3">
                <h1>ООП Песочница</h1>
            </div>
            <?php
                $tag = new HtmlTag();
                $tag->name = 'div';
                $tag->innerHtml = 'Кошка';
                echo $tag->render();
            ?>
        </div>
    </main>
</body>
