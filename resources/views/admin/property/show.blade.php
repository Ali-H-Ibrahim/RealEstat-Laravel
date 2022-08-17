@extends('admin.layouts.adminDashboardLayouts.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="app-content content">
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="">Starlight</a>
            <span class="breadcrumb-item active">Property Section</span>
        </nav>

        <div class="sl-pagebody">


            <div class="card pd-20 pd-sm-40 container">
                <h6 class="card-body-title">Property Details Page  </h6>

                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Property type: <span class="tx-danger">*</span></label><br>
                                <strong>{{ $property->type }}</strong>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Property area: <span class="tx-danger">*</span></label><br>
                                <strong>{{ $property->area }}</strong>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Number of rooms: <span class="tx-danger">*</span></label><br>
                                <strong>{{ $property->number_of_rooms }}</strong>

                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Number of bathrooms : <span class="tx-danger">*</span></label><br>
                                <strong>{{ $property->number_of_bathrooms}}</strong>

                            </div>
                        </div><!-- col-4 -->


                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Selling Price: <span class="tx-danger">*</span></label>
                                <br>
                                <strong>{{ $property->price }}</strong>

                            </div>
                        </div><!-- col-4 -->


                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label"> ٍShown <span class="tx-danger"></span></label>
                                <br>
                                <strong>@if($property->for_sell) For Sale @else  For Rent @endif</strong>

                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Property Description: <span class="tx-danger">*</span></label>
                                <br>
                                <p>   {!! $property->owner_description !!} </p>

                            </div>
                        </div><!-- col-4 -->


                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image One ( Main Image): <span class="tx-danger">*</span></label><br>
                                <label class="custom-file">

                                    <img src="{{asset("images/".$property->main_image)}}" style="height: 80px; width: 80px;">
                                </label>

                            </div>
                        </div><!-- col-4 -->


                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image Two: <span class="tx-danger">*</span></label><br>
                                <label class="custom-file">
                                    <img src="{{asset("images/".$property->secondary_image)}}" style="height: 80px; width: 80px;">
                                </label>

                            </div>
                        </div><!-- col-4 -->



                        </div><!-- col-4 -->

                    </div><!-- row -->

                    <hr>
                    <br><br>

                    <div class="row">

                        <div class="col-lg-4">
                            <label class="">
                                @if($property->getStatus() == 'Active')
                                    <span class="badge badge-success">Active</span>

                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                                <span>Status</span>
                            </label>

                        </div> <!-- col-4 -->



                    </div><!-- end row -->




                </div><!-- form-layout -->
            </div><!-- card -->


        </div><!-- row -->


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
</div>





@endsection
