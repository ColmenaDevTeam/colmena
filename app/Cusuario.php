<?php
/**
* @author QSoto
* @author EliasDP. @tesoner
*/
namespace Colmena;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Cusuario extends Authenticatable
{
    protected $table = "t_usuarios";
    protected $primaryKey = "idUsu";
    //private $rolActivo = null;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cedula', 'username', 'nombres', 'apellidos',
    'tipUsu', 'email', 'clave', 'telefono', 'fecNac', 'sexo'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'clave', 'remember_token',
    ];
    public function getAuthPassword(){
        return $this->clave;
    }/*
    public function getAuthIdentifier(){
        return $this->username;
    }*/
    public function roles()
    {
        return $this->belongsToMany('Colmena\Crol', 't_role_usuas', 'idUsu', 'idRol');
    }

    public function tareas(){
    	return $this->hasMany('Colmena\Ctarea', 'idUsu');
    }/*

    public function TPermRepo(){
    	return $this->hasMany('app\TPermRepo');
    }

    public function TEncargados(){
    	return $this->hasMany('app\TEncargados');
    }*/

    public static function getUsuariosPorGrado(){
      function ordenaPorGrado(){

        if ($a->getGradoOcupacion() == $b->getGradoOcupacion()) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;

      }

      $usuarios = Cusuario::all();
      usort($usuarios, "ordenaPorGrado");
      return $usuarios;
    }
    public function tieneRol($oRol){
        foreach ($this->roles as $iRol) {
            if($oRol->idRol == $iRol->idRol)
                return true;
        }
        return false;
    }
    public function tieneRolPorNombre($nombreRol){
        foreach ($this->roles as $iRol) {
            if($nombreRol == $iRol->nombre)
                return true;
        }
        return false;
    }

    public function getGradoOcupacion(){

        $grado=0;
        if ($this->tareas) {
            foreach ($this->tareas as $tarea) {
                if ($tarea->estTar!='Cumplida' or $tarea->estTar!='Cancelada')
                    $grado+=($tarea->complejidad)+($tarea->prioridad);
            }
        return $grado;
        }
    }
    public function getNombreCompleto(){
        return $this->nombres." ".$this->apellidos;
    }
    public function getMesNacimiento($nombre = false){
        $fechaNac = explode("-", $this->fecNac);
        if($nombre){
            $nombres = ["Enero", "Febrero", "Marzo", "Abril",
                        "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
                        "Octubre", "Noviembre", "Diciembre"];
            return $nombres[$fechaNac[1]-1];
        }
        return $fechaNac[1];
    }
    public function getDiaNacimiento(){
        $fechaNac = explode("-", $this->fecNac);
        return $fechaNac[2];
    }
    public function getUrl(){
        return "/usuarios/ver/".$this->idUsu;
    }
    /**
     * @param Recibe como parametro el nombre de una accion
     * @return Retorna True si alguno de los roles disponibles tiene disponible la accion recibida por parametro
     */
    public function tieneAccion($nombreAccion){
        foreach($this->roles as $rol)
            if($rol->tieneAccion($nombreAccion))
                return true;
        return false;
    }
    public static function generarClaveAleatoria($retornarHash = true){
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890?!#$%&=?*+-';
        $numeroCaracteres = strlen($caracteres);
        $longitudClave = 12;
        $clave = '';
        for($i = 0; $i < $longitudClave; $i++){
            $indice = rand(0, $numeroCaracteres-1);
            $clave.=substr($caracteres, $indice, 1);
        }
        if(!$retornarHash)
            return $clave;
        return \Hash::make($clave);
    }
    public static function enviarEmailRegistro($Ousuario, $claveOriginal){
        $asunto = "Bienvenido al sistema Colmena -SGTH";
        $mensaje = <<<EOD
            <h2>Bienvenido, {$Ousuario->getNombreCompleto()}...</h2><br>
            <h4>
                Has sido registrado en el sistema Colmena -SGTH<br>
                Tus datos de acceso son:<br>
                CI: {$Ousuario->cedula}<br>
                Clave: {$claveOriginal}<br>
            </h4>
EOD;
        return Mailer::enviar($Ousuario, $asunto, $mensaje);
    }
}
