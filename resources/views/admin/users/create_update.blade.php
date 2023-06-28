@extends('admin.layout')
@section('do-du-lieu-tu-view')
    <div class="row">
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ $action }}" class="form-horizontal form-material mx-2">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12">Full Name</label>
                            <div class="col-md-12">
                                <input type="text" name="name" value="{{ isset($record->name)?$record->name:'' }}"
                                    class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="text" name="email" value="{{ isset($record->email)?$record->email:'' }}"
                                class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input type="password" name="password" @if(isset($record->email)) 
                                placeholder="Không đổi password thì không nhập thông tin vào ô textbox này" 
                                @else required @endif class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success text-white">Update User</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    
@endsection