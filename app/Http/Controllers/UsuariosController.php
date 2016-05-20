<?php
/**
*@author QSoto
*/
namespace Colmena\Http\Controllers;
use Illuminate\Http\Request;
use Colmena\Http\Requests;

use Colmena\Http\Controllers\Controller;
use Colmena\Crol;
use Colmena\Cusuario;

use Colmena\Ctarea;
use Colmena\CpermRepo;
use Colmena\Mailer;

use PDF;

class UsuariosController extends Controller
{
/*
En los metodos por ruta se antepone el tipo de peticion http. Ej getNombreMetodo
postNombreMetodo etc. Y eso en las rutas se manejará como en minuscula de ma-
nera que queden así, x ej: colmena.cr/modulo/listar ... que hace referen-
cia al metodo getListar del controlador de ese modulo...............
*/

    public function __construct(){
 	   $this->middleware("auth");
    }



    public function getListar(){
        if(!(\Auth::user()->tieneAccion('usuarios.listar')))
            return redirect('errores/acceso-negado');
        $Ousuarios=Cusuario::where('username', '!=', env('APP_DEV_USERNAME'))->get();
        return view("usuarios.listar")->with('Ousuarios',$Ousuarios);
    }
    public function getRegistrar(){
        if(!(\Auth::user()->tieneAccion('usuarios.registrar')))
            return redirect('errores/acceso-negado');
        $roles = Crol::all();
        return view("usuarios.registrar")->with('roles',$roles);
    }

    /**
     * Obtiene los datos desde un objeto tipo request y los registra en la base de datos como un nuevo usuario.
     * @param  $request
     * @return \Public\Resources\Usuarios\Perfil  
     */
    public function postRegistrar(Request $request){
        if(!(\Auth::user()->tieneAccion('usuarios.registrar')))
            return redirect('errores/acceso-negado');
        $roles = Crol::all();
        $Ousuario=New Cusuario;
        if( !is_null($request->input("ci")))
            $Ousuario->cedula = $request->input("ci");

        if( !is_null($request->input("ci")))
            $Ousuario->username=$request->input("ci");

        if( !is_null($request->input("firstname")))
        $Ousuario->nombres=$request->input("firstname");

        if( !is_null($request->input("lastname")))
            $Ousuario->apellidos=$request->input("lastname");

        if( !is_null($request->input("birthdate")))
            $Ousuario->fecNac=$request->input("birthdate");

        if( !is_null($request->input("gender")))
            $Ousuario->sexo=$request->input("gender");

        if( !is_null($request->input("phone")))
            $Ousuario->telefono=$request->input("phone");

        if( !is_null($request->input("email")))
            $Ousuario->email=$request->input("email");

        if( !is_null($request->input("tipUsu")))
            $Ousuario->tipUsu=$request->input("tipUsu");

        //if( !is_null($request->input("password")))
        //   $Ousuario->clave=\Hash::make($request->input("password"));
        $claveOriginal = Cusuario::generarClaveAleatoria(false);
        $Ousuario->clave = \Hash::make($claveOriginal);
        $emailEnviado = Cusuario::enviarEmailRegistro($Ousuario, $claveOriginal);

        if(!$emailEnviado){
            //dd($emailEnviado);
            return redirect("usuarios/registrar")->with(['estado' => 'email-error','roles'=>$roles]);
        }
        $Ousuario->save();
        $roles = $request->get('roles');
        if(count($roles) > 0)
            $Ousuario->roles()->sync($roles);

        return redirect("usuarios/registrar")->with(['estado'=>'realizado','roles'=>$roles]);
    }


    public function getEliminar(){
        if(!(\Auth::user()->tieneAccion('usuarios.eliminar')))
            return redirect('errores/acceso-negado');

        $Ousuarios=Cusuario::where('username', '!=', env('APP_DEV_USERNAME'))->get();
        return redirect("usuarios/listar")->with(['Ousuarios'=>$Ousuarios, 'estado'=>'no-seleccionado']);
    }
    public function postEliminar(Request $request){
        if(!(\Auth::user()->tieneAccion('usuarios.eliminar')))
            return redirect('errores/acceso-negado');

        $Ousuario = Cusuario::find($request->get('idUsu'));
        $Ousuario->delete();
        $Ousuarios=Cusuario::where('username', '!=', env('APP_DEV_USERNAME'))->get();
        return redirect("usuarios/listar")->with(['estado'=>'realizado','Ousuarios',$Ousuarios]);

    }


    /**
     * Get a view for an incoming update profile request and gives the users profile info.
     * @return \Public\Resources\Usuarios\Perfil
     */

    public function getPerfil(){
        return view("usuarios/perfil");
    }

    public function postActualizarPerfil(Request $request){
        $email = $request->input("email");
        $phone = $request->input("phone");

        if( !is_null($request->input("email")))
            $request->user()->update(["telefono" => $phone]);

        if (!is_null($request->input("email"))) {
            $request->user()->update(["email" => $email]);
        }

        return redirect("usuarios/perfil")->with(['estado' => 'realizado']);
    }

    public function postActualizarClave(Request $request){
        $claveEnviada=$request->input("oldpassword");

        if (\Hash::check($claveEnviada, \Auth::user()->clave)){

                $npassword =\Hash::make($request->input("npassword"));
                $request->user()->update(["clave" => $npassword]);
                return redirect("usuarios/perfil")->with(['estado' => 'realizado']);
            }
        else
            return view("usuarios/perfil")->with(['estado' => 'fallido']);
    }

    public function getModificar(){
        if(!(\Auth::user()->tieneAccion('usuarios.modificar')))
            return redirect('errores/acceso-negado');
        $Ousuarios=Cusuario::where('username', '!=', env('APP_DEV_USERNAME'))->get();
        return redirect("usuarios/listar")->with(['Ousuarios' => $Ousuarios, 'estado'=>'no-seleccionado']);

    }

    public function postModificar(Request $request){
        if(!(\Auth::user()->tieneAccion('usuarios.modificar')))
            return redirect('errores/acceso-negado');
        $Ousuario = Cusuario::find($request->get('idUsu'));
        $roles = Crol::all();
        return view("usuarios.modificar")->with(['Ousuario' => $Ousuario, 'roles' => $roles]);
    }

    public function postUsuarioModificar(Request $request){
        if(!(\Auth::user()->tieneAccion('usuarios.modificar')))
            return redirect('errores/acceso-negado');
        $Ousuario = Cusuario::findOrfail($request->get('idUsu'));

        if( !is_null($request->input("ci")))
            $Ousuario->cedula = $request->input("ci");

        if( !is_null($request->input("ci")))
            $Ousuario->username=$request->input("ci");

        if( !is_null($request->input("firstname")))
        $Ousuario->nombres=$request->input("firstname");

        if( !is_null($request->input("lastname")))
            $Ousuario->apellidos=$request->input("lastname");

        if( !is_null($request->input("birthdate")))
            $Ousuario->fecNac=$request->input("birthdate");

        if( !is_null($request->input("gender")))
            $Ousuario->sexo=$request->input("gender");

        if( !is_null($request->input("phone")))
            $Ousuario->telefono=$request->input("phone");

        if( !is_null($request->input("email")))
            $Ousuario->email=$request->input("email");

        if( !is_null($request->input("tipUsu")))
            $Ousuario->tipUsu=$request->input("tipUsu");

        $Ousuario->save();
        $Ousuarios=Cusuario::where('username', '!=', env('APP_DEV_USERNAME'))->get();

        if( !is_null($request->input("roles"))){
            $roles = $request->get('roles');
            if(count($roles) > 0)
                $Ousuario->roles()->sync($roles);
        }

        return redirect("usuarios/listar")->with(['Ousuarios'=>$Ousuarios, 'estado'=>'realizado']);

    }

    public function getSeleccionarRol($idRol){
        $oRol = Crol::findOrFail($idRol);
        session(["rol_seleccionado.idRol" => $idRol,"rol_seleccionado.nombre" => $oRol->nombre]);
        return redirect()->intended('/cartelera');
    }

    public function getVer($id){
        $Ousuario=Cusuario::findOrFail($id);
        if (!($Ousuario))
            return view("/usuarios/perfil");

        return view("/usuarios/ver")->with('Ousuario',$Ousuario);
    }

    public function getReportar(Request $request){
        //dd($request->input("todasausencias"));
        $descripcion = "Reporte de: ";
            if($request->input("todasausencias")=="1"){
                    $tipoAusencia = [0,1];
                    $descripcion = $descripcion."Todas las ausencias, ";
                }
            else{
                if ($request->input("ausencia")!="-") {
                    if ($request->input("ausencia")==1) {
                        $tipoAusencia=[1];
                        $descripcion = $descripcion."Permisos, ";
                    }
                    elseif($request->input("ausencia")==0){
                        $tipoAusencia=[0];
                        $descripcion = $descripcion."Reposos, ";
                    }
                }
                else $tipoAusencia = NULL;
            }
                #Fin de permisos y reposos
                #tareas en general
                if ($request->input("todastareas")=="1") {
                    $tipoTarea = ['Academico-Docente', 'Creacion intelectual', 'Integracion Social', 'Administrativo-Docente', 'Produccion', 'Administrativas'];
                    $estadoTarea = ['Asignada', 'Revision', 'Cumplida', 'Cancelada', 'Diferida', 'Retrasada'];
                    $descripcion = $descripcion."Todas las tareas.";
                }
                #fin de tareas en general
                #tareas por estado
                else{
                    if ($request->input("todosestados")=="1") {
                        $estadoTarea = ['Asignada', 'Revision', 'Cumplida', 'Cancelada', 'Diferida', 'Retrasada'];
                        $descripcion = $descripcion."Todos los estados de tarea, ";
                    }
                    elseif($request->input('estadoTarea')!="-"){
                        switch ($request->input('estadoTarea')) {
                            case 'Asignada':
                                $estadoTarea = 'Asignada';
                                $descripcion = $descripcion."Estado de tarea Asignada, ";
                            case 'Revision':
                                $estadoTarea = 'Revision';
                                $descripcion = $descripcion."Estado de tarea Revision, ";
                            case 'Cumplida':
                                $estadoTarea = 'Cumplida';
                                $descripcion = $descripcion."Estado de tarea Cumplida, ";
                            case 'Cancelada':
                                $estadoTarea = 'Cancelada';
                                $descripcion = $descripcion."Estado de tarea Cancelada, ";
                            case 'Diferida':
                                $estadoTarea = 'Diferida';
                                $descripcion = $descripcion."Estado de tarea Diferida, ";
                            case 'Retrasada':
                                $estadoTarea = 'Retrasada';
                                $descripcion = $descripcion."Estado de tarea Retrasada, ";
                            default:
                                $estadoTarea = NULL;
                        }
                    }
                    else $estadoTarea = NULL;
                #fin de tareas por estado
                #tareas por tipo
                    if ($request->input("todostipo")=="1") {
                        $tipoTarea = ['Academico-Docente', 'Creacion intelectual', 'Integracion Social', 'Administrativo-Docente', 'Produccion', 'Administrativas'];
                        $descripcion = $descripcion."Todas los tipos de tareas.";
                    }
                    elseif($request->input('tipoTarea')!="-"){
                        switch ($request->input('tipoTarea')) {
                            case 'Academico-Docente':
                                $tipoTarea = ['Academico-Docente'];
                                $descripcion = $descripcion."Tipo de tarea Asignada.";
                            case 'Creacion intelectual':
                                $tipoTarea = ['Academico-Docente'];
                                $descripcion = $descripcion."Tipo de tarea Academico-Docente.";
                            case 'Integracion Social':
                                $tipoTarea = ['Integracion Social'];
                                $descripcion = $descripcion."Tipo de tarea Integracion Social.";
                            case 'Administrativo-Docente':
                                $tipoTarea = ['Administrativo-Docente'];
                                $descripcion = $descripcion."Tipo de tarea Administrativo-Docente.";
                            case 'Produccion':
                                $tipoTarea = ['Produccion'];
                                $descripcion = $descripcion."Tipo de tarea Produccion";
                            case 'Administrativas':
                                $tipoTarea = ['Administrativas'];
                                $descripcion = $descripcion."Tipo de tarea Administrativas.";
                            default:
                                $tipoTarea=NULL;
                        }
                    }
                    else $tipoTarea=NULL;
                #fin de tareas por tipo
                }
        
        if($request->input("todosusuarios")=="1"){
            $usuarios = Cusuario::where('username', '!=', env('APP_DEV_USERNAME'))->get();
            foreach ($usuarios as $Ousuario) {
                #Permisos y reposos
                if ($request->input("todasausencias")=="1" or !is_null($tipoAusencia)) {
                    $perRepos[$Ousuario->idUsu]=CpermRepo::where('idUsu', '=', $Ousuario->idUsu)
                                        ->whereIn('perRep', $tipoAusencia)
                                        ->whereBetween('fecIni',[$request->input('startdate'),$request->input('enddate') ])->get();
                }
                else $perRepos[$Ousuario->idUsu] = NULL;

                if (!is_null($request->input("todastareas")) or !is_null($tipoTarea) or !is_null($estadoTarea)) {
                    $tareas[$Ousuario->idUsu] = Ctarea::where('idUsu', '=', $Ousuario->idUsu)
                                        ->whereIn('tipTar', $tipoTarea)
                                        ->whereIn('estTar', $estadoTarea)
                                        ->whereBetween('fecEst',[$request->input('startdate'),$request->input('enddate') ])->get();
                }
                else $tareas[$Ousuario->idUsu] = NULL;
                
            }
        }
        else{
            $usuarios = Cusuario::where('idUsu', '=', $request->input('idUsu'))->get();
            foreach ($usuarios as $Ousuario) {
                if (!is_null($request->input("todasausencias")) or !is_null($tipoAusencia)) {
                
                    $perRepos[$Ousuario->idUsu]=CpermRepo::where('idUsu', '=', $Ousuario->idUsu)
                                        ->whereIn('perRep', $tipoAusencia)
                                        ->whereBetween('fecIni',[$request->input('startdate'),$request->input('enddate') ])->get();
                }
                else $perRepos[$Ousuario->idUsu] = NULL;

                if ($request->input("todastareas")=="1" or !is_null($tipoTarea) or !is_null($estadoTarea)) {

                    $tareas[$Ousuario->idUsu] = Ctarea::where('idUsu', '=', $Ousuario->idUsu)
                                        ->whereIn('tipTar', $tipoTarea)
                                        ->whereIn('estTar', $estadoTarea)
                                        ->whereBetween('fecEst',[$request->input('startdate'),$request->input('enddate') ])->get();
                }
                else $tareas[$Ousuario->idUsu] = NULL;
            }
        #    $data = [$usuarios, $perRepos, $tareas];
        }
        $data = array('usuarios'=>$usuarios, 'perRepos'=>$perRepos, 'tareas'=>$tareas, 
                    'startdate'=>$request->input('startdate'), 'enddate'=>$request->input('enddate'), 'descripcion'=>$descripcion);
        //dd($data);
        $reporte = PDF::loadView('usuarios/reporte', $data);

        $Ousuarios=Cusuario::where('username', '!=', env('APP_DEV_USERNAME'))->get();
        //return redirect("usuarios/listar")->with(['Ousuarios'=>$Ousuarios, 'estado'=>'realizado'])
         //                                 ->with($reporte->download('reporte.pdf'));
        return $reporte->download('reporte.pdf');
    }
}