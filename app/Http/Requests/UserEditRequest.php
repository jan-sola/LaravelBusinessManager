<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;
use Auth;
class UserEditRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
				$uri = $this->path(); //returns users/id/edit
				$id = explode('/', $uri)[1]; //get the id
				//$user = Auth::user();
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'confirmed|min:6',
						
        ];
    }
}
