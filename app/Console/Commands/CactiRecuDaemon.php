<?php
/**
 * @author Elias D. Peraza @tes1oner
 **/
namespace Colmena\Console\Commands;

use Illuminate\Console\Command;
use Colmena\CactividadRecurrente as CactividadRecurrente;
use Colmena\Ctarea as Ctarea;
use Carbon\Carbon as Carbon;
class CactiRecuDaemon extends Command
{
    /**
     * Nombre del comando
     * @var string
     */
    protected $signature = 'colmena:acti_recu_daemon';

    /**
     * Descripción del comando
     * @var string
     */
    protected $description = 'Lanza el script de creación de tareas a partir de actividades recurrentes';

    /**
     * Constructor
     * @return new CactiRecuDaemond (instancia)
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Método de ejecución
     * @return mixed
     */
    public function handle(){
        date_default_timezone_set('America/Caracas');
        $hoy = date('Y-m-d');
        $actiRecus = $this->getActiRecusLanzables();
#        $this->info('Lanzables ('.count($actiRecus).')');
        foreach($actiRecus as $OactiRecu){
            $datos["titulo"] = $OactiRecu->titulo;
            $datos["detalle"] = $OactiRecu->detalle;
            $datos["prioridad"] = $OactiRecu->prioridad;
            $datos["complejidad"] = $OactiRecu->complejidad;
            $datos["tipTar"] = $OactiRecu->tipTar;

            $fecEst =
                Carbon::createFromFormat('Y-m-d', $hoy, 'America/Caracas')
                ->addDays($OactiRecu->tieEnt);
            $datos["fecEst"] = $fecEst;

            Ctarea::crearMultiple($datos, $OactiRecu->usuariosAsignados);
                $OactiRecu->ultLan = $hoy;
                $OactiRecu->save();
#            $this->info('Lanzada :: '.$OactiRecu->idActRec);
        }
    }
    /**
     * Método que retorna las actividad recurrentes lanzables para el día
     * @return Array con las actividades recurrentes que toca lanzar el día de hoy
     **/
    private function getActiRecusLanzables(){
        $lanzables = [];//new Collection([]);
        $hoy = date('Y-m-d');
#        $this->line('HOY:'.$hoy);
        $actiRecus = CactividadRecurrente::all();
        foreach($actiRecus as $OactiRecu){
            //Si no se ha lanzado aún
            if($OactiRecu->ultLan == '0000-00-00'
                || $OactiRecu->ultLan == ''
                || $OactiRecu->ultLan == null){
                //Si toca lanzarse hoy
#                $this->error('No ha sido lanzada :: '.$OactiRecu->idActRec);
                if($OactiRecu->fecIni == $hoy){
                    $lanzables[] = $OactiRecu;
#                    $this->line('Lanzable :: '.$OactiRecu->idActRec);
                }
            }
            //Si ya fue lanzada
            else{
#                $this->error('Ya fue lanzada :: '.$OactiRecu->idActRec);
                $siguienteLanzamiento =
                    Carbon::createFromFormat('Y-m-d', $OactiRecu->ultLan, 'America/Caracas')
                    ->addDays($OactiRecu->getFrecuenciaEnDias());
                if($siguienteLanzamiento->isToday()){

                    $lanzables[] = $OactiRecu;
#                    $this->line('Lanzable :: '.$OactiRecu->idActRec);
                }
            }
        }
        return $lanzables;
    }
}
