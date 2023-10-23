<?php
class IrudiGeometrikoa{
    
    private $izena;
    private $kolorea;
    

    function __construct() {
        
    }
    
    /**
     * @return mixed
     */
    public function getKolorea()
    {
        return $this->kolorea;
    }

    /**
     * @param mixed $kolorea
     */
    public function setKolorea($kolorea)
    {
        $this->kolorea = $kolorea;
    }
    /**
     * @return mixed
     */
    public function getIzena()
    {
        return $this->izena;
    }
    
    /**
     * @param mixed $izena
     */
    public function setIzena($izena)
    {
        $this->izena = $izena;
    }
    
    public function idatzi() {
        echo $this->izena;
        echo"<br>";
        echo $this->kolorea;
        echo"<br>";
    }
    
}