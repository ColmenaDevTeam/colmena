<?php
/*
Author:QSoto
*/
namespace Colmena;

use Illuminate\Database\Eloquent\Model;

class Cpermrepo extends Model
{
    protected $table = "t_perm_repos";
    protected $primaryKey = "idPerRep";

    public function Cusuario(){
    	return $this->belongsTo('Colmena\Cusuario');
    }
    public function estaVigente(){
        $fecHoy=date("Y-m-d");
        if (($this->fecIni)<($fecHoy) && ($this->fecFin)>=($fecHoy))
            return true;
            //Esta vigente
        return false;
    }
    public function getURL(){
        return "/permisos-y-reposos/ver/".$this->idPerRep;
    }
    public function getNombreAusencia(){
        if ($this->perRep==1) {
            return "Permiso";
        }
        else
            return "Reposo";
    }
    public function getDetalleAcortado($numCaracteres = 25){
        return (strlen($this->detalle) <= $numCaracteres) ?
            $this->detalle : substr($this->detalle,0,$numCaracteres-3).'...';
    }
}
