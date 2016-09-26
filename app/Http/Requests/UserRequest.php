<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request {

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
		return [
		'txtEmail'  => 'required|unique:users,email|regex:/^[a-z][a-z0-9]*(_[a-z0-9]+)*(\.[a-z0-9]+)*@[a-z0-9]([a-z0-9-][a-z0-9]+)*(\.[a-z]{2,4}){1,2}$/',
		'txtPass'   => 'required',
		'txtRePass' => 'required|same:txtPass',
		'txtUser'   => 'required|unique:users,username'
		];
	}
	public function messages(){
		return [
		'txtPass.required'  => 'Mật khẩu không được rỗng!',
		'txtUser.required'  => 'Tên người dùng không được rỗng!',
		'txtUser.unique'    => 'Tên sản người dùng đã tồn tại!',
		'txtEmail.required' => 'Email không được rỗng!',
		'txtEmail.unique'   => 'Email đã tồn tại!',
		'txtRePass.same'	=> 'Hai mật khẩu chưa khớp nhau!',
		'txtEmail.regex'    => 'Email không đúng!',
		];
	}

}
