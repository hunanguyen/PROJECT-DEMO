@extends("admin.layout")
@section("do-du-lieu-tu-view")
@php
    function getCustomerName($customer_id){
        $record = DB::table("customers")->where("id","=",$customer_id)->first();
        return isset($record->name) ? $record->name : "";
    }
@endphp
    <div class="col-md-12">
    <div class="panel panel-primary" style="margin-top:20px;">
        <div class="btn btn-primary" style="background-color: #233242">Danh sách đơn hàng</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Customer name</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th style="width:150px;">Status</th>
                    <th style="width:100px;"></th>
                </tr>
                @foreach($data as $row)
            
                <tr>
                    <td>{{ getCustomerName($row->customer_id) }}</td>
                    <td>{{ date("d/m/Y", strtotime($row->date)) }}</td>
                    <td>{{ number_format($row->price) }}</td>
                    <td style="text-align:center;">
                        @if($row->status)
                            <span style="color: red;" class="label label-danger">Đã giao hàng</span>
                        @else
                            <span>Chưa giao hàng</span>
                        @endif
                    </td>
                    <td style="text-align:center;">
                       
                            <a href="{{ url('backend/orders/detail/'.$row->id) }}" class="label label-warning">chi tiết</a>
                       
                    </td>
                </tr>
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