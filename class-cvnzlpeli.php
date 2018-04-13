<?php
  /**
   *  Clase Pelicula.
   *  Esta clase tiene la información sobre las películas, y las trata como objetos.
   */
  class cvnzl_Pelicula
  {
    private $titulo;
    private $sinopsis;
    private $ID;
    private $ficha_tecnica;
    private $actores;
    private $data;

    public function obtSinopsis()
    {
      return $this->sinposis;
    }

    public function obtTitulo()
    {
      return $this->titulo;
    }

    public function obtFichaTecnica()
    {
      return $this->ficha_tecnica;
    }

    function __construct($datos_basicos = "", $datos_ficha_tecnica = "", $datos_actores = "", $datos_otros = "")
    {
      $this->titulo = $datos_basicos['pel_titulo'];
      $this->sinopsis = $datos_basicos['sinopsis'];
      $this->ID = $datos_basicos['id'];

      $this->ficha_tecnica = $datos_ficha_tecnica;
    }
  }


?>
