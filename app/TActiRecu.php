<?php
/*
Author:QSoto
*/
namespace Colmena;

use Illuminate\Database\Eloquent\Model;

class TActiRecu extends Model
{
    protected $table = "TActiRecu";
    protected $primarykey = "idActRec";

    public function TEncargados()
    {
    	return $this->hasMany('app\TEncargados');//Encargados
}
