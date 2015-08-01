<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    //Allow these columns to be mass assigned
		protected $fillable = [
				'name',
				'description',
				'ownerId',
				'imagePath',
				'phoneNumber',
				'website'
		];
		/*
		public function followers(){
			return $this->hasMany('App\User');
		}
		*/
		public function owner(){
			return $this->belongsTo('App\User', 'ownerId');
		}
		
}
