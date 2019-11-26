<?php

class Linea {

    private $p1;
    private $p2;
    private $html;

    public function __construct(Punto $x, Punto $y) {
        $this->p1 = $x;
        $this->p2 = $y;
    }

    /**
     * @param $s tamaño
     * @source dibujamos el punto con el tamaño especificado
     */
    public function dibujar($grosor,$color="#f00") {
        $canvas = <<<FIN
                <script>
      var canvas = document.getElementById("canvas");
  var lienzo = canvas.getContext("2d");
  lienzo.lineWidth = 3//ancho de la línea
  lienzo.strokeStyle = "#$color"; //Color
  lienzo.beginPath(); //Empiezo a dibujar
  lienzo.moveTo({$this->p1->getX()},{$this->p1->getY()}); //Posición inicial
  lienzo.lineTo({$this->p2->getX()},{$this->p2->getY()}); //Posición final
  lienzo.stroke(); //DIBUJA la línea
                </script>
FIN;
        $this->html = $canvas;
    }

    public function __toString() {
        return $this->html;
    }

}
