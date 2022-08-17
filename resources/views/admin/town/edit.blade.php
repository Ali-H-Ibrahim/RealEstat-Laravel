@extends('admin.layouts.adminDashboardLayouts.admin_layouts')

@section('admin_content')

    <div class="app-content content">
        <div class="content">
            <div class="row">
                <div class="col-xl-4 col-12">
    <form method="post" action="{{route('update.town',$town->id)}}">
        @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">Name Town</label>
            <input type="text" class="form-control" name="name"  value="{{$town->name}}" placeholder="name" >
            @error('name')
            <small  class="form-text text-muted alert-danger ">{{$message}}</small>
            @enderror

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Cities</label>
            <select class="form-group" name="city_id">
                @if(isset($cities) && $cities->count())
                    @foreach($cities as $city )
                        <option  value="{{$city->id}}"> {{$city->name}}</option>

                    @endforeach
                @endif
                {{--    @else    <option> not found</option>  --}}

                @error('city_id')
                <small  class="form-text text-muted alert-danger " >{{$message}}</small>
                @enderror

            </select>
        </div>
        <input type="submit" class="btn btn-success" value="Update">
    </form>
                </div>
            </div>
        </div>
    </div>

@endsection



