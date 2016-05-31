<meta charset="UTF-8">
<style>
    body {
        font-family: "Courier";
    }
    table {
        border: solid 1px #7c8080;
    }
    table tbody td:nth-child(1n+3) {
        text-align: right;
    }
</style>
<div>
    <b>Корзина покупателя</b>
</div>
<table>

<?php
//рекурсивная функция
//Из массива REQUEST переписываем данные в одноименные строки, проверка по отметке на чекбоксе.
//Счетчик считает сколько товаров выбрано

function ReArray($arr,$i)
{
    global $name;
    global $cost;
    global $action;
    global $count;
    $sch = 0;
    if (isset($arr['vibor'][$i])) {
        $name[$i] = $arr['name'][$i];
        $cost[$i] = $arr['cost'][$i];
        $action[$i] = $arr['action'][$i];
        $count[]=$arr['count'][$i];
        $sch=1;
    }
    if($i==0){return $sch;}
    else{
        return $sch+=ReArray($arr,--$i);
    }

}


    $summa = 0;
    $textTable = '';

    $products = array(
        [
                'name'      => '<a>   iPhone          </a>',
                'cost'      => 25500,
                'count'     => 1,
                'available' => false,
                'action'    => 20,
        ],
        array(
                'name'      =>  '   fmModule         _',
                'cost'      => 1500,
                'count'     => 2,
                'available' => true,
        ),
        array(
                'name'      => '   packet          _',
                'cost'      => 15,
                'count'     => 11,
                'available' => true,
        ),
        [
            'name'      => '   Bently (model)',
            'cost'      => 150,
            'count'     => 1,
            'available' => true,
            'action'    => 100,
        ]
    );
?>
    <thead>
        <tr> <td style="width:10px;">#</td> <td>Name</td> <td>Cost</td> <td>Count</td><td>Sum</td><td>Available</td><td>Sale</td></tr>
    </thead>
    <tbody>
<?php
    const COL_LINE = '</td><td>';
    const BEGIN_ROW = '<tr><td>';
    const END_ROW = '</td></tr>';

$i = 0;


do
{
    $textAvailable = 'товар ' . ($products[$i]['available'] ? 'готово к отгрузке' : 'ждем поставки');

    $action = array_key_exists( 'action', $products[$i] ) ? (100 - $products[$i]['action']) / 100 : 1;

    $summaProduct = $products[$i]['cost'] * $products[$i]['count'] * $action;

    $textTable .= BEGIN_ROW. ($i + 1);

    foreach ($products[$i] as $key => $value)
    {
       switch ($key)
       {
         case 'count':
             $textTable.= COL_LINE . $value . COL_LINE . $summaProduct;
               break;
         case 'available' :
             $textTable.= COL_LINE . $textAvailable;
               break;
           default:
               $textTable.= COL_LINE . $value;

       }
    }
    $textTable .=   END_ROW;

    $summa += $summaProduct;
    $i++;
}
while( $i < count($products) );


$name=array();
$cost=array();
$action=array();
$count=array();



// вызов рекурсивной функции
$chetchik=ReArray($_REQUEST,count($_REQUEST)-1);

// Сортировка по возрастанию цены
array_multisort($cost,$name,$action,$count);
echo '<br> <b> Дополнительно выбрано </b>'.$chetchik.' шт <b>товаров</b>';

// формируем строку для вывода в таблицу
for($i=0;$i<$chetchik;$i++) {
    
//        if (!isset($_REQUEST['count'])) {
//            $_REQUEST['count'] = 1;
//        }
    
        $_REQUEST['summa'] = $cost[$i] * $count[$i] * (100 - $action[$i]) / 100;
        $textTable .= BEGIN_ROW . (count($products) + $i+1) . COL_LINE . $name[$i] . COL_LINE . $cost[$i]
            . COL_LINE . $count[$i] . COL_LINE . $_REQUEST['summa'] . COL_LINE . ' ' . COL_LINE . $action[$i] . END_ROW;

        $summa += $_REQUEST['summa'];

}
$textTable .= BEGIN_ROW . ' '. COL_LINE. "Общая сумма заказа " . COL_LINE . ' '. COL_LINE.' '. COL_LINE.$summa . END_ROW;


$temp = 'textTable';

echo  $$temp;




?>
    </tbody>
</table>

