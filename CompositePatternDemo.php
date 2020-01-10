<html>
<body>
<head>
<style>
body {font : 12px verdana; font-weight:bold}
td {font : 11px verdana;}
</style>
</head>

<?php

abstract class Construccio {
  
  private $nombre;
  private $superficie;
  private $construccion = array();
  
  public function add(Construccio  $elemento) {
     array_push($this->construccion, $elemento);
  }
  
  public function remove(Construccio  $elemento) {
     array_pop($this->construccion);
  }
        
  public function hasChildren() {
    return (bool)(count($this->construccion) > 0);
  }
    
  public function getChild($i) {
    return $construccion[i];
  }
    
  public function getDescription() {
    echo "- un/a " . $this->getNombre(). " de ".$this->getSuperficie() . "m2";
    if ($this->hasChildren()) {
      echo " que incluye:<br>";
      foreach($this->construccion as $elemento) {
         echo "<table cellspacing=5 border=0><tr><td>&nbsp;&nbsp;&nbsp;</td><td>-";
         $elemento->getDescription();
         echo "</td></tr></table>";
      }        
    }
  }
  
 public function setName($nombre) {
   $this->nombre = $nombre;
 }
  
 public function getNombre() {
   return $this->nombre;
 }
         
 public function setSuperficie($superficie) {
    $this->Superficie = (double) $superficie;
 }

 public function getSuperficie() {
   return $this->Superficie;
  }
  public function sumar($suma){
    if ($this->hasChildren()) {
      foreach($this->construccion as $elemento) {
        
        $suma=$elemento->getSuperficie()+$elemento->sumar($suma);
        
        $elemento->sumar($suma);


      }
    }
    
    return $suma;
  }
}

class Habitacion extends Construccio {
  function __construct($name,$superficie) {
    parent::setName($name);
    parent::setSuperficie($superficie);
  }      
}

class Puerta extends Construccio {
  function __construct($name,$superficie) {
   parent::setName($name);
   parent::setSuperficie($superficie);
  }
}

class Ventana extends Construccio {
  function __construct($name,$superficie) {
    parent::setName($name);
    parent::setSuperficie($superficie);
  }
}

$Casa = new Puerta("Puerta entrada/salida",5);

$Recibidor = new Habitacion("Recibidor",10);
$Puerta1 = new Puerta("Puerta1",0.1);
$Puerta2= new Puerta("Puerta2",0.1);
$Puerta3= new Puerta("Puerta3",0.1);
$Puerta4= new Puerta("Puerta4",0.1);
$Puerta5= new Puerta("Puerta5",0.1);
$Puerta6= new Puerta("Puerta6",0.1);
$Comedor=new Habitacion("Comedor",20);
$Pasillo=new Habitacion("Pasillo",10);
$Ventana1=new Ventana("Ventana 1", 0.1);
$Ventana2=new Ventana("Ventana 2", 0.1);
$Baño=new Habitacion("Baño",10);
$Cocina= new Habitacion("Cocina",12);
$Habitacion1=new Habitacion("Habitacion1",5);

$Comedor->add($Ventana1);
$Habitacion1->add($Ventana2);
$Puerta6->add($Habitacion1);
$Puerta5->add($Cocina);
$Puerta4->add($Baño);
$Puerta3->add($Comedor);
$Pasillo->add($Puerta3);
$Pasillo->add($Puerta4);
$Pasillo->add($Puerta5);
$Pasillo->add($Puerta6);
$Puerta1->add($Pasillo);
$Recibidor->add($Puerta1);
$Recibidor->add($Puerta2);
$Casa->add($Recibidor);



//$guitar = new Guitar("gibson les paul");

echo "List of Instruments: <p>";
$Casa->getDescription();
//$guitar->getDescription();
echo "Superficie Total: ".$Casa->sumar(0);
?>

</body>
</html>
