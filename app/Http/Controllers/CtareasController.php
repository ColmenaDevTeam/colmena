<?php
/**
 * @author: konh
 */
namespace Colmena\Http\Controllers;

use Illuminate\Http\Request;
use Colmena\Cusuario;
use Colmena\Http\Requests;
use Colmena\Http\Controllers\Controller;
use Colmena\Ctarea;
use Colmena\CBitaTarea;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class CtareasController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    public function getListar($idUsu = false){
        //Si no se está pasando ningun usuario
        if($idUsu === false){
            //por defecto se listan las tareas propias
            $tareas = Ctarea::where('idUsu', Auth::user()->idUsu)->get();
            if((Auth::user()->tieneAccion('tareas.listar')))
                //Y si tiene la accion de listar tareas, se listan todas
                $tareas=Ctarea::all();
        }
        //Si SÍ se está pasando un usuario
        else{
            //Si son sus propias tareas
            if($idUsu == Auth::user()->idUsu){
                $tareas = Ctarea::where('idUsu', Auth::user()->idUsu)->get();
            }
            //si NO son sus propias tareas
            else{
                //Si no puede listar, se redirecciona
                if(!(Auth::user()->tieneAccion('tareas.listar')))
                    return redirect('errores/acceso-negado');
                //si SÍ puede listar, se listan las tareas de el usuario requerido
                $Ousuario = Cusuario::find($idUsu);
                if($Ousuario)
                    $tareas = Ctarea::where('idUsu', $idUsu)->get();
                else
                    return view('tareas.listar')->with('estado', 'error')->with('tareas', null);
            }
        }
        return view("tareas.listar")->with('tareas',$tareas);
    }
    public function getVer(Request $request, $idTar){
        $Otarea = Ctarea::find($idTar);
        if(!Auth::user()->tieneAccion('tareas.listar') && $Otarea->idUsu != Auth::user()->idUsu)
            return redirect('errores/acceso-negado');
        if($Otarea->idUsu == Auth::user()->idUsu && !$Otarea->visto){
            $Otarea->visto = true;
            $Otarea->save();
        }
        $bitacoras = CBitaTarea::all();
        $Otarea->usuarioResponsable = Cusuario::findOrFail($Otarea->idUsu);
        if($Otarea)
            $bitacora = CBitaTarea::where('idTar', '=', $Otarea->idTar)->paginate(5);
            return view('tareas/ver')->with('Otarea', $Otarea)->with('bitacora', $bitacora);
        return redirect('tareas/listar');
    }
    public function getBitacora(Request $request){
        $Otarea = Ctarea::find($request->idTar);
        if(!(Auth::user()->tieneAccion('tareas.listar'))
                && $Otarea->idUsu != Auth::user()->idUsu
                && !(Auth::user()->tieneRolPorNombre('Jefe de Departamento')))
            return redirect('errores/acceso-negado');
        $arrEstados = ['Asignada','Revision','Cumplida','Cancelada','Diferida','Retrasada'];
        return view('tareas.bitacora')->with('Otarea', $Otarea)->with('arrEstados', $arrEstados);
    }
    public function postBitacora(Request $request){
        $Otarea = Ctarea::findOrFail($request->idTar);
        if(!(Auth::user()->tieneAccion('tareas.listar')) && $Otarea->idUsu != Auth::user()->idUsu)
            return redirect('errores/acceso-negado');

        $Otarea->estTar = $request->input('status');
        $Otarea->save();

        $Obitacora = New CBitaTarea;
        $Obitacora->idTar = $Otarea->idTar;
        $Obitacora->detalle = $request->input("incidencia");
        $Obitacora->save();

        $arrEstados = ['Asignada','Revision','Cumplida','Cancelada','Diferida','Retrasada'];
        return redirect('tareas/listar')->with('estado', 'incidencia');
    }
    public function getRegistrar(){
        if(!(\Auth::user()->tieneAccion('tareas.registrar')))
            return redirect('errores/acceso-negado');
    	$usuarios = Cusuario::where('username', '!=', env('APP_DEV_USERNAME'))->get();
        return view("tareas.registrar")->with('usuarios',$usuarios);
    }

    public function postRegistrar(Request $request){
        if(!(\Auth::user()->tieneAccion('tareas.registrar')))
            return redirect('errores/acceso-negado');
    	$idsUsuarios = $request->input('usuarios');

        foreach ($idsUsuarios as $idUsuario) {
            $Otarea = New Ctarea;
            $Otarea->titulo = $request->input("title");
            $Otarea->fecEst = $request->input("deliverdate");
            $Otarea->detalle = $request->input("details");
            $Otarea->prioridad = $request->input("priority");
            $Otarea->complejidad = $request->input("complexity");
            $Otarea->estTar = 'Asignada';
            $Otarea->tipTar = $request->input("tipoTarea");
            $Otarea->idUsu = $idUsuario;
            $Otarea->save();
            CTarea::enviarEmailTareaAsignada($Otarea);
        }
        $usuarios = Cusuario::getUsuariosPorGrado();
        return redirect("tareas/registrar")->with(['usuarios'=>$usuarios, 'estado' => 'registrada']);
    }
    public function getModificar(Request $request, $idTarea = -1){
        if(!(\Auth::user()->tieneAccion('tareas.modificar')))
            return redirect('errores/acceso-negado');
        if($idTarea != -1){
            $Otarea=Ctarea::find($idTarea);
            if($Otarea){
                $Ousuarios = Cusuario::all();
                return view("tareas.modificar")->with('Otarea', $Otarea)->with('Ousuarios', $Ousuarios);
            }
        }
        return redirect('/tareas/listar')->with('estado', 'no-seleccionado');
    }
    public function postModificar(Request $request){
        //dd($request);
        $Otarea=Ctarea::findOrFail($request->get('idTar'));
        if( !is_null($request->input("title")))
            $Otarea->titulo = $request->get("title");

        if( !is_null($request->input("deliverdate")))
            $Otarea->fecEst=$request->input("deliverdate");

        if( !is_null($request->input("details")))
            $Otarea->detalle=$request->input("details");

        if( !is_null($request->input("priority")))
            $Otarea->prioridad=$request->input("priority");

        if( !is_null($request->input("complexity")))
            $Otarea->complejidad=$request->input("complexity");

        if( !is_null($request->input("tipoTarea")))
            $Otarea->tipTar=$request->input("tipoTarea");

        if( !is_null($request->input("responsable")))
            $Otarea->idUsu=$request->input("responsable");
        $Otarea->save();

        $tareas = Ctarea::all();
        foreach($tareas as $ItemOtarea){
            $ItemOtarea->usuarioResponsable = Cusuario::findOrFail($ItemOtarea->idUsu);
        }
        return redirect("/tareas/listar")
                ->with('tareas', $tareas)
                ->with('estado', 'modificada');
    }
    public function getEliminar(){
        return redirect('/tareas/listar')->with('estado', 'no-seleccionado');
    }
    public function postEliminar(Request $request){
        if(!(\Auth::user()->tieneAccion('tareas.eliminar')))
            return redirect('errores/acceso-negado');
        $Oeliminada = Ctarea::find($request->get('idTar'));
        $Oeliminada->delete();
        $tareas=Ctarea::all();
        foreach($tareas as $tarea){
            $tarea->usuarioResponsable = Cusuario::findOrFail($tarea->idUsu);
        }
        return redirect("tareas/listar")->with('tareas',$tareas)->with('estado', 'eliminada');
    }

}
