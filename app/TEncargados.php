<?php
/*
Author:QSoto
*/
namespace Colmena;

use Illuminate\Database\Eloquent\Model;

class TEncargados extends Model
{
    protected $table = "TEncargados";
    protected $primarykey = "idEnc";

    public function TUsuarios()
    {
    	return $this->belongsTo('app\TUsuarios');
    }

    public function TActRecu()
    {
    	return $this->belongsTo('app\TActRecu');
    }
}
