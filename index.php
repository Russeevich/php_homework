<?
    function printMessage($message){
        echo "$message <br>";
    }

    $bmw = array(
        'model' => 'X5',
        'speed' => 120,
        'doors' => 5,
        'year' => '2015'
    );

    $toyota = array(
        'model' => 'Camry',
        'speed' => 200,
        'doors' => 5,
        'year' => '2018'
    );

    $opel = array(
        'model' => 'Astra',
        'speed' => 110,
        'doors' => 5,
        'year' => '2012'
    );

    $new_arr = array(
        'bmw' => $bmw,
        'toyota' => $toyota,
        'opel' => $opel
    );

    foreach($new_arr as $key => $value){
        printMessage("CAR $key");
        printMessage($value['model'].' '.$value['speed'].' '.$value['doors'].' '.$value['year']);
    }
?>