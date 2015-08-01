<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Business;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBusinessRequest;
use Illuminate\Support\Facades\Auth;
use Request;

class BusinessController extends Controller
{
    //Front page business list view
		public function index(){
			$businesses = Business::all();
			return view('businesses.index', compact('businesses'));
			//return view('businesses.index')->where('businesses', $businesses);
		}
		
		//Business and user manager view
		public function manageIndex(){
			$businesses = Business::all();
			$users = User::all();
			return view('businesses.manageIndex', compact('businesses', 'users'));
		}
		
		//Business detail view
		public function viewBusiness($id){
			$business = Business::find($id);
			
			return view('businesses.viewBusiness', compact('business'));
		}
		
		//Create business view
		public function createBusinessView(){
			return view('businesses.createBusiness');
		}
		
		//Edit business info view
		public function editBusiness($id){
			$business = Business::find($id);
			return view('businesses.manageBusiness', compact('business'));
		}
		
		//Create user view
		public function createUserView(){
			return view('businesses.createUser');
		}

		//Edit user info view
		public function editUser($id){
			$user = User::find($id);
			return view('businesses.manageUser', compact('user'));
		}		
		
		//API functions
		//GET methods
		public function getBusinesses(){
			return Business::all();
		}
		
		public function getBusiness($id){
			return Business::find($id);
		}
		
		public function getUsers(){
			return User::all();
		}
		
		public function getUser($id){
			return User::find($id);
		}
		
		//POST methods
		public function createBusiness(CreateBusinessRequest $request){
			$input = $request->all();
			$count = Business::count();
			
			//Handle file upload
			if( $request->hasFile('businessPhoto') ){
				$file = $request->file('businessPhoto');
				$filename = str_replace(" ", "_", $input["name"]) . $count . '.' . $file->guessExtension();
				if( $file->isValid() ){
					$file->move('img/', $filename);
					$input["imagePath"] = '/img/' . $filename;
				}
			}
			
			$input["ownerId"] = Auth::id();
			Business::create($input);
			return redirect('/');
		}
		
		public function createUser(){
			$input = Request::all();
			
			if($input["password"] == $input["confirmPassword"]){
				$input["password"] = bcrypt($input["password"]);
				User::create($input);
				return redirect('/manage');
			}
			
			return redirect('/usercreate?error=invalidcredentials');
		}
		
		public function deleteBusiness($id){
			if (Auth::check()){
				$business = Business::find($id);
				$business->delete();
				return redirect('/manage');				
			}
			
			return redirect('/manage?error=deletefailed');

		}
		
		public function deleteUser($id){
			if (Auth::check()){
				$user = User::find($id);
				$user->delete();
				return redirect('/manage');
			}
			
			return redirect('/manage?error=deletefailed');
		}
}
