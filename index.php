<?php
function carga($clase)
{
    require "$clase.php";
}

session_start();
//generamos lienzo para pintar en él


spl_autoload_register(carga);
$lienzo = new Lienzo(400, 300, 50, 50);

$html_lineas="";
$html_puntos="";

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
