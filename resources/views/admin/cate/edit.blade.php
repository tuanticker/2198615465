@extends('admin.master')
@section('controller','Category')

@section('action','Edit')
@section('content')
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="" method="POST">
                        @include('admin.blocks.error')
                         <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <div class="form-group">
                                <label>Category Parent</label>
                                <select class="form-control" name="selectCateParent">
                                    <option value="0">Please Choose Category</option>
                                    <?php cate_parent($parent,0,"--",$data['parent_id']); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input class="form-control" value="{!! old('txtCateName',isset($data)?$data['name']:null) !!}" name="txtCateName" placeholder="Please Enter Category Name" />
                            </div>
                            <div class="form-group">
                                <label>Category Order</label>
                                <input class="form-control" value="{!! old('txtOrder',isset($data)?$data['order']:null) !!}" name="txtOrder" placeholder="Please Enter Category Order" />
                            </div>
                            <div class="form-group">
                                <label>Category Keywords</label>
                                <input class="form-control" value="{!! old('txtKeywords',isset($data)?$data['keywords']:null) !!}" name="txtOrder" placeholder="Please Enter Category Keywords" />
                            </div>
                            <div class="form-group">
                                <label>Category Description</label>
                                <textarea name="textDescription" class="form-control" rows="3">{!! old('textDescription',isset($data)?$data['description']:null) !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Category Status</label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="1" checked="" type="radio">Visible
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="2" type="radio">Invisible
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Category Edit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
@endsection()
               