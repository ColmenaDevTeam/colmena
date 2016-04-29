<?php
/**
 * @author: Elias Peraza @tesoner
 */
namespace Colmena\Http\Controllers;

use Illuminate\Http\Request;

use Colmena\Http\Requests;
use Colmena\Http\Controllers\Controller;
use Colmena\Caccion as Caccion;
use Colmena\Crol as Crol;

class CrolesController extends Controller{
    public function __construct(){
       $this->middleware("auth");
    }
    public function getListar(){
        if(!(\Auth::user()->tieneAccion('roles.listar')))
            return redirect('errores/acceso-negado');
        $roles=Crol::all();
        return view("roles.listar")->with(['roles'=>$roles]);
    }
    public function getRegistrar(){
        if(!(\Auth::user()->tieneAccion('roles.registrar')))
            return redirect('errores/acceso-negado');
        $acciones = Caccion::all();
        return view("roles.registrar")->with('acciones',$acciones);
    }
    public function postRegistrar(Request $request){
        if(!(\Auth::user()->tieneAccion('roles.registrar')))
            return redirect('errores/acceso-negado');
        $oRol = new Crol();
        $oRol->nombre = $request->get('nombreRol');
        $oRol->save();
        $acciones = $request->get('acciones');
        if(count($acciones) > 0)
            $oRol->acciones()->sync($acciones);
        return redirect('/roles/registrar')->with(['estado' => 'realizado']);
    }
    public function getModificar(Request $request, $idRol = -1){
        if(!(\Auth::user()->tieneAccion('roles.modificar')))
            return redirect('errores/acceso-negado');
        if($idRol != -1){
            $Orol = Crol::findOrFail($idRol);
            if($Orol){
                $acciones = Caccion::all();
                return view("roles.modificar")->with(['acciones' => $acciones, 'Orol' => $Orol] );
            }
        }
        return redirect('/roles/listar')->with('estado', 'no-seleccionado');
    }
    public function postModificar(Request $request){
        if(!(\Auth::user()->tieneAccion('roles.modificar')))
            return redirect('errores/acceso-negado');
        $oRol = Crol::findOrFail($request->get('idRol'));
        $oRol->nombre = $request->get('nombreRol');
        $oRol->save();
        $acciones = $request->get('acciones');
        if(count($acciones) > 0)
            $oRol->acciones()->sync($acciones);
        return redirect('/roles/listar')->with(['estado' => 'realizado']);
    }
    public function getEliminar(){
        return redirect('roles/listar')->with('estado', 'no-seleccionado');
    }
    public function postEliminar(Request $request){
        if(!(\Auth::user()->tieneAccion('roles.eliminar')))
            return redirect('errores/acceso-negado');
        $idRol = $request->get('idRol');
        $Orol = Crol::findOrFail($idRol);
        $Orol->delete();
        $roles = Crol::all();
        return redirect('roles/listar')->with(['roles'=>$roles, 'estado'=> 'realizado']);
    }
}
