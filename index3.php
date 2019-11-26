<?php
function carga($clase)
{
    require "$clase.php";
}

session_start();
//generamos lienzo para pintar en él


spl_autoload_register(carga);
$lienzo = new Lienzo(400, 300, 50, 50);

if (isset($_POST['submit'])) {
//Leo variables de sesion si hay
    $puntos = unserialize($_SESSION['puntos']) ?? [];
    $lineas = unserialize($_SESSION['lineas']) ?? [];

    switch ($_POST['submit']) {
        case "Punto":
            $p = new Punto(rand(1, 400), rand(1, 300), $lienzo);
            $puntos[] = $p;
            foreach ($puntos as $punto) {
                $punto->dibujar(rand(1, 5), dechex(rand(1, 16777216)));
                $html_puntos .= $punto;
            }
            break;
        case"Línea":
            $p1 = new Punto(rand(1, 400), rand(1, 300), $lienzo);
            $p2 = new Punto(rand(1, 400), rand(1, 300), $lienzo);
            $l = new Linea($p1, $p2);
            $lineas[] = $l;
            foreach ($lineas as $linea) {
                $linea->dibujar(dechex(rand(1, 4096)));
                $html_lineas .= $linea;
            }

        case "Oculta":
            $html_lineas ="";
            $html_puntos="";
            break;
        case "Muestra":
            foreach ($puntos as $punto) {
                $html_puntos .= $punto;
            }
            foreach ($lineas as $linea) {
                $html_lineas .= $linea;
            }

            break;
        case "Borra":
            session_destroy();
            $puntos=[];
            $lineas=[];
    }
    $_SESSION['puntos']=serialize($puntos);
    $_SESSION['lineas']=serialize($lineas);

}
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
    <input type="submit" value="Borrar" name="submit">

</form>
<?=$lienzo?>
<?=$html_puntos?>
<?=$html_lineas?>

</body>
</html>
