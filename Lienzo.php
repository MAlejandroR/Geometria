<?php

class Lienzo {

    private $canvas;
    private $width;
    private $height;

    /**
     * Lienzo constructor.
     * @param $w
     * @param $h
     * @param $l
     * @param $r
     * Observa como curiosidad cómo es posible concatenar dentro de la asignación heredoc
     * En general esta será la forma de llamar a una función, a través de una variable
     */
    public function __construct($w, $h, $l, $r) {

        function concatenar($a, $b) {
            return $a . $b;
        }

        $f = "concatenar";
        $this->width = $w;
        $this->height = $h;
        $this->canvas = <<<FIN
        <canvas id="canvas"  width=$this->width height=$this->height
         style=margin-left={$f("$l", "px")}, margin-right={$f($r, "px")}">
             <p>Su navegador no soporta canvas :(</p>
        </canvas>
FIN;
    }

    public function __toString() {
        return $this->canvas;
    }

    function getWidth() {
        return $this->width;
    }

    function getHeight() {
        return $this->height;
    }

}
