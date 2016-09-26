<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request {

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
			'selectCateParent' => 'required|min:1',
			'txtName' => 'required|unique:products,name',
			'fImages' => 'required|image'
		];
	}
	public function messages(){
		return [
			'selectCateParent.required' => 'Bạn chưa chọn danh mục cho sản phẩm',
			'selectCateParent.different' => 'Bạn chưa chọn danh mục cho sản phẩm',
			'txtName.required' => 'Hãy nhập tên sản phẩm',
			'txtName.unique'   => 'Tên sản phẩm đã tồn tại',
			'fImages.required' => 'Hãy chọn ảnh cho sản phẩm',
			'fImages.image' => 'Tệp phải định dạng hình ảnh'
		];
	}

}
