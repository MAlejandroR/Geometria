<?php

function carga($clase) {
    require "$clase.php";
}

session_start();

spl_autoload_register(carga);


$puntos = unserialize($_SESSION['puntos']) ?? [];
$lineas = unserialize($_SESSION['lineas']) ?? [];


//generamos lienzo para pintar en él




$lienzo = new Lienzo(400, 300, 50, 50);


switch ($_POST['submit']) {
    case "Punto":
        $p1 = new Punto(rand(0, 400), rand(0, 300), $lienzo);
        $p1->dibujar(rand(1, 5), dechex(rand(1, pow(2, 24))));
        $puntos[] = $p1;
        //    var_dump($puntos);
        foreach ($puntos as $punto) {
            $html_puntos .= $punto;
        }

        break;
    case "Línea":
        $p1 = new Punto(rand(0, 400), rand(0, 300), $lienzo);
        $p2 = new Punto(rand(0, 400), rand(0, 300), $lienzo);
        $l1 = new Linea($p1, $p2);
        $l1->dibujar(rand(1, 5), dechex(rand(1, pow(2, 24))));
        $lineas[] = $l1;

        foreach ($lineas as $linea) {
            $linea->dibujar(rand(1, 5), dechex(rand(1, pow(2, 24))));
            $html_lineas .= $linea;
        }
        break;
    case "Muestra":
        foreach ($puntos as $punto) {
            $punto->dibujar(rand(1, 5), dechex(rand(1, pow(2, 24))));
            $html_puntos .= $punto;
        }
        foreach ($lineas as $linea) {
            $linea->dibujar(rand(1, 5), dechex(rand(1, pow(2, 24))));
            $html_lineas .= $linea;
        }
        break;

    case "Oculta":
        //No haría falta, ya que no habremos entrado en ningún case
        //y por lo tanto no tendrá valores
        $html_lineas = "";
        $html_puntos = "";
        break;


    case 'Borra':
        $_SESSION['puntos'] = null;
        $_SESSION['lineas'] = null;
        session_destroy();
        break;
}

$_SESSION['puntos'] = serialize($puntos);
$_SESSION['lineas'] = serialize($lineas);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="estilo.css" type="text/css">
    </head>
    <body>
        <form action="index.php" method="post">
            <input type="submit" value="Punto" name="submit">
            <input type="submit" value="Línea" name="submit">
            <input type="submit" value="Oculta" name="submit">
            <input type="submit" value="Muestra" name="submit">
            <input type="submit" value="Borra" name="submit">

        </form>
        <?= $lienzo ?>
        <?= $html_puntos ?>
        <?= $html_lineas ?>

    </body>
</html>
