<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Kategori;
class Informasi extends Model
{
    protected $table = 'informasi';
	protected $primaryKey = 'id';
	public $timestamps = true;
	public $incrementing = true;

    protected $fillable = array( 
    	'nama',
    	'kategori_id',
    	'alamat',
    	'latitude',
    	'longitude',
        'email',
        'website',
        'telp',
    	'data'
	);

	public function getKategoriIdAttribute($value)
    {
    	$data = Kategori::find($value);
        return $data->nama;
    }

    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }
}
