@extends('admin.layouts.adminDashboardLayouts.admin_layouts')

@section('title','Edit_Category')

@section('admin_content')

    <div class="app-content content">
        <div class="content">
            <div class="row">
                <div class="col-xl-4 col-12">
    <form method="post" action="{{route('update.city',$city->id)}}">
        @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">Category Name</label>
            <input type="text" class="form-control" name="name" value="{{$city->name}}" placeholder="name" >
            @error('name')
            <small  class="form-text text-muted alert-danger ">{{$message}}</small>
            @enderror

        </div>
        <div class="form-group">
        <input type="submit" class="btn btn-success" value="Update">
        </div>
    </form>

                </div>
            </div>
        </div>
    </div>
@endsection



