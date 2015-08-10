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

    /**
     * Display a listing of the businesses. Front page view
		 * Guest users will see a list of all businesses.
		 * Logged in users will see a list of businesses they're following followed by a list of all others
     * @return Response
     */
		public function index(){
			$businesses = Business::all();	
			if(Auth::check()){
				$user = Auth::user();
				$followingBusinessIds = $user->following()->lists('id'); //array of business ids of business the user is following
				//Get all businesses the user is not following
				$businesses = Business::whereNotIn('id', $followingBusinessIds)->get(); 
			}
			return view('businesses.index', compact('businesses'));
			//return view('businesses.index')->where('businesses', $businesses);
		}
		
    /**
     * Display the businesses and users. Admin manager view
     * @return Response
     */
		public function manageIndex(){
			$businesses = Business::all();
			$users = User::all();
			return view('businesses.manageIndex', compact('businesses', 'users'));
		}
		
    /**
     * Display the specified business.
     *
     * @param  int  $id - business id
     * @return Response
     */
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

			return view('businesses.viewBusiness', 
				compact('business', 'isLoggedIn', 'isOwner', 'isFollowing', 'isAdmin'));
		}
		
    /**
     * Show the form for creating a new business.
     *
     * @return Response
     */		
		public function create(){
			return view('businesses.createBusiness');
		}
		
    /**
     * Show the form for editing the specified business.
     *
     * @param  int  $id - business id
     * @return Response
     */
		public function edit($id){
			$business = Business::findOrFail($id);
			if($business->isOwnedBy(Auth::id()) || Auth::user()->isAdmin){
				return view('businesses.editBusiness', compact('business'));
			}
			
			return redirect('/'); //Redirect to index if user doesnt have permission
			
		}
		
    /**
     * Update the specified business in storage.
     *
     * @param  Request  $request
     * @param  int  $id - business id
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

    /**
     * Store a newly created business in storage.
     *
     * @param  Request  $request
     * @return Response
     */		
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

    /**
     * Remove the specified business from storage.
     *
     * @param  int  $id - business id
     * @return Response
     */		
		public function destroy($id){
			if (Auth::check()){
				$business = Business::findOrFail($id);
				$business->delete();
				return redirect('/manage');				
			}
			
			return redirect('/manage?error=deleteFailed');

		}

    /**
     * Add or remove the logged in user as a follower
     *
     * @param  Request  $request
     * @param  int  $id - business id
     * @return Response
     */		
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
	
		/**
		* Show JSON listing of all businesses
		*/
		public function getBusinesses(){
			return Business::all();
		}

    /**
		 * Show JSON listing of a business
     *
     * @param  int  $id - business id
     */				
		public function getBusiness($id){
			return Business::findOrFail($id);
		}
		
}
