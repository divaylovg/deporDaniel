<?php
/**
 * Created by PhpStorm.
 * User: dani
 * Date: 24/01/19
 * Time: 21:36
 */

class Equipo
{

    protected $nombre;
    protected $puntuacion;
    protected $foto;
    protected $fechaCreacion;

    /**
     * Equipo constructor.
     * @param $nombre
     * @param $puntuacion
     * @param $foto
     * @param $fechaCreacion
     */
    public function __construct($nombre=null, $puntuacion=null, $foto=null, $fechaCreacion=null)
    {
        $this->nombre = $nombre;
        $this->puntuacion = $puntuacion;
        $this->foto = $foto;
        $this->fechaCreacion = $fechaCreacion;
    }


    /**
     * @return null
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param null $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return null
     */
    public function getPuntuacion()
    {
        return $this->puntuacion;
    }

    /**
     * @param null $puntuacion
     */
    public function setPuntuacion($puntuacion): void
    {
        $this->puntuacion = $puntuacion;
    }

    /**
     * @return null
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param null $foto
     */
    public function setFoto($foto): void
    {
        $this->foto = $foto;
    }

    /**
     * @return null
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * @param null $fechaCreacion
     */
    public function setFechaCreacion($fechaCreacion): void
    {
        $this->fechaCreacion = $fechaCreacion;
    }



}