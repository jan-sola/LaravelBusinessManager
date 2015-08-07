<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessRequest;
use Illuminate\Support\Facades\Auth;
//use Request;

class BusinessController extends Controller
{

		public function __construct(){
			
			$this->middleware('auth', ['except' => ['index', 'show']]);
		}
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
		public function show($id){
			$business = Business::findOrFail($id);
			
			$isLoggedIn = Auth::check();
			
			if($isLoggedIn){
				$isFollowing = Auth::user()->isFollowing($id);
				$isOwner = $business->isOwnedBy(Auth::id());
				$isAdmin = Auth::user()->isAdmin;
				//$isOwner = Auth::user()->isOwner($business->id);
			}
			else{ 
				$isFollowing = false;
				$isOwner = false;
				$isAdmin = false;
			}
			/*
			if($isLoggedIn){
				foreach(Auth::user()->owns as $b){
					if($b->id == $id){
						//Current logged in user owns the business
						$isOwner = true;
						break;
					}
				}
			}
			*/
			return view('businesses.viewBusiness', 
				compact('business', 'isLoggedIn', 'isOwner', 'isFollowing', 'isAdmin'));
		}
		
		//Create business view
		public function create(){
			return view('businesses.createBusiness');
		}
		
		//Edit business info view
		public function edit($id){
			$business = Business::findOrFail($id);
			return view('businesses.editBusiness', compact('business'));
		}
		
    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(BusinessRequest $request, $id)
    {
				$input = $request->all();
        $business = Business::findOrFail($id);
				$count = $business->id;

				//Handle file upload
				if( $request->hasFile('businessPhoto') ){
					$file = $request->file('businessPhoto');
					//$filename = str_replace(" ", "_", $input["name"]) . $count . '.' . $file->guessExtension();
					$filename = $count . "." . $file->guessExtension();
					if( $file->isValid() ){
						$file->move('img/', $filename);			
						$input["imagePath"] = '/img/' . $filename;
						
					}
				}
				
				$business->update($input);
				return redirect('/businesses/' . $id);
    }
		
		public function store(BusinessRequest $request){
			$input = $request->all();
			$count = Business::count();
			
			//Handle file upload
			if( $request->hasFile('businessPhoto') ){
				$file = $request->file('businessPhoto');
				//$filename = str_replace(" ", "_", $input["name"]) . $count . '.' . $file->guessExtension();
				$filename = $count . "." . $file->guessExtension();
				if( $file->isValid() ){
					$file->move('img/', $filename);
					$input["imagePath"] = '/img/' . $filename;
				}
			}
			
			$input["ownerId"] = Auth::id();
			Business::create($input);
			return redirect('/');
		}
		
		public function destroy($id){
			if (Auth::check()){
				$business = Business::findOrFail($id);
				$business->delete();
				return redirect('/manage');				
			}
			
			return redirect('/manage?error=deleteFailed');

		}
	
		public function follow(Request $request, $id){
			$input = $request->all();
			$followStatus = $input['followStatus'];
			if (Auth::check()){
				
				$business = Business::findOrFail($id);
				if($followStatus == "follow"){
					$business->addFollower(Auth::id());
				}
				else if($followStatus == "unfollow"){
					$business->followers()->detach(Auth::id());				
				}
				return redirect("/businesses/$id");
			}
			return redirect("/businesses/$id?error=followFailed");
		}
	
		public function getBusinesses(){
			return Business::all();
		}
		
		public function getBusiness($id){
			return Business::findOrFail($id);
		}
		
}
