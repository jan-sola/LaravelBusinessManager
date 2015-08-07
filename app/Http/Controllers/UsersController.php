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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->getUsers();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
			return view('users.createUser');
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return $this->getUser($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
      $user = User::findOrFail($id);
			return view('users.editUser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
		
		public function getUsers(){
			return User::all();
		}
		
		public function getUser($id){
			return User::findOrFail($id);
		}
}
