<?php
/**
*@author QSoto
*/

namespace Colmena\Http\Controllers;

use Illuminate\Http\Request;
use Colmena\Http\Requests;
use Colmena\Http\Controllers\Controller;
use Colmena\Ctarea;
use Colmena\Ccalendario;

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
              $n = -1;
              for ($i=0; $i<count($fechas); $i++){
                  if ($fechas[$i]==$fecha->getOriginal('fecLab')){
                      $n = $i;
                      break;
                  }
              }
              if($n == -1){
                //Aqui lo de las tareas
                $tareasMover=Ctarea::buscarFechaEst($fecha->getOriginal('fecLab'));
                if (!is_null($tareasMover)) {
                  foreach ($tareasMover as $tarea) {
                    $tarea->fecEst = Ccalendario::getProxima($fecha->getOriginal('fecLab'));
                    $tarea->save();
                  }
                }
                $fecha->delete();
              }

            }
            //Buscando que no exista en la tabla para registrar
          for ($i=0; $i <count($fechas) ; $i++){
                $Ocalendario = Ccalendario::firstOrCreate(['fecLab'=>$fechas[$i]]);
                $Ocalendario->save();
          }
        }
        else{
          for ($i = 0; $i < count($fechas) ; $i++){
              $Ocalendario = Ccalendario::firstOrCreate(['fecLab'=>$fechas[$i]]);
  			      $Ocalendario->save();
  		    }
        }
    		$months = Ccalendario::diasAno();
    		$meses = Ccalendario::Meses();

        return redirect("/calendario/actualizar")->with("months",$months)
                    	    											 ->with("meses",$meses)
                    	    											 ->with('estado','realizado');
    	}

      else return redirect('/calendario/actualizar')->with('estado','fallido')
                                                    ->with("months",$months)
                                                    ->with("meses",$meses);
    }
}

?>
