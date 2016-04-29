<?php
/**
 * @author Elias D. Peraza @tes1oner
 **/
namespace Colmena;

use Illuminate\Database\Eloquent\Model;

class CactividadRecurrente extends Model{
    protected $table = "t_acti_recus";
    protected $primaryKey = "idActRec";
    //public $timestamps = false;
    public function usuariosAsignados(){
        return $this->belongsToMany('Colmena\Cusuario', 't_encargados', 'idActRec', 'idUsu');
    }
    public function getURL(){
        return "/actividades-recurrentes/ver/".$this->idActRec;
    }
    public function getDetalleAcortado($numCaracteres = 25){
        return (strlen($this->detalle) <= $numCaracteres) ?
            $this->detalle : substr($this->detalle,0,$numCaracteres-3).'...';
    }
    public function getFrecuenciaEnDias(){
        $opciones = [
            'Diario'    => 1,
            'Semanal'   => 7,
            'Mensual'   => 30,
            'Bimensual' => 60,
            'Trimestral'=> 90,
            'Semestral' => 280,
            ];
        return $opciones[$this->tipFrec];
    }
}
