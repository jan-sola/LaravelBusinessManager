<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'isAdmin'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
		
		public function owns(){
			return $this->hasMany('App\Business', 'ownerId');
		}
		
		
		public function following(){
			return $this->belongsToMany('App\Business', 'followers', 'userId', 'businessId')->withTimestamps();
		}
	
		/*
		*	$businessId - integer id of a business
		*	Returns true if the user is following the business
		*/
		public function isFollowing($businessId){
			
			foreach($this->following as $business){
				if($business->id == $businessId){
					//This user is following the business with the given id
					return true;
				}
			}
			return false;
		}

		/*
		*	$businessId - integer id of a business
		*	Returns true if the user is the owner of the business
		*/		
		public function isOwner($businessId){
			
			$business = App\Business::findOrFail($businessId);
			return $this->id == $business->ownerId;
			
		}
}
