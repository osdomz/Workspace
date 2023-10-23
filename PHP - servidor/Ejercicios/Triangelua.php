<?php

class Triangelua extends IrudiGeometrikoa{
    
    private $altuera;
    private $oinarria;
    
    function __construct() {}
    /**
     * @return mixed
     */
    public function getAltuera()
    {
        return $this->altuera;
    }

    /**
     * @return mixed
     */
    public function getOinarria()
    {
        return $this->oinarria;
    }

    /**
     * @param mixed $altuera
     */
    public function setAltuera($altuera)
    {
        $this->altuera = $altuera;
    }

    /**
     * @param mixed $oinarria
     */
    public function setOinarria($oinarria)
    {
        $this->oinarria = $oinarria;
    }

    
  
    public function idatzi() {
        parent::idatzi();
        echo $this->altuera;
        echo"<br>";
        echo $this->oinarria;
        echo"<br>";
    }
    public function areaKalkulatu(){
        echo"AREA: ".($this->oinarria * $this->altuera)/2;
    }
    
    
}