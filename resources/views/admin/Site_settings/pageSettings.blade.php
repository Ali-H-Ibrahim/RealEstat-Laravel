@extends('admin.layouts.adminDashboardLayouts.admin_layouts')

@section('title','Creat_Category')
@section('admin_content')


    <div class="app-content content">
                    <form  action="{{route('maximum.number.free.property')}}" id="categoryForm" method="post">
                    @csrf
                        <div class="container">
                            <div class="row">
                        <div class="form-group  col-sm-10 text-center">
                            <label class="lead" for="exampleInputEmail1">maximu number free property</label>
                            <input type="text" class="form-control" name="num" id="name" value="{{$max_num}}"  placeholder="maximu number free property" >
                            <small  id="name_error" class="form-text text-muted alert-danger "></small>
                        </div>

                        <div class="form-group col-sm-3 ">
                            <button  class="btn btn-primary">save </button>
                        </div>
                            </div>
                        </div>
                    </form>
                    <div class="alert alert-success  "  id="added_success" style="display: none" role="alert"> updated successfully</div>
                    <div class="alert alert-danger"  id="add_danger" style="display: none" role="alert">error</div>

    </div>
@endsection

@section("script")
    <script>

        $(document).on('click','#save',function (e){
            e.preventDefault();
            $('#name_error').text('');
            $('#added_success').hide();

            var formData=new FormData($('#categoryForm')[0]);
            $.ajax({
                type:'post',
                enctype:"multipart/form-data",
                url:"{{route('maximum.number.free.property')}}",
                data:formData,
                processData:false,
                contentType:false,
                cache:false,

                success:function (data){

                    if(data.status==true) {
                        $('#added_success').show();
                        $('#added_success').hide(10000);
                    }
                    $('#name').val('');
                },
                error:function (reject){
                    var response=$.parseJSON(reject.responseText);
                    $.each(response.errors,function (key,val){
                        $("#"+key+"_error").text(val[0]);
                    });}
            });
        });
    </script>


    @endsection



