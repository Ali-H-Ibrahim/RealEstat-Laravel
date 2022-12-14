@extends('admin.layouts.adminDashboardLayouts.admin_layouts')

@section('admin_content')

    @if(session('success'))
        <div class="alert alert-success" role="alert">{!! session('success') !!}</div>
    @endif
    <div class="app-content content">

    <form method="post" id="subCategoryForm">
        @csrf
        <div class="container">
            <div class="row">
        <div class="form-group col-sm-5 text-center">
            <label for="exampleInputEmail1">Town Name</label>

            <input type="text" class="form-control" name="name" ID="name" placeholder="name" >

            <small  id="name_error" class="form-text text-muted alert-danger "></small>
        </div>


        <div class="form-group col-sm-7 text-center">
            <label for="exampleInputEmail1">City</label>
            <br>

            <select class="form-group" name="city_id">
                @if(isset($cities) && $cities->count())
                    @foreach($cities as $city )
                        <option  value="{{$city->id}}"> {{$city->name}}</option>
                    @endforeach
                @endif
                    @error('city_id')
                    <small  class="form-text text-muted alert-danger " >{{$message}}</small>
                    @enderror

            </select>
        </div>
                <div class="form-group col-sm-4  text-center">
                    <button id="save" class="btn btn-primary">save </button>
                 </div>

                </div>
            </div>

          </form>

                    <div class="alert alert-success  "  id="added_success" style="display: none" role="alert">Town added successfully</div>
                    <div class="alert alert-danger"  id="add_danger" style="display: none" role="alert">error</div>



    </div>
@endsection

@section("script")
    <script src="{{asset('admin/js/scripts/jquery-3.6.0.min.js')}}" type="text/javascript"></script>
    <script>

        $(document).on('click','#save',function (e){
            e.preventDefault();

            $('#added_success').hide();
            $('#name_error').text('');

            var formData=new FormData($('#subCategoryForm')[0]);

            $.ajax({
                type:'post',
                enctype:"multipart/form-data",
                url:"{{route('store.new.town')}}",
                data:formData,
                processData:false,
                contentType:false,
                cache:false,


                success:function (data){
                    if(data.status==true) {
                        $('#added_success').show();
                        $('#added_success').hide(10000);
                    };

                    $('#name').val('');





                },
                error:function (reject){
                    if(reject){
                        var response=$.parseJSON(reject.responseText);
                        $.each(response.errors,function (key,val){
                            $("#"+key+"_error").text(val[0]);
                        });
                        $('#add_danger').show();
                    }

                }


            });
        });
    </script>
@endsection

