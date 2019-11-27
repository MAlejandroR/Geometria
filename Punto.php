<?php

class Punto {

    private $x;
    private $y;
    private $html;

    /**
     * Punto constructor.
     * @param int $x coordenada x
     * @param int $y coordenada y
     * @param Lienzo $canvas lienzo donde pintar el punto
     * @source controlamos las coordenadas en función del tamaña del canvas
     *
     */
    public function __construct(int $x, int $y, Lienzo $canvas) {
        //Nos quedamos el valor en positivo
        $x = abs($x);
        $y = abs($y);

        //si no excedemos el tamaño del canvas asignamos el valor
        //si lo excedemos asignamos el valor medio
        $this->x = $x > $canvas->getHeight() ? intdiv($canvas->get_height, 2) : $x;
        $this->y = $x > $canvas->getWidth() ? intdiv($canvas->get_width, 2) : $y;

        //intdiv => da el valor medio sin decimales (PHP 7 o superior)
    }

    /**
     * @param $s tamaño
     * @source dibujamos el punto con el tamaño especificado
     */
    public function dibujar($size, $color = "#ff2626") {
        $canvas = <<<FIN
        <!--dibujamos en él -->
        <script lang=javascript>
             var canvas = document.getElementById('canvas');
             var ctx = canvas.getContext('2d');
             ctx.fillStyle = "#$color"; // Color rojo
             ctx.beginPath(); // Iniciar trazo
             ctx.arc($this->x, $this->y, $size, 0, Math.PI * 2, true); // Dibujar un punto usando la funcion arc
             ctx.fill(); // Terminar trazo
             </script>
FIN;
        $this->html = $canvas;
    }

    /**
     * @return string si tengo script que dibuje el punto lo retorno
     *                si no retorno sus coordenadas numéricas
     */
    public function __toString() {
        // TODO: Implement __toString() method.
        return isset($this->html) ? $this->html : "X = $this->x Y=$this->y";
    }

    /**
     * @return int
     */
    public function getX(): int {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int {
        return $this->y;
    }

    /**
     * @return mixed
     */
    public function getSize() {
        return $this->size;
    }

}
