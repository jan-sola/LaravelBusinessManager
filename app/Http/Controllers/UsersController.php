<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserCreateRequest;

class UsersController extends Controller
{

		public function __construct(){
		
			$this->middleware('auth');
		}
		
    /**
     * Display a listing of the users.
     *
     * @return Response
     */
    public function index()
    {
        return $this->getUsers();
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create()
    {
			return view('users.createUser');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(UserCreateRequest $request)
    {
      $input = $request->all();
			
			if($input["password"] == $input["password_confirmation"] ){
				$input["password"] = bcrypt($input["password"]);
				try{
					User::create($input);
					return redirect('/manage');
				}
				catch(\Illuminate\Database\QueryException $e){
					return redirect('/users/create?error=emailInUse');					
				}
			}
			
			return redirect('/users/create?error=unmatchingPasswords');
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id - user id
     * @return Response
     */
    public function show($id)
    {
        return $this->getUser($id);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
			if(Auth::id() == $id || Auth::user()->isAdmin){
				$user = User::findOrFail($id);
				return view('users.editUser', compact('user'));
			}
			
			return redirect('/'); //Redirect to index if user doesnt have permission
    }

    /**
     * Update the specified user in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UserEditRequest $request, $id)
    {
      $input = $request->all();
			$user = User::findOrFail($id);

			if($input["password"] == $input["password_confirmation"] && !empty($input["password"]) ){
				$input["password"] = bcrypt($input["password"]);
				$user->update($input);
				return redirect('/manage');
			}
			
			$input['password'] = $user->password;
			$user->update($input);
			return redirect('/manage');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
      if (Auth::check()){
				$user = User::findOrFail($id);
				$user->delete();
				return redirect('/manage');
			}
			
			return redirect('/manage?error=deletefailed');
    }

		/**
		 * Show JSON listing of all users
		 */		
		public function getUsers(){
			return User::all();
		}
		
   /**
		 * Show JSON listing of a user
     *
     * @param  int  $id - user id
     */					
		public function getUser($id){
			return User::findOrFail($id);
		}
}
