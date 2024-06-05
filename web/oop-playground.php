<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

const PROJECT_ROOT = __DIR__ . '/../';
require_once PROJECT_ROOT . "src/components/HtmlTag.php";
require_once PROJECT_ROOT . "src/components/bootstrap/Alert.php";
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
                $tag = new HtmlTag(null, 'alert alert-primary', 'Кошка', ['box-shadow'=> '10px 10px 5px 0px black'] );

                echo $tag->render();
                $styleTypes = ['primary', 'warning', 'denger', 'secondary', 'success'];
                for ($i=2; $i<=5; $i++){
                    $type = $styleTypes[array_rand($styleTypes)];
                    $tag = new HtmlTag(null, 'alert alert-'.$type, "Это уведомление № $i в стиле \"$type\"", ['box-shadow'=> '10px 10px 5px 0px black'] );

                    echo $tag->render();
                }
                for ($i=2; $i<=5; $i++){
                    $type = $styleTypes[array_rand($styleTypes)];
                    $alert = new Alert( "Это уведомление № $i в стиле \"$type\"", $type, ['box-shadow'=> '10px 10px 5px 0px black']  );
                    

                    echo $alert->render();
                }
            ?>
        </div>
    </main>
</body>
