<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homework_1.6</title>
    <style>
        th{
            padding: 20px;
        }
        td{
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <?
                for($i=1; $i <= 10; $i++) {
                    echo "<th>$i</th>";
                }
            ?>
        </thead>
        <tbody>
            <?
                for($i=1; $i <= 10; $i++){
            ?>
                <tr>
                <?
                    for($j=1; $j <= 10; $j++){
                        $res = $i * $j;

                        if($i % 2 === 0 && $j % 2 === 0){
                            echo "<td>($res)</td>";
                        } elseif($i % 2 !== 0 && $j % 2 !== 0){
                            echo "<td>[$res]</td>";
                        } else {
                            echo "<td>$res</td>";
                        }
                    }
                ?>
                </tr>
            <?
                }
            ?>
        </tbody>
    </table>
</body>
</html>