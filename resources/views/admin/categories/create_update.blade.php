@extends('admin.layout')
@section('do-du-lieu-tu-view')
    <div class="row">
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9">
            <div class="card">
				<div class="card-heading"><h1>Add edit</h1></div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{ $action }}" class="form-horizontal form-material mx-2">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12">Parent</label>
                            <div class="col-md-12">
								@php
								if(isset($record->id))
									$categories = DB::table("categories")->where("parent_id","=","0")->where("id","<>",$record->id)->orderBy("id","desc")->get();
								else
									$categories = DB::table("categories")->where("parent_id","=","0")->orderBy("id","desc")->get();
								@endphp
								<select name="parent_id" class="form-control" style="width:250px;">
									<option value="0"></option>
										@foreach($categories as $row)
										<option @if(isset($record->parent_id) && $record->parent_id == $row->id) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>
									@endforeach
								</select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Name</label>
                            <div class="col-md-12">
                                <input type="text" name="name" value="{{ isset($record->name)?$record->name:'' }}"
                                class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12"></label>
                            <div class="col-md-12">
                                <input type="checkbox" @if(isset($record->display_at_home_page) && $record->display_at_home_page == 1) 
                                checked @endif name="display_at_home_page" id="display_at_home_page"> 
                                <label for="display_at_home_page">Display at home page</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">Photo</div>
                            <div class="col-md-10">
                                <input type="file" name="photo">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="submit" value="Process" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    
@endsection