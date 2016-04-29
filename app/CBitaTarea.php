<?php
/*
Author:QSoto
*/
namespace Colmena;

use Illuminate\Database\Eloquent\Model;

class CBitaTarea extends Model
{
    protected $table = "t_bita_tares";
    protected $primaryKey = "idBitTar";
   	public $timestamps = false;

    public function CTareas()
    {
        return $this->belongsTo('app/CTareas');
    }
}
