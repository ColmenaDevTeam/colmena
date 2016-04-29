<?php
/*
@author: Elias D.
*/
namespace Colmena\Http\Controllers;

use Illuminate\Http\Request;
use Colmena\Crol;
use Colmena\Http\Requests;
use Colmena\Http\Controllers\Controller;
use Colmena\Ctarea;
use Colmena\CpermRepo;
use Colmena\Cusuario;
use Auth;
use Carbon\Carbon;

class CcarteleraController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    public function getIndex(){
        $topHoy = [];
        $pendientes = [];
        $cumpleanieros = [];

        $rolesUsuario = Auth::user()->roles;
        $tareas = Ctarea::where('idUsu', Auth::user()->idUsu)->get();
        $usuarios = Cusuario::all();
        $permisosReposos = CpermRepo::where('idUsu', Auth::user()->idUsu)->get();
        if(Auth::user()->tieneAccion('tareas.listar'))
            $tareas = Ctarea::all();
        if(Auth::user()->tieneAccion('permisos_y_reposos.listar'))
            $permisosReposos = CpermRepo::all();
        //Ver los cumpleaños
        foreach($usuarios as $Ousuario){
            $OfechaNacimiento = Carbon::createFromFormat('Y-m-d', $Ousuario->fecNac);
            $OfechaHoy = Carbon::now();
            $OfechaNacimiento->year = $OfechaHoy->year;
            //En las siguientes linea el 5 representa el numero maximo de dias a partir de el actual
            //que se tomara en cuenta para mostrar
            if(($OfechaHoy->diffInDays($OfechaNacimiento) < 5 ||
                    $OfechaNacimiento->isBirthday()) &&
                    !$OfechaNacimiento->isPast()){
                $diasTotales = 5;
                $diasFaltantes = $OfechaHoy->diffInDays($OfechaNacimiento);
                $porcentaje = 100;
                for($i = $diasFaltantes; $i > 0; $i--)
                    $porcentaje-=20;
                $Ousuario->porcentaje = $porcentaje;
                $cumpleanieros[] = $Ousuario;
            }

        }
        $i = 0;
        foreach($tareas as $tarea){
            if($tarea->estTar != 'Cumplida' && $tarea->estTar != 'Cancelada'){
                $tarea->tipoDato = 'tareas';
                $tarea->idTag = 'Tar'.$i;
                $tarea->usuario = Cusuario::findOrFail($tarea->idUsu);

                $fechaEstimada = Carbon::createFromFormat('Y-m-d', $tarea->fecEst);
                $diasTotales = $tarea->created_at->diffInDays($fechaEstimada);
                $diasTranscurridos = $tarea->created_at->diffInDays(Carbon::now());
                $tarea->porcentaje = 0;
                if($diasTranscurridos > 0 && $diasTotales > 0)
                    $tarea->porcentaje = ($diasTranscurridos*100)/$diasTotales;
                //$tarea->porcentaje = $porcentaje;
                if($fechaEstimada->isPast() || $fechaEstimada->isToday())
                    $tarea->porcentaje = 100;
                if($tarea->porcentaje > 0 && $tarea->porcentaje < 40)
                    $tarea->estadoCss = 'progress-bar-success';
                elseif($tarea->porcentaje >= 40 && $tarea->porcentaje < 80)
                    $tarea->estadoCss = 'progress-bar-warning';
                elseif($tarea->porcentaje >= 80)
                    $tarea->estadoCss = 'progress-bar-danger';
                $pendientes[] = $tarea;
                $i++;
            }
        }
        $i = 0;
        foreach($permisosReposos as $permiRepo){
            $permiRepo->tipoDato = 'permisos_y_reposos';
            if($permiRepo->PerRep)
                $permiRepo->idTag = "Per".$i;
            else
                $permiRepo->idTag = "Rep".$i;
            $permiRepo->usuario = Cusuario::findOrFail($permiRepo->idUsu);

            $fechaInicio = Carbon::createFromFormat('Y-m-d', $permiRepo->fecIni);
            $fechaFin = Carbon::createFromFormat('Y-m-d', $permiRepo->fecFin);
            if($fechaFin->isPast() || $fechaFin->isToday())
                continue;
            $diasTotales = $fechaInicio->diffInDays($fechaFin);

            $diasTranscurridos = $fechaInicio->diffInDays(Carbon::now());
            $porcentaje = 0;
            if($diasTranscurridos > 0 && $diasTotales > 0)
                $porcentaje = ($diasTranscurridos*100)/$diasTotales;
            $permiRepo->porcentaje = $porcentaje;
            if($fechaFin->isPast() || $fechaFin->isToday())
                $permiRepo->porcentaje = 100;
            //$permiRepo->estadoCss = 'progress-bar-info';
            $pendientes[] = $permiRepo;
            $i++;
        }
        foreach($cumpleanieros as $cumpleaniero){
            $cumpleaniero->tipoDato = "cumpleanios";
            $cumpleaniero->idTag = "Cmp".$i;
            $pendientes[] = $cumpleaniero;
        }
        $tiposDatos = ["tareas", "cumpleanios", "permisos_y_reposos"];
        $clasesCssPorTipo['tareas'] = "list-group-item-info";
        $clasesCssPorTipo['cumpleanios'] = "list-group-item-success";
        $clasesCssPorTipo['permisos_y_reposos'] = "list-group-item-warning";

        foreach($pendientes as $pendiente){
            $fechaHoy = getdate();
            if($pendiente->tipoDato == 'cumpleanios'){
                if($pendiente->getDiaNacimiento() == $fechaHoy['mday'])
                    $topHoy[] = $pendiente;
            }
            elseif($pendiente->tipoDato == 'tareas'){
                $fechaEstimada = explode("-", $pendiente->fecEst);
                if($fechaEstimada[2] == $fechaHoy['mday'])
                    $topHoy[] = $pendiente;
            }
            elseif($pendiente->tipoDato == 'permisos_y_reposos'){
                if($pendiente->estaVigente())
                    $topHoy[] = $pendiente;
            }
        }
        return view("cartelera")
                ->with('tiposDatos', $tiposDatos)
                ->with('topHoy', $topHoy)
                ->with('pendientes', $pendientes)
                ->with('clasesCssPorTipo', $clasesCssPorTipo);
    }
}
