@extends('admin.layouts.adminDashboardLayouts.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    @if(session('error'))
        <div class="alert alert-danger" role="alert">{!! session('error') !!}</div>
    @endif
    @if(session('delete'))
        <div class="alert alert-success" role="alert">{!! session('delete') !!}</div>
    @endif
    @if(session('update'))
        <div class="alert alert-success" role="alert">{!! session('update') !!}</div>
    @endif

    <div class="app-content content">

        <div class="container-fluid">
            <div class="sl-page-title">
                <h5>Towns List</h5>
            </div><!-- sl-page-title -->
            <br>
            <div class="card pd-20 pd-sm-40">
                <table class="table  scroll-horizontal">
                    <thead class="black white-text">
                    <tr>
                    <th scope="col">#ID</th>
                        <th scope="col">Town Name</th>
                        <th scope="col">City Name</th>
                        <th scope="col">action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($towns)&&$towns->count()>0)
                        @foreach($towns as $index=> $town)
                            <tr class="subCategoryRow{{$town->id}}">

                                <td>{{$index+1}}</td>
                                <td>{{$town->name}}</td>
                                <td>{{$town->city->name}}</td>


                                <td>
                                    <div class="container">
                                        <div class="row">

                                            <div class="col-sm-8">
                                                <a  class="delete_SubCategory btn btn-sm btn-danger"
                                                    subCategory_id="{{$town->id}}" >Delete</a>
                                            </div>
                                            <div class="col-sm-2">
                                            <a  href="{{route('edit.town',$town->id)}}"
                                                class="btn btn-sm btn-info">Edit</a>
                                            </div>
                                            </div>
                                        </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="card pd-20 pd-sm-40 link-success"></div>
            </div><!-- card -->
        </div>
    </div><!-- sl-pagebody -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
@section("script")
    <script src="{{asset('admin/js/scripts/jquery-3.6.0.min.js')}}" type="text/javascript"></script>

    <script>
        $(document).on('click','.delete_SubCategory',function (e){
            e.preventDefault();

            var id_subCategory=$(this).attr('subCategory_id');

            $.ajax({
                type:'post',
                url:"{{route('delete.town')}}",
                data: {
                    '_token':"{{csrf_token()}}",
                    'id':id_subCategory,

                },
                success:function (data){
                    if(data.status==true) {
                        $('#added_success').show();
                        $('#added_success').hide(10000);
                        $('.subCategoryRow'+data.id).remove();
                    };


                },
                error:function (reject){
                    if(reject){
                        $('#add_danger').show();
                    }

                }


            });
        });
    </script>
