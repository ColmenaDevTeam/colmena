<?php
/**
 * @author Elias D. Peraza @tes1oner
 **/
namespace Colmena\Console\Commands;

use Illuminate\Console\Command;
use Colmena\CactividadRecurrente as CactividadRecurrente;
use Colmena\Ctarea as Ctarea;
use Carbon\Carbon as Carbon;
class CactiRecuDaemond extends Command
{
    /**
     * Nombre del comando
     * @var string
     */
    protected $signature = 'colmena:acti_recu_daemond';

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
//        $this->info('Infor');
//        $this->error('Error');
//        $this->line('Line');
        date_default_timezone_set('America/Caracas');
        $hoy = date('Y-m-d');
        $this->info('HOY:');
        $this->line($hoy);
        $actiRecus = $this->getActiRecusLanzables();
        foreach($actiRecus as $OactiRecu){
            if($this->crearTarea($OactiRecu)){
                $OactiRecu->ultLan = $hoy;
                $OactiRecu->save();
                $this->line('lanzado >> '.$OactiRecu->idActRec);
            }
//            $OactiRecu->ultLan = date();
            $this->error('Lanzable: '.$OactiRecu->idActRec);
        }
    }
    private function getActiRecusLanzables(){
        $lanzables = [];//new Collection([]);
        $hoy = date('Y-m-d');
        $this->info('HOY:');
        $this->line($hoy);
        $actiRecus = CactividadRecurrente::all();
        foreach($actiRecus as $OactiRecu){
            //Si no se ha lanzado aún
            if($OactiRecu->ultLan == '0000-00-00'
                || $OactiRecu->ultLan == ''
                || $OactiRecu->ultLan == null){
                //Si toca lanzarse hoy
                if($OactiRecu->fecIni == $hoy){
                    $lanzables[] = $OactiRecu;
                }
            }
            //Si ya fue lanzada
            else{
                $siguienteLanzamiento =
                    Carbon::createFromFormat('Y-m-d', $OactiRecu->ultLan, 'America/Caracas')
                    ->addDays($OactiRecu->getFrecuenciaEnDias());
                //$this->info('Agregados: '.$OactiRecu->getFrecuenciaEnDias().'<>'.$siguienteLanzamiento);
                if($siguienteLanzamiento->isToday()){
                    //$this->info('Agregados: '.$OactiRecu->getFrecuenciaEnDias().'<>'.$siguienteLanzamiento);
                    $lanzables[] = $OactiRecu;
                }
                //$this->info($OactiRecu->id.' ya se lanzó');
            }
        }
        $a = Carbon::now('America/Caracas');
        $this->info($a);
        return $lanzables;
    }
    function crearTarea(CactividadRecurrente $OactiRecu){

        return true;
    }
}
/*
function postRegistrar(Request $request){
    if(!(\Auth::user()->tieneAccion('tareas.registrar')))
        return redirect('errores/acceso-negado');
    $Ousuarios=Cusuario::all();
    //$oTarea=Ctarea::find($request->input("title"));
    $Ousuario=Cusuario::findOrFail($request->input("responsable"));

    $Otarea = New Ctarea;
    $Otarea->titulo = $request->input("title");
    $Otarea->fecEst = $request->input("deliverdate");
    $Otarea->detalle = $request->input("details");
    $Otarea->prioridad = $request->input("priority");
    $Otarea->complejidad = $request->input("complexity");
    $Otarea->estTar = 'Asignada';
    $Otarea->tipTar = $request->input("tipoTarea");
    $Otarea->idUsu = $Ousuario->idUsu;
    $Otarea->save();
    //Debe implementarse lo de abajo en un for cuando se implemente una tarea de envío multiples usuarios
    CTarea::enviarEmailTareaAsignada($Otarea);
    return redirect("tareas/registrar")->with(['Ousuarios'=>$Ousuarios, 'estado' => 'realizado']);
}
*/
