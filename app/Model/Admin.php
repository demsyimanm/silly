<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
	use Notifiable;
    protected $table = 'admin';
	protected $primaryKey = 'id';
	public $timestamps = true;
	public $incrementing = true;

    protected $fillable = array( 
    	'username',
    	'password', 
		'nama', 
    	'role_id'
	);

	public function role()
	{
		return $this->belongsTo('App\Role');
	}
}
