@extends('admin.layouts.adminDashboardLayouts.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="app-content content">
        <div class="container-fluid">

            @if(session('error'))
                <div class="alert alert-danger" role="alert">{!! session('error') !!}</div>
            @endif
            @if(session('delete'))
                <div class="alert alert-success" role="alert">{!! session('delete') !!}</div>
            @endif
            @if(session('update'))
                <div class="alert alert-success" role="alert">{!! session('update') !!}</div>
            @endif
            <div class="sl-page-title">
                <h5>Property List</h5>
            </div><!-- sl-page-title -->
            <br>
            <div class="card pd-20 pd-sm-40">

                <table class="table scroll-horizontal">
                    <thead class="black white-text">
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Type</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if(isset($properties) && $properties->count() > 0)

                        @foreach($properties as $index => $property)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $property -> type }}</td>
                                <td>{{ $property -> price }}</td>

                                <td>{{$property->getStatus()}}</td>
                                <td>
                                    <img src="{{ asset("images/" . $property -> main_image) }}"
                                         width="100" height="100"
                                         alt="Property Image">
                                </td>
                                <td>
                                    <div class="container">
                                        <div class="row">

                                            <div class="col-sm-2">
                                                <a href="{{ route('edit.property', $property -> id) }}"
                                                   class="btn btn-sm btn-info">Edit</a>
                                            </div>

                                            <div class="col-sm-2">
                                                <a href="{{ route('delete.property', $property -> id) }}"
                                                   class="btn btn-sm btn-danger"
                                                   >Delete</a>
                                            </div>



                                            <div class="col-sm-2">
                                                <a href="{{ route('show.property', $property -> id) }}"
                                                   class="btn btn-sm btn-success"
                                                >Show</a>
                                            </div>

                                            <div class="col-sm-3">
                                                <a class="btn btn-sm btn-amber"
                                                   href="{{ route('Property.activated', $property -> id)}}"> @if($property->getStatus()!='Active') تفعيل وقبول المنشور @elseالغاء تفعيل ورفض المنشور@endif </a>
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
    </div><!-- end app-content -->

    <!-- LARGE MODAL -->
    <div id="attribute-modal" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Attribute Add</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


            </div>
        </div><!-- modal-dialog -->
    </div>
    <!-- modal -->

    <!-- ########## END: MAIN PANEL ########## -->
@endsection


@section('script')
    <script src="{{ asset('backend/bootstrap/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('backend/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/bootstrap/js/bootstrap.min.js') }}"></script>

@endsection
