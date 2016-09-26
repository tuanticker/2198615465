
                    <!-- /.col-lg-12 -->
@extends('admin.master')
@section('controller','Category')

@section('action','List')
@section('content')              
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category Parent</th>
                                <th>Status</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($data as $value)
                            <tr class="odd gradeX" align="center">
                                <td>{!! $value['id'] !!}</td>
                                <td>{!! $value['name'] !!}</td>
                                <td>
                                @if($value["parent_id"] == 0)
                                    {!! "None" !!}
                                @else
                                <?php echo DB::table('cates')->where('id',$value["parent_id"])->first()->name; ?>
                                </td>
                                @endif
                                <td>Hiện</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return xacnhanxoa('Bạn có chắc muốn xóa không?')" href="{!! URL::route('admin.cate.getDelete',$value['id']) !!}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.cate.getEdit',$value['id']) !!}">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
@endsection()
               