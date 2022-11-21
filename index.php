<?php
declare (strict_types = 1);
const OPERATION_EXIT = 0;
const OPERATION_ADD = 1;
const OPERATION_DELETE = 2;
const OPERATION_PRINT = 3;

$operations = [
    OPERATION_EXIT => OPERATION_EXIT . '. Завершить программу.',
    OPERATION_ADD => OPERATION_ADD . '. Добавить товар в список покупок.',
    OPERATION_DELETE => OPERATION_DELETE . '. Удалить товар из списка покупок.',
    OPERATION_PRINT => OPERATION_PRINT . '. Отобразить список покупок.',
];

$items = ["ppp", "yyy", "kkk"];
$operationList = checkingGoods($operations, $items);

function inputNum() : string
{
    return trim(fgets(STDIN));
}// принимает введенное значение
function shoppingList(array $items) : string
{
    if (count($items)) {
        return 'Ваш список покупок: ' . "\n" . implode("\n", $items) . "\n" . 'Выберите операцию для выполнения: ' . PHP_EOL;
    } else {
        return 'Ваш список покупок пуст.' . "\n" . 'Выберите операцию для выполнения: ' . PHP_EOL;
    }
}// выводит список товаров|пуст
function checkingGoods(array $operations, array $items) : string
{
    if (count($items)) {
        return implode(PHP_EOL, $operations) . PHP_EOL . '> ';
    } else {
        unset($operations[2]);
        return implode(PHP_EOL, $operations) . PHP_EOL . '> ';
    }
} // должна проверять список покупок и выводить список операций
function deleteProduct ($itemName,&$items){
    if (in_array($itemName, $items, true) === false){
        return 'Нет такого товара:' . PHP_EOL . '> ';
    }if (in_array($itemName, $items, true) !== false) {
        while (($key = array_search($itemName, $items, true)) !== false) {
            unset($items[$key]);
            return shoppingList($items);
        }
    }
} // удаляет товары




do {
//system('clear');
    system('cls'); // windows

    echo shoppingList($items) . $operationList; // вывели список покупок + список операций

    $operationNumber = inputNum();

    echo 'Выбрана операция: ' . $operations[$operationNumber] . PHP_EOL;

    switch ($operationNumber) {
        case OPERATION_ADD:
            echo "Введение название товара для добавления в список: \n> ";
            $itemName = inputNum();
            $items[] = $itemName;
            break;

        case OPERATION_DELETE:
            echo shoppingList($items);
            echo 'Введение название товара для удаления из списка:' . PHP_EOL . '> ';
            $itemName = inputNum();
            echo deleteProduct ($itemName,$items);
            break;

        case OPERATION_PRINT:
            echo shoppingList($items);
            echo 'Всего ' . count($items) . ' позиций. ' . PHP_EOL;
            echo 'Нажмите enter для продолжения';
            fgets(STDIN);

        case (!(($operationNumber >= 0) && ($operationNumber <=3))):

            echo '!!! Неизвестный номер операции, повторите попытку.' . PHP_EOL;
    }
} while ($operationNumber > 0);

echo 'Программа завершена' . PHP_EOL;

