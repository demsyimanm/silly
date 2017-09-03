<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Relasi extends Model
{
    protected $table = 'relasi';
	protected $primaryKey = 'id';
	public $timestamps = true;
	public $incrementing = true;

    protected $fillable = array( 
    	'fotoparent',
    	'nama_child',
    	'fotochild', 
		'derajat', 
	);

	public function foto()
	{
		return $this->belongsTo('App\Foto','fotoparent','id');
	}
}
