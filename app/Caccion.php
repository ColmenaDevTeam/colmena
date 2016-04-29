<?php
/**
* @author Elias Peraza
*/
namespace Colmena;

use Illuminate\Database\Eloquent\Model;

class Caccion extends Model
{
    protected $table = "t_acciones";
    protected $primaryKey = "idAcc";
    protected $fillable = ['nombre'];
    public $timestamps = false;

    public function roles(){
        return $this->belongsToMany('Colmena\Crol', 't_autorizaciones', 'idAcc', 'idRol');
    }
    /**
    * Funcion que retorna el título legible de un rol, cuyo nombre es en formato
    * modulo.nombre, Ej, rol.listar...
    * @param Ninguno
    * @return Retorna el nombre de la acción convertida en titulo. Ej roles.listar => Listar Roles
    */
    public function getTitulo(){
        $tituloDividido = explode(".",$this->nombre);
        $titulo = ucwords($tituloDividido[1])." ".ucwords($tituloDividido[0]);
        return str_replace("_", " ", $titulo);
    }
    public function getModulo(){
        $tituloDividido = explode(".",$this->nombre);
        return $tituloDividido[0];
    }
    public function getNombreSinModulo(){
        $tituloDividido = explode(".",$this->nombre);
        return $tituloDividido[1];
    }
    public function getUrl(){
        return "/".str_replace("_", "-", str_replace(".", "/", $this->nombre));
    }
    public static function ordenarPorModulo(){

    }
}
