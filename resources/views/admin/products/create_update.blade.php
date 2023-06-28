@extends("admin.layout")
@section("do-du-lieu-tu-view")
	<div class="col-md-12">  
		<div class="page-breadcrumb">
			<div class="row">
				<div class="col-5 align-self-center">
					<h4 class="page-title">Tạo sản phẩm</h4>
				</div>
	        <div class="panel-body">
	        <form method="post" enctype="multipart/form-data" action="{{ $action }}">
	        	@csrf
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2">Name</div>
	                <div class="col-md-10">
	                    <input type="text" required value="{{ isset($record->name)?$record->name:'' }}" name="name" class="form-control" required>
	                </div>
	            </div>
	            <!-- end rows -->
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2">Price</div>
	                <div class="col-md-10">
	                    <input type="text" required value="{{ isset($record->price)?$record->price:'' }}" name="price" class="form-control" required>
	                </div>
	            </div>
	            <!-- end rows -->
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2">Discount</div>
	                <div class="col-md-10">
	                    <input type="number" required min="0" value="{{ isset($record->discount)?$record->discount:'' }}" name="discount" class="form-control" required>
	                </div>
	            </div>
	            <!-- end rows -->
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2">Category</div>
	                <div class="col-md-10">
	                    @php
		                    $categories = DB::select("select * from categories where parent_id = 0 order by id desc");
	                    @endphp
	                    <select class="form-control" name="category_id" style="width:250px;">
	                    @foreach($categories as $row)	                    
	                    	<option @if(isset($record->category_id)&&$record->category_id==$row->id) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>	
	                    	@php
	                    		$subCategories = DB::table("categories")->where("parent_id","=",$row->id)->orderBy("id","desc")->get();
	                    	@endphp                   
	                    	@foreach($subCategories as $subRow)
	                    		<option @if(isset($record->category_id)&&$record->category_id==$subRow->id) selected @endif value="{{ $subRow->id }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $subRow->name }}</option>
	                    	@endforeach
	                    @endforeach
	                    </select>
	                </div>
	            </div>
	            <!-- end rows -->
	            <style>
	            	.ck-editor__editable{
	            		max-height: 350px;
	            		min-height: 350px;
	            		overflow: scroll;
	            	}
	            </style>
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2">Description</div>
	                <div class="col-md-10">
	                    <textarea name="description" id="description">{{ isset($record->description)?$record->description:'' }}</textarea>
	                    <script type="text/javascript">
	                    	ClassicEditor.create(document.querySelector("#description"));
	                    </script>
	                </div>
	            </div>
	            <!-- end rows -->
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2">Content</div>
	                <div class="col-md-10">
	                    <textarea name="content" id="content">{{ isset($record->content)?$record->content:'' }}</textarea>
	                    <script type="text/javascript">
	                    	ClassicEditor.create(document.querySelector("#content"));
	                    </script>
	                </div>
	            </div>
	            <!-- end rows -->
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2"></div>
	                <div class="col-md-10">
						<input type="checkbox" @if(isset($record->fashion_hot) && $record->fashion_hot == 1) checked @endif name="fashion_hot" id="fashion_hot"> <label for="fashion_hot">Thời trang hot</label>
	                    <input type="checkbox" @if(isset($record->hot) && $record->hot == 1) checked @endif name="hot" id="hot"> <label for="hot">Hot</label>
						<input type="checkbox" @if(isset($record->dochoi_congnghe) && $record->dochoi_congnghe == 1) checked @endif name="dochoi_congnghe" id="dochoi_congnghe"> <label for="dochoi_congnghe">Đồ chơi & công nghệ</label>
						<input type="checkbox" @if(isset($record->your_choise) && $record->your_choise == 1) checked @endif name="your_choise" id="your_choise"> <label for="your_choise">Lựa chọn của bạn</label>
	                </div>
	            </div>
	            <!-- end rows -->
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2">Photo</div>
	                <div class="col-md-10">
	                    <input type="file" name="photo">
	                </div>
	            </div>
	            <!-- end rows -->
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2"></div>
	                <div class="col-md-10">
	                    <input type="submit" value="Process" class="btn btn-primary">
	                </div>
	            </div>
	            <!-- end rows -->
	        </form>
	        </div>
	    </div>
	</div>
@endsection