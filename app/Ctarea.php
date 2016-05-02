<?php
/*
Author:QSoto
*/
namespace Colmena;

use Illuminate\Database\Eloquent\Model;

class Ctarea extends Model
{
    protected $table = "t_tareas";
    protected $primaryKey = "idTar";
    //public $timestamps = false;
    public function BitacorasTarea(){
    	return $this->hasMany('Colmena\TBitaTare');
    }

    public function usuarioResponsable(){
        return $this->belongsTo('Colmena\Cusuario', 'idUsu');
    }
    public function getURL(){
        return "/tareas/ver/".$this->idTar;
    }
    public static function buscarFechaEst($fecha){
        $tareas = Ctarea::where('fecEst', '=', $fecha )->get();
        return $tareas;
    }
    public static function enviarEmailTareaAsignada($Otarea){
        $asunto = "Tienes una nueva tarea asignada | Colmena -SGTH";
        $mensaje = <<<EOD
            <h2>{$Otarea->usuarioResponsable->getNombreCompleto()},</h2><br>
                <strong>Has sido asignado para realizar una nueva tarea</strong><br><hr>
                <strong>Título:</strong> {$Otarea->titulo}<br>
                <strong>Fecha de creación:</strong> {$Otarea->created_at}<br>
                <p>
                    <strong>Detalle:</strong> {$Otarea->detalle}<br>
                </p><br><hr>
                <strong>La fecha de entrega pautada es:</strong> {$Otarea->fecEst}<br><hr>
EOD;
        return Mailer::enviar($Otarea->usuarioResponsable, $asunto, $mensaje);
    }

    public static function crearMultiple($datos, $usuarios){
        foreach ($usuarios as $Ousuario){
            $Otarea = New Ctarea;
            $Otarea->titulo = $datos["titulo"];
            $Otarea->fecEst = $datos["fecEst"];
            $Otarea->detalle = $datos["detalle"];
            $Otarea->prioridad = $datos["prioridad"];
            $Otarea->complejidad = $datos["complejidad"];
            $Otarea->estTar = 'Asignada';
            $Otarea->tipTar = $datos["tipTar"];
            $Otarea->idUsu = $Ousuario->idUsu;
            $Otarea->save();
            CTarea::enviarEmailTareaAsignada($Otarea);
        }
        return;
    }
}
