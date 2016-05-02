<?php
/**
 * @author Elias D. Peraza @tes1oner
 **/
namespace Colmena\Http\Controllers;

use Illuminate\Http\Request;

use Colmena\Http\Requests;
use Colmena\Http\Controllers\Controller;

use Colmena\CactividadRecurrente;
use Colmena\Cusuario;
use Colmena\Ctarea;
use \Auth as Auth;

/**
*
*/
class CactividadesRecurrentesController extends Controller{
	function __construct(){
 	   $this->middleware("auth");

	}
    public function getRegistrar(){
        if(!(Auth::user()->tieneAccion('actividades_recurrentes.registrar')))
            return redirect('errores/acceso-negado');
    	$usuarios = Cusuario::where('username', '!=', env('APP_DEV_USERNAME'))->get();
        return view("actividades-recurrentes.registrar")->with('usuarios',$usuarios);
    }
	public function postRegistrar(Request $request){
        if(!(Auth::user()->tieneAccion('actividades_recurrentes.registrar')))
            return redirect('errores/acceso-negado');
    	$usuarios = Cusuario::where('username', '!=', env('APP_DEV_USERNAME'))->get();
		$OactiRecu = New CactividadRecurrente();
        $OactiRecu->titulo = $request->input("titulo");
        $OactiRecu->detalle = $request->input("detalle");
        $OactiRecu->prioridad = $request->input("prioridad");
        $OactiRecu->complejidad = $request->input("complejidad");
        $OactiRecu->tipTar = $request->input("tipTar");
		$OactiRecu->tipFrec = $request->input("tipFrec");
		$OactiRecu->tieEnt = $request->input("tieEnt");
		$OactiRecu->fecIni = $request->input("fecIni");
		$OactiRecu->ultLan = NULL;
        //$OactiRecu->idUsu = $idUsu;
		$OactiRecu->save();
		$usuariosSeleccionados = $request->input("usuarios");
		if(count($usuariosSeleccionados) > 0)
			$OactiRecu->usuariosAsignados()->sync($usuariosSeleccionados);
        return redirect("actividades-recurrentes/registrar")
			->with(['usuarios'=>$usuarios, 'estado' => 'realizado']);
    }
	public function getListar(Request $request){
		/*
		 * En las actividades recurrentes solo se listará si se tiene la permisología
		 * correspondiente, pues el(los) usuarios implicados solo podrán verlas
		 * cuando la actividad recurrente genere la tarea.
		 */
		if(!(Auth::user()->tieneAccion('actividades_recurrentes.listar')))
			return redirect('errores/acceso-negado');
		$actiRecus = CactividadRecurrente::all();
		return view("actividades-recurrentes.listar")->with('actiRecus',$actiRecus);
	}
	public function getVer(Request $request, $idActRec){
		if(!Auth::user()->tieneAccion('actividades_recurrentes.listar'))
            return redirect('errores/acceso-negado');
		$OactiRecu = CactividadRecurrente::find($idActRec);
		if($OactiRecu)
			return view('actividades-recurrentes/ver')->with('OactiRecu', $OactiRecu);
		return redirect('actividades-recurrentes/listar');
	}
	public function getModificar(Request $request, $idActRec = -1){
		if(!(Auth::user()->tieneAccion('actividades_recurrentes.modificar')))
			return redirect('errores/acceso-negado');
		if($idActRec != -1){
			$OactiRecu=CactividadRecurrente::find($idActRec);
			if($OactiRecu){
				$usuarios = Cusuario::where('username', '!=', env('APP_DEV_USERNAME'))->get();
				return view("actividades-recurrentes.modificar")
					->with('OactiRecu', $OactiRecu)
					->with('usuarios', $usuarios);
			}
		}
		return redirect('/actividades-recurrentes/listar')->with('estado', 'no-seleccionado');
	}
	public function postModificar(Request $request){
		if(!(\Auth::user()->tieneAccion('actividades_recurrentes.modificar')))
			return redirect('errores/acceso-negado');
		$OactiRecu=CactividadRecurrente::findOrFail($request->get('idActRec'));
		if( !is_null($request->input("titulo")))
			$OactiRecu->titulo = $request->input("titulo");
		if( !is_null($request->input("details")))
			$OactiRecu->detalle = $request->input("detalle");
		if( !is_null($request->input("prioridad")))
			$OactiRecu->prioridad = $request->input("prioridad");
		if( !is_null($request->input("complejidad")))
			$OactiRecu->complejidad = $request->input("complejidad");
		if( !is_null($request->input("tipTar")))
			$OactiRecu->tipTar = $request->input("tipTar");
		if( !is_null($request->input("tipFrec")))
			$OactiRecu->tipFrec = $request->input("tipFrec");
		if( !is_null($request->input("tieEnt")))
			$OactiRecu->tieEnt = $request->input("tieEnt");
		if( !is_null($request->input("fecIni")))
			$OactiRecu->fecIni = $request->input("fecIni");
		$OactiRecu->save();
		$usuariosSeleccionados = $request->input("usuarios");
		$OactiRecu->usuariosAsignados()->sync($usuariosSeleccionados);
		$actiRecus = CactividadRecurrente::all();
        return redirect("actividades-recurrentes/listar")
			->with(['actiRecus'=>$actiRecus, 'estado' => 'realizado']);
	}
	public function getEliminar(){
        return redirect('/actividades-recurrentes/listar')->with('estado', 'no-seleccionado');
    }
	public function postEliminar(Request $request){
		if(!(Auth::user()->tieneAccion('actividades_recurrentes.eliminar')))
			return redirect('errores/acceso-negado');
		$OactiRecu = CactividadRecurrente::find($request->get('idActRec'));
		$OactiRecu->delete();
		$actiRecus=CactividadRecurrente::all();
		return view("actividades-recurrentes.listar")
			->with('actiRecus',$actiRecus)
			->with('estado', 'realizado');
	}
}
