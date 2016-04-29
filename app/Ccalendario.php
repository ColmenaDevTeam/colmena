<?php
/**
* @author: QSoto
*/
namespace Colmena;

use Illuminate\Database\Eloquent\Model;

class Ccalendario extends Model
{
    protected $table = "t_calendarios";
    protected $primaryKey = "fecLab";
    public $timestamps = false;

    public static function Meses(){
    	$meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
    	return $meses;
    }

    public static function diasAno(){
    	for ($j=1; $j <=12 ; $j++) {
    		$month = strtotime(date('Y').'-'.$j);
    		//dd($month);
		    $week = 1;
		    for($i=1;$i<=date('t',$month);$i++) {
		        $day_week = date('N', strtotime(date('Y').'-'.$j.'-'.$i));
		        //dd($day_week);
		        $months[$j][$week][$day_week] = $i;
		        if ($day_week == 7) { $week++; };
	    	}
    	}
    	return $months;
    }

    public static function tieneRegistro(){
        $registros= Ccalendario::all();
        if (count($registros)) return true;

        else return false;
    }

    public static function comparaAno(){
        $registros= Ccalendario::all();
        $Ocalendario = $registros->first();
        $ultima= $Ocalendario->fecLab;
        $actual = date("Y-m-d");

        $aActual=explode("-", $actual);
        $aUltima=explode("-", $ultima);

        if ($aActual[0]>$aUltima[0])
            return true;
        else return false;
    }

    public static function getProxima($actual){

    }
}
