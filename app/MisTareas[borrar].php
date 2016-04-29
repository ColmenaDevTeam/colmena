<?php
/**
* @author QSoto
*/
namespace Colmena;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Cusuario extends Authenticatable
{
    protected $table = "t_usuarios";
    protected $primaryKey = "idUsu";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cedula', 'nombres', 'apellidos',
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
    }
    public function getAuthIdentifier(){
        return $this->cedula;
    }
    public function Crol()
    {
        return $this->belongsToMany('Colmena\Crol', 't_role_usuas', 'idUsu', 'idRol');
    }
    /*
    public function TTareas(){
    	return $this->hasMany('app\TTareas');
    }

    public function TPermRepo(){
    	return $this->hasMany('app\TPermRepo');
    }

    public function TEncargados(){
    	return $this->hasMany('app\TEncargados');
    }*/

}
