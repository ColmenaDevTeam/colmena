<?php
/**
*@author QSoto
*/

namespace Colmena\Http\Controllers;

use Illuminate\Http\Request;
use Colmena\Http\Requests;
use Colmena\Http\Controllers\Controller;

use Colmena\Ccalendario as Ccalendario;

class CcalendarioController extends Controller{
    public function __construct(){
       $this->middleware("auth");
    }

    public function getActualizar(){
    	if(!(\Auth::user()->tieneAccion('calendario.actualizar')))
    		return redirect('errores/acceso-negado');

        $months = Ccalendario::diasAno();
        $meses = Ccalendario::Meses();

        if (Ccalendario::tieneRegistro()){

          //Si paso el a#o, se borran todos los registros de las tablas.
          if (Ccalendario::comparaAno())
            Ccalendario::truncate();

          $fechasGuardadas = Ccalendario::all();
      	  return view("calendario.actualizar")->with("months",$months)
      										                    ->with("meses",$meses)
                                              ->with("fechasGuardadas", $fechasGuardadas);
            }
        else
            return view("calendario.actualizar")->with("months",$months)
                                                ->with("meses",$meses);
    }




    public function postActualizar(Request $request){
    	if(!(\Auth::user()->tieneAccion('calendario.actualizar')))
    		return redirect('errores/acceso-negado');

    	if (count($request->get('fechas'))>0) {
        $fechas = $request->get('fechas');

        if (Ccalendario::tieneRegistro()){
            $fechasGuardadas = Ccalendario::all();
            //Verificando si ya esta registrada en la base de datos
            //para sacarla del array, de estar se borra del arreglo
            //De no estar se borra de la base de datos.

            foreach ($fechasGuardadas as $fecha) {
              $izq=0;
              $der=sizeof($fechas)-1;
              $n=-1;

              for ( $i=0; $i <count($fechas) ; $i++ ) {
                $medio = ($izq+$der)/2;
                if ($fechas[$medio]==$fecha->fecLab)
                  $n=$medio;
                elseif ($fechas[$medio] < $fecha->fecLab)
                  $izq = $medio;
                elseif ($fechas[$medio] > $fecha->fecLab)
                  $der = $medio;
              }
              //Sacalo del arreglo
              if ( $n < -1 ) {
                unset($fechas[$n]);
              }
              //Borralo del Calendario
              else {
                /**
                meter aqui la funcion de las tareas
                */
                $fecha->delete();
              }
            }
            /*
            { $izq=0;
              $der=sizeof($a)-1;
              $n=-1;
              while($inico < $ultimo )
               { int $medio=($izq+$der)/2
                    if ($a[$medio]==$valor)
                      {     $n=$medio;   }
                    elseif ($a[$medio] < $valor)
                      { $izq = $medio; }
                    elseif ($a[$medio] > $valor)
                      { $der = $medio;  }
                }
            return $n;
            }
            if ($posicion > -1)
            {
                echo " El Valor $numero se encuantra en la poscion $posicion del vector"; }
            else {
            echo " El Valor $numero se No encuentra en vector";     }
            */
            //Buscando que no exista en la tabla para registrar
            for ($i=0; $i <count($fechas) ; $i++){
                if (is_null(Ccalendario::where('fecLab', '=', $fechas[$i])->exists())) {
                  $Ocalendario = new Ccalendario;
                  $Ocalendario->fecLab =$fechas[$i];
      			      $Ocalendario->save();
                }
              /*
              if (User::where('email', '=', Input::get('email'))->exists()) {
                // user found
              }
              */
            }
          }

            for ($i=0; $i <count($fechas) ; $i++) {

                $Ocalendario = new Ccalendario;
    			      $Ocalendario->fecLab =$fechas[$i];
    			      $Ocalendario->save();
    		    }

    		$months = Ccalendario::diasAno();
    		$meses = Ccalendario::Meses();

            return redirect("/calendario/actualizar")->with("months",$months)
                        	    											 ->with("meses",$meses)
                        	    											 ->with('estado','realizado');
    	}

        else return redirect('/calendario/actualizar')->with('estado','fallido');
    }
}

?>
