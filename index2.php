<?php
spl_autoload_register(function ($clase) {
    require "$clase.php";
});
$n = 0xFFFFFF;
echo $n;
$x1 = $_POST['x1'] ?? 1;
$y1 = $_POST['y1'] ?? 1;
$size1 = $_POST['size1'] ?? 1;

$x2 = $_POST['x2'] ?? 100;
$y2 = $_POST['y2'] ?? 100;
$size2 = $_POST['size2'] ?? 1;

if (isset($_POST['submit'])) {


//leemos las linea anteriores
//array de objetos serializado
    $lineas = $_POST['lineas'];

    $puntos = $_POST['puntos'];

//recuperamos el array de objetos desserializar
//Si no usamos urldecode se pierde la información
    $lineas = unserialize(urldecode($lineas));
    $puntos = unserialize(urldecode($puntos));


    $lienzo = new Lienzo(300, 300, 300, 100);

//Recogemos los nuevos puntos
//Creamos el nuevo punto y la nueva línea
    $x1 = rand(1, 400);
    $x2 = rand(1, 400);
    $y1 = rand(1, 400);
    $y2 = rand(1, 400);
    $color1 = rand();
    $color2 = rand();
    $color3 = rand();
    $p1 = new Punto($x1, $y1, $lienzo);
    $p2 = new Punto($x2, $y2, $lienzo);
    $linea = new Linea($p1, $p2);
    $lineas[] = $linea;
    $puntos[] = ['x1' => $p1, 'x2' => $p2];
//$linea->dibujar(1);


    foreach ($lineas as $linea) {
        $linea->dibujar(1) . "\n<br />";
        $dibujo_lineas .= $linea . "\n<br />";
    }

    foreach ($puntos as $punto) {
        $punto['x1']->dibujar(20) . "\n<br />";
        $dibujo_puntos .= $punto['x1'] . "\n<br />";
        $punto['x2']->dibujar(20) . "\n<br />";
        $dibujo_puntos .= $punto['x2'] . "\n<br />";
    }
//$mis_lineas = serialize($mis_lineas);
    $lineas = urlencode(serialize($lineas));
    $puntos = urlencode(serialize($puntos));
}
?>
<!doctype html>
<html lang="en">
    <head>

    </style>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body><fieldset>
        <fieldset><legent>Datos del punto</legent>
            <form action="index.php" method="post">
                X
                <input type="number" name="x1"  value="<?= $x1 ?>" />
                Y
                <input type="number" name="y1"  value = "<?= $y1 ?>" />
                Tamaño
                <input type="number" name="size1"  value ="<?= $size1 ?>" /><br />
                X
                <input type="number" name="x2"  value="<?= $x2 ?>" />
                Y
                <input type="number" name="y2"  value = "<?= $y2 ?>" />
                Tamaño
                <input type="number" name="size2" value ="<?= $size2 ?>" /><br />
                <fieldset><legend>Opciones</legend>
                    <input type="submit" value="Dibujar puntos" name="submit">
                    <input type="submit" value="Dibujar serie de puntos" name="submit">
                    <input type="submit" value="Dibujar línea" name="submit">
                    <input type="hidden" name="lineas" value='<?= $lineas ?>' />
                    <input type="hidden" name="puntos" value='<?= $puntos ?>' />
                </fieldset>
            </form>
        </fieldset>
        <?= $lienzo ?>

        <?= $dibujo_puntos ?>
        <?= $dibujo_lineas ?>



</body>
</html>
