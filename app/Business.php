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
		
		public function owner(){
			return $this->belongsTo('App\User', 'ownerId');
		}
				
		public function followers(){
			return $this->belongsToMany('App\User', 'followers', 'businessId', 'userId')->withTimestamps();
		}
		
		public function isFollower($userId){
			
			foreach($this->followers as $user){
				if($user->id == $userId){
					//This user follows the business
					return true;
				}
			}
			return false;
		}
		
		public function isOwnedBy($userId){
			return $this->ownerId == $userId;
		}
		
		/*
		* $userId - integer id of a user
		* Adds a follower if the user is not already following the business
		*/
		public function addFollower($userId){
			$found = false;
			foreach($this->followers() as $user){
				if($user->id == $userId){
					//User is already following this business
					$found = true;
					break;
				}
			}
			if(!$found){
				//Add user if it wasnt found in followers array
				$this->followers()->attach($userId);
			}
		}
}
