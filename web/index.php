<?php

const PROJECT_ROOT = __DIR__ . '/../';
require_once PROJECT_ROOT . 'src/utils.php';


// error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup-errors', 1);

$selectedMaterial = 'Шрот';

?>
                              
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/x-icon" href="favicon.ico" rel="icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/site.css?v=1">
    <link rel="stylesheet" href="css/style.css">
    <title>Калькулятор</title>

</head>
<body class="d-flex flex-column h-100">
    <header id="header">
        <nav id="w0" class="navbar-expand-mb navbar-dark bg-dark navbar">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img class="logo" src="img/logo.png" alt="ЭФКО">
                </a>
            </div>
        </nav>
    </header>
    <main id="main" class="flex-shrink-0" role="main">
        <div class="container" id="main-block">
            <div class="text-center mb-4 mt-3">
                <h1>Калькулятор стоимости доставки сырья</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 border rounded-3 p-4 shadow">
                    <form id="calculate_form" action="/" method="post">
                        <div class="mb-3 required">
                            <label class="form-label" for="month-select">Месяц</label>
                            <select id="month-select" class="form-select" name="months" aria-required="true">
                                <option value="" disabled selected>Выбери параметр</option>
                                <?php foreach($list['months'] as $value): ?>
                                <option <?= getSelectedAttributeOnInputCondition($_POST, 'months', $value); ?>
                                     value="<?= $value; ?>">
                                    <?= mb_convert_case($value, MB_CASE_TITLE, "UTF-8"); ?>
                                </option>
                            <?php endforeach; ?>
                            </select>
 
                        </div>
                        <div class="mb-3 required">
                            <label class="form-label" for="tonnage-selection">Тоннаж</label>
                            <select id="tonnage-selection" class="form-select" name="tonagges" aria-required="true">
                                <option value="" disabled selected>Выбери параметр</option>
                                <?php foreach($list['tonagges'] as $value): ?>
                                <option <?= getSelectedAttributeOnInputCondition($_POST, 'tonagges', $value); ?>
                                value="<?= $value; ?>">
                                <?= mb_convert_case($value, MB_CASE_TITLE, "UTF-8"); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 required">
                            <label class="form-label" for="raw_type-selection">Тип сырья</label>
                            <select id="raw_type-selection" class="form-select" name="raw_type" aria-required="true">
                                <option value="" disabled selected>Выбери параметр</option>
                                <?php foreach($list['raw_type'] as $value): ?>
                                <option <?= getSelectedAttributeOnInputCondition($_POST, 'raw_type', $value); ?>
                                value="<?= $value; ?>">
                                <?= mb_convert_case($value, MB_CASE_TITLE, "UTF-8"); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        

                        <button type="submit" id="calculate_button" class="btn btn-success">Рассчитать</button>
                        <a href="/" type="button" class="btn btn-danger">Сброс</a>
                    </form>
                </div>
            </div>
        </div>
        <?php if(empty($_POST) === false): ?>
 
            <?php $cost = findPrice($_POST['months'], $_POST['raw_type'], (int)$_POST['tonagges'], $prices); ?>
  
            <div id="result" class="mb-4">
                <div class="row justify-content-center mt-5">
                    <div class="col-md-3 me-3">
                        <div class="card shadow-lg">
                            <div class="card-header bg-success text-white" style="font-weight: bold; font-size: 17px;">
                                Введённые данные:
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Месяц: </strong> <?= mb_convert_case($_POST['months'], MB_CASE_TITLE, 'UTF-8') ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Тоннаж: </strong> <?= $_POST['tonagges'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Тип сырья: </strong> <?= mb_convert_case($_POST['raw_type'], MB_CASE_TITLE, 'UTF-8') ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Итог, руб.: <?= $cost?></strong> 
                                </li>
                            </ul>
                        </div>
                    </div>                
                <div class="col-md-6 table-responsive border rounded-1 shadow-lg p-0">
                        <table class="table table-hover table-striped text-center mb-0">
                        <thead>
                            <tr>
                                <th>Т/М</th>
                                <?php foreach(getPriceTonnage($_POST['raw_type'], $prices) as $tonnage): ?>
                                    <th><?= $tonnage ?></th>
                                    <?php endforeach; ?>
                            </tr>
                        </thead>
                            <tbody>
                            <?php foreach(getPriceMonths($_POST['raw_type'], $prices) as $month): ?>
                                <tr>
                                    <td>
                                        <?=  mb_convert_case($month, MB_CASE_TITLE, 'UTF-8') ?>
                                    </td>
                                    <?php foreach(getPriceByRawTypeandMonths($_POST['raw_type'], $month, $prices) as $tonnage => $price):?>
                                        <td class = "<?= getStyleOnCondition($_POST['months'], (int)$_POST['tonagges'], $month, $tonnage); ?>">
                                         <?= $price ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
<?php endif ?>
    </main>
    <footer id="footer" class="mt-auto py-3 bg-light">
        <div class="container">
            <div class="row text-muted">
                <div class="col-md-6 text-center text-md-start">&copy; ЭФКО</div>
            </div>
        </div>
    </footer>
</body>
</html>