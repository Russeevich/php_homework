<?
    function printMessage($message){
        echo "$message<br>";
    }

    function task1($arr, $concat = false){
        if(!$concat){
            foreach($arr as $value){
                echo "<p>$value</p>";
            }
        } else {
            return implode(',', $arr);
        }
    }

    function sum($carry, $item){
        $carry += $item;
        return $carry;
    }

    function multi($carry, $item){
        $carry *= $item;
        return $carry;
    }

    function minus($carry, $item){
        $carry -= $item;
        return $carry;
    }

    function div($carry, $item){
        $carry /= $item;
        return $carry;
    }

    function task2($type, ...$numbers){
        switch($type){
            case '*':
                return array_reduce($numbers, 'multi', 1);
            case '/':
                return array_reduce($numbers, 'div', 1);
            case '+':
                return array_reduce($numbers, 'sum');
            case '-':
                return array_reduce($numbers, 'minus');
        }
    }

    function task3($a, $b){
        if(is_int($a) && is_int($b)){
            echo "<table>
                    <thead>
                ";

            for($i = 1; $i <= $a; $i++){
                echo "<th style='padding: 10px;'>$i</th>";    
            }
            echo "</thead>";

            echo "<tbody>";
        
            for($i = 1; $i <= $b; $i++){
                echo "<tr>";
                for($j = 1; $j <= $a; $j++){
                    $res = $i * $j;
                    echo "<td style='text-align: center;'>$res</td>";
                }
                echo "</tr>";
            }

            echo "
                </tbody>
            </table>
            ";
        } else {
            echo 'Вводимы числа должны быть целочисленными';
        }
    }

    function task4(){
        printMessage(date("d.m.y H:i"));
        printMessage(date("d.m.y H:i:s"));
    }

    function task5(){
        $string_1 = 'Карл у Клары украл Кораллы';
        $string_2 = 'Две бутылки лимонада';

        printMessage(preg_replace('/К/', '', $string_1));

        printMessage(preg_replace('/Две/', 'Три', $string_2));
    }

    function task6_1(){
        $file = fopen('test.txt', 'w');

        fwrite($file, 'Hello again!');
        fclose($file);
        
        printMessage('Файл успешно создан!');
    }

    function task6_2($filename){
        $file = fopen($filename, 'r');

        while(!feof($file)){
            $str = htmlentities(fgets($file));
            printMessage($str);
        }
    }


?>