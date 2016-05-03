<?php

namespace Colmena\Http\Controllers;

use Illuminate\Http\Request;

use Colmena\Http\Requests;
use Colmena\Http\Controllers\Controller;
use Colmena\Cusuario;
use Colmena\CpermRepo;
use Colmena\Ccalendario;
/*
En los metodos por ruta se antepone el tipo de peticion http. Ej getNombreMetodo
postNombreMetodo etc. Y eso en las rutas se manejará como en minuscula de ma-
nera que queden así, x ej: colmena.cr/modulo/listar ... que hace referen-
cia al metodo getListar del controlador de ese modulo.
*/
class PermisosRepososController extends Controller
{
    public function __construct(){
       $this->middleware("auth");
    }

    public function getListar(){
        if(!(\Auth::user()->tieneAccion('permisos_y_reposos.listar')))
            return redirect('errores/acceso-negado');
        $OperReps=Cpermrepo::all();

        foreach ($OperReps as $OperRep) {
            $OperRep->usuarioImplicado = Cusuario::findOrFail($OperRep->idUsu);
        }

        return view("permisos-y-reposos.listar")->with(['OperReps'=>$OperReps]);
    }
    public function getRegistrar(){
        if(!(\Auth::user()->tieneAccion('permisos_y_reposos.registrar')))
            return redirect('errores/acceso-negado');
    	$usuarios=Cusuario::where('username', '!=', env('APP_DEV_USERNAME'))->get();
        return view("permisos-y-reposos.registrar")->with('usuarios',$usuarios);
    }

    public function postRegistrar(Request $request){
        if(!(\Auth::user()->tieneAccion('permisos_y_reposos.registrar')))
            return redirect('errores/acceso-negado');
    	$usuarios=Cusuario::where('username', '!=', env('APP_DEV_USERNAME'))->get();

        $usuario=Cusuario::find($request->input("idUsu"));
        $Opermrepo = New Cpermrepo;
        $Opermrepo->perRep = $request->input("perRep");

        $Opermrepo->idUsu = $usuario->idUsu;
        $Opermrepo->fecIni = $request->input("startdate");
        $Opermrepo->fecFin = $request->input("enddate");

        $Opermrepo->detalle = $request->input("details");
        $Opermrepo->save();

        $tareasPorFecha = $usuario->getTareasPorFecha($Opermrepo->fecIni, $Opermrepo->fecFin);
        if (!is_null($tareasPorFecha)) {
            foreach ($tareasPorFecha as $tarea) {
                $tarea->fecEst = Ccalendario::getProxima($Opermrepo->fecFin);
                $tarea->save();
            }
        }

        $OperReps=Cpermrepo::all();

        return redirect("permisos-y-reposos/registrar")->with(['estado'=>'realizado', 'usuarios'=>$usuarios]);
    }

    public function getEliminar(Request $request){
        if(!(\Auth::user()->tieneAccion('permisos_y_reposos.eliminar')))
            return redirect('errores/acceso-negado');
        $OperRep = Cpermrepo::find($request->get('idPerRep'));
        $OperRep->delete();
        
        $OperReps=Cpermrepo::all();

        return redirect("permisos-y-reposos/listar")->with(['estado'=>'realizado','OperReps'=>$OperReps]);

    }

    public function getModificar(Request $request){
        if(!(\Auth::user()->tieneAccion('permisos_y_reposos.modificar')))
            return redirect('errores/acceso-negado');
        $usuarios=Cusuario::where('username', '!=', env('APP_DEV_USERNAME'))->get();

        $OperRep = Cpermrepo::find($request->get('idPerRep'));

        return view("permisos-y-reposos.modificar")->with(['OperRep'=>$OperRep, 'usuarios'=>$usuarios]);
    }

    public function postModificar(Request $request){
        if(!(\Auth::user()->tieneAccion('permisos_y_reposos.modificar')))
            return redirect('errores/acceso-negado');
        $OperRep = Cpermrepo::findOrFail($request->get('idPerRep'));

        if( !is_null($request->input("perRep")))
            $OperRep->perRep = $request->input("perRep");

        if( !is_null($request->input("idUsu"))){
            $usuarios=Cusuario::where('username', '!=', env('APP_DEV_USERNAME'))->get();
            $usuario=Cusuario::find($request->input("idUsu"));
            $OperRep->idUsu=$usuario->idUsu;
        }
        if( !is_null($request->input("startdate")))
        $OperRep->fecIni=$request->input("startdate");

        if( !is_null($request->input("enddate")))
            $OperRep->fecFin=$request->input("enddate");

        if( !is_null($request->input("details")))
            $OperRep->detalle=$request->input("details");

        $OperRep->save();
        
        $tareasPorFecha = $usuario->getTareasPorFecha($Opermrepo->fecIni, $Opermrepo->fecFin);
        if (!is_null($tareasPorFecha)) {
            foreach ($tareasPorFecha as $tarea) {
                $tarea->fecEst = Ccalendario::getProxima($Opermrepo->fecFin);
                $tarea->save();
            }
        }
        $OperReps=Cpermrepo::all();
        foreach ($OperReps as $OperRep) {
            $OperRep->usuarioImplicado = Cusuario::findOrFail($OperRep->idUsu);
        }
        return redirect("permisos-y-reposos/listar")->with(['estado'=>'realizado','OperReps'=>$OperReps]);


    }

        
/*
Aparte, necesito que hagan un metodo en el modelo de permRep, que sea algo como "estaVigente()"
o no encuentro la palabra exacta, que devuelva true si está en reposo o permiso, o sea si la fecha
de hoy está en el intervalo de el inicio y ffin del reposo o permiso. No lo haré yo porque no es mi
modulo, y aún así tengo la mayoría de lineas en el modelo de usuarios, fijate, me falta es que
me pongas hacer las vistas ...
*/
}
