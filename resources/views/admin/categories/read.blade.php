@extends("admin.layout")
@section("do-du-lieu-tu-view")
    <div class="col-md-12">
    <div style="margin-bottom:5px;margin-top:20px;">
        <a href="{{ url('backend/categories/create') }}" class="btn btn-primary">Create</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading" style="background-color: #233242">Danh mục</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th style="width:150px;">Home page</th>
                    <th scope="col"></th>
                </tr>
                @foreach($data as $row)
                <tr>
                    <td style="width: 20px;text-align: center">
                        @if($row->photo != "" && file_exists('upload/categories/'.$row->photo))
                        <img style="width: 20px;" src="{{ asset('upload/categories/'.$row->photo) }}" style="width:100px;">
                        @endif
                    </td>
                    <td style="color: red;">{{ $row->name }}</td>
                    <td style="text-align:center;">
                        @if($row->display_at_home_page == 1)
                        <i style="font-size: 30px;" class="fa-regular fa-square-check"></i>
                        @endif
                    </td>
                    <td style="text-align:center;">
                        <a href="{{ url('backend/categories/update/'.$row->id) }}">Edit&nbsp; |</a>&nbsp;
                        <a href="{{ url('backend/categories/delete/'.$row->id) }}" onclick="return window.confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                    @php
                        $subCategories = DB::table("categories")->where("parent_id","=",$row->id)->orderBy("id","desc")->get();
                    @endphp
                    @foreach($subCategories as $rowSub)
                       <tr>
                        <td>
                            
                        </td>
                            <td style="padding-left: 50px;color:blue;">{{ $rowSub->name }}</td>
                            
                            <td style="text-align:center;">
                                @if($rowSub->display_at_home_page == 1)
                                    <i style="font-size: 30px;" class="fa-regular fa-square-check"></i>
                                @endif
                                </td>
                            <td style="text-align:center;">
                                <a href="{{ url('backend/categories/update/'.$rowSub->id) }}">Edit&nbsp; |</a>&nbsp;
                                <a href="{{ url('backend/categories/delete/'.$rowSub->id) }}" onclick="return window.confirm('Are you sure?');">Delete</a>
                            </td>
                       </tr>
                    @endforeach
                @endforeach
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
            {{ $data->render() }}
        </div>
    </div>
</div>
@endsection