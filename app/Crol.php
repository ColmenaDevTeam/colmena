<?php
/**
* @author: Elias Peraza
*/
namespace Colmena;

use Illuminate\Database\Eloquent\Model;

class Crol extends Model
{
    protected $table = "t_roles";
    protected $primaryKey = "idRol";
    protected $fillable = ['nombre'];
    public $timestamps = false;

    public function usuarios(){
    	return $this->belongsToMany('Colmena\Cusuario', 't_role_usuas', 'idRol', 'idUsu');
    }

    public function acciones(){
        return $this->belongsToMany('Colmena\Caccion', 't_autorizaciones', 'idRol', 'idAcc');
    }
    public function getModulosDisponibles(){
        $acciones = $this->acciones;
        $modulos = [];
        //dd($acciones);
        foreach ($acciones as $accion){
            $array = explode(".", $accion->nombre);
            if(!in_array($array[0], $modulos))
                $modulos[] = $array[0];
        }
        return $modulos;
    }
    public function getAccionesDispPorModulo($nombreModulo){
        $accionesDisp = [];
        foreach($this->acciones as $accion){
            if(strpos($accion->nombre, $nombreModulo) !== FALSE)
                $accionesDisp[] = $accion;
        }
        return $accionesDisp;
    }
    public function tieneAccion($nombreAccion){
        foreach($this->acciones as $iAccion)
            if($nombreAccion == $iAccion->nombre)
                return true;
        return false;
    }

}
