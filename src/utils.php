<?php

include_once PROJECT_ROOT . '/src/utils.php';



$list = require_once PROJECT_ROOT . '/config/lists.php';
$prices = require_once PROJECT_ROOT . '/config/prices.php';



function getSelectedAttributeOnInputCondition(array $input, string $inputName, mixed $condition, bool $asInt = false): ?string
{
    if (isset($input[$inputName]) === false) {
        return null;
    }

    $condition = $asInt === true ? (int)$condition : (string)$condition;

    if ($input[$inputName] !== $condition) {
        return null;
    }

    return 'selected';
}


function findPrice(string $month, string $rawType, int $tonnage, array $prices) 
{
    if (isset($prices[$rawType][$month][$tonnage]) === true) {
        return $prices[$rawType][$month][$tonnage];
    }
    throw new LogicExection('Стоимость для ведённых параметров не найдена' . $month . $tonnage . $rawType);

}

function getPriceTonnage(string $rawType, array $prices)
{
    if (isset($prices[$rawType]) === true) {
        $fitsMonths = array_key_first($prices[$rawType]);
        return array_keys($prices[$rawType][$fitsMonths]);
    }
    throw new LogicExection('Стоимость для типа не найдена' . $rawType);
}


function getPriceMonths(string $rawType, array $prices) 
{
    if (isset($prices[$rawType]) === true) {
        return array_keys($prices[$rawType]);
    }
    throw new LogicExection('Стоимость для типа не найдена' . $rawType);
}


function getPriceByRawTypeandMonths(string $rawType, string $month, array $prices) 
{
    if (isset($prices[$rawType][$month]) === true) {
        return $prices[$rawType][$month];
    }
    throw new LogicExection('Стоимость для типа не найдена' . $rawType);
}

function getStyleOnCondition(string $month, int $tonnage, string $conditionMonths, int $conditionTonnage) 
{
    if ($month !== $conditionMonths){
        return null;
    }
    if ($tonnage !== $conditionTonnage) {
        return null;
    }
    return 'with-border';
}