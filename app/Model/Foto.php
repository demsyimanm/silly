<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Informasi;
class Foto extends Model
{
    protected $table = 'foto';
	protected $primaryKey = 'id';
	public $timestamps = true;
	public $incrementing = true;

    protected $fillable = array( 
    	'nama',
    	'informasi_id', 
		'path'
	);

	public function informasi()
	{
		return $this->belongsTo('App\Informasi');
	}

    public function relasi()
    {
        return $this->hasMany('App\Model\Relasi','fotoparent','id');
    }

	public function getInformasiIdAttribute($value)
    {
    	$data = Informasi::find($value);
        return $data->nama;
    }

    public function getPathAttribute($value)
    {	
    	$path = url($value);
    	$path = "<img src=".$path." style='width:100px'>";
        return $path;
    }
}
