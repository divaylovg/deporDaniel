<?php
/**
 * Created by PhpStorm.
 * User: dani
 * Date: 24/01/19
 * Time: 21:26
 */

class Jugador
{
    protected $nombre;
    protected $edad;
    protected $altura;
    protected $equipo;
    protected $contrasenya;
    protected $foto;

    /**
     * Jugador constructor.
     * @param $nombre
     * @param $edad
     * @param $altura
     * @param $equipo
     * @param $contrasenya
     * @param $foto
     */
    public function __construct($nombre="", $edad="", $altura="", $equipo="", $contrasenya="", $foto="")
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->altura = $altura;
        $this->equipo = $equipo;
        $this->contrasenya = $contrasenya;
        $this->foto = $foto;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getEdad(): string
    {
        return $this->edad;
    }

    /**
     * @param string $edad
     */
    public function setEdad(string $edad): void
    {
        $this->edad = $edad;
    }

    /**
     * @return string
     */
    public function getAltura(): string
    {
        return $this->altura;
    }

    /**
     * @param string $altura
     */
    public function setAltura(string $altura): void
    {
        $this->altura = $altura;
    }

    /**
     * @return string
     */
    public function getEquipo(): string
    {
        return $this->equipo;
    }

    /**
     * @param string $equipo
     */
    public function setEquipo(string $equipo): void
    {
        $this->equipo = $equipo;
    }

    /**
     * @return string
     */
    public function getContrasenya(): string
    {
        return $this->contrasenya;
    }

    /**
     * @param string $contrasenya
     */
    public function setContrasenya(string $contrasenya): void
    {
        $this->contrasenya = $contrasenya;
    }

    /**
     * @return string
     */
    public function getFoto(): string
    {
        return $this->foto;
    }

    /**
     * @param string $foto
     */
    public function setFoto(string $foto): void
    {
        $this->foto = $foto;
    }





}

?>