<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
	protected $table    = 'users';
	protected $fillable = ['full_name', 'email', 'date_of_join', 'date_of_leave' ,'still_work', 'image','status','created_at','updated_at'];


}
