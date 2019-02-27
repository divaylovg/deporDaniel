<?php
/**
 * Created by PhpStorm.
 * User: dani
 * Date: 24/01/19
 * Time: 21:32
 */

class Arbitro
{

    protected $nombre;
    protected $edad;
    protected $foto;
    protected $contrasenya;

    /**
     * Arbitro constructor.
     * @param $nombre
     * @param $edad
     * @param $foto
     * @param $contrasenya
     */
    public function __construct($nombre=null, $edad=null, $foto=null, $contrasenya=null)
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->foto = $foto;
        $this->contrasenya = $contrasenya;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * @param mixed $edad
     */
    public function setEdad($edad): void
    {
        $this->edad = $edad;
    }

    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param mixed $foto
     */
    public function setFoto($foto): void
    {
        $this->foto = $foto;
    }

    /**
     * @return mixed
     */
    public function getContrasenya()
    {
        return $this->contrasenya;
    }

    /**
     * @param mixed $contrasenya
     */
    public function setContrasenya($contrasenya): void
    {
        $this->contrasenya = $contrasenya;
    }




}