<?php
date_default_timezone_set('America/Guayaquil');

class Fecha {

  public function getDay($day){
    if($day == "Monday"){
        $dia = "Lunes";
    }
    if($day == "Tuesday"){
        $dia = "Martes";
    }
    if($day == "Wednesday"){
        $dia = "Miercoles";
    }
    if($day == "Thursday"){
        $dia = "Jueves";
    }
    if($day == "Friday"){
        $dia = "Viernes";
    }
    if($day == "Saturday"){
        $dia = "Sábado";
    }
    if($day == "Sunday"){
        $dia = "Domingo";
    }

    return $dia;
  }

  public function getMonth($month){
    if($month == "January"){
        $mes = "Enero";
    }
    if($month == "February"){
        $mes = "Febrero";
    }
    if($month == "March"){
        $mes = "Marzo";
    }
    if($month == "April"){
        $mes = "Abril";
    }
    if($month == "May"){
        $mes = "Mayo";
    }
    if($month == "June"){
        $mes = "Junio";
    }
    if($month == "July"){
        $mes = "Julio";
    }
    if($month == "August"){
        $mes = "Agosto";
    }
    if($month == "September"){
        $mes = "Septiembre";
    }
    if($month == "October"){
        $mes = "Octubre";
    }
    if($month == "November"){
        $mes = "Noviembre";
    }
    if($month == "December"){
        $mes = "Diciembre";
    }

    return $mes;
  }

  public function getYear($year){
    return $year;
  }

  public function getFecha($date){
    $fecha = strtotime($date);

    $n = date("d");
    $d = $this->getDay(date("l", $fecha));
    $m = $this->getMonth(date("F", $fecha));
    $y = $this->getYear(date("Y", $fecha));

    return "$d, $n de $m del $y";
  }

}