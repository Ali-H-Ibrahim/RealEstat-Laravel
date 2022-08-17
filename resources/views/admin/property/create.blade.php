@extends('admin.layouts.adminDashboardLayouts.admin_layouts')

@section('admin_content')



    <div class="app-content content">

        @if(session('success'))
            <div class="alert alert-success" role="alert">{!! session('success') !!}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" role="alert">{!! session('error') !!}</div>
        @endif
        <form action="{{route('store.new.property')}}" method="post" id="productForm" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <!-- Brand -->
                    <div class="col-md-4 pt-2">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label info">المنطقة <span class="text-danger"> *</span></label>
                            <select class="form-control select2" name="town_id">

                                <optgroup label="Towns">
                                    @if(isset($towns) && $towns->count())
                                        @foreach($towns as $town )
                                            <option value="{{$town->id}}"> {{$town->name}}
                                            </option>
                                        @endforeach
                                    @endif
                                    @error('town_id')
                                    <small class="form-text text-muted alert-danger ">{{$message}}</small>
                                    @enderror
                                </optgroup>
                            </select>

                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <!-- Name -->
                <div class="row">
                    <div class="form-group col-sm-4 col-12 ">
                        <label class="lead info" for="exampleInputEmail1">نوع العقار </label>

                        <input type="text" class="form-control fieldForm info" name="type" placeholder="type">

                        <small id="name_error" class="form-text text-muted alert-danger form_error"></small>
                        <HR>

                    </div>


                    <!-- Color -->
                    <div class="form-group col-sm-4 col-12 ">
                        <label class="lead info" for="exampleInputEmail1">المساحة</label><br>
                        <input type="text" class="form-control fieldForm info" name="area" placeholder="area">

                        <small id="color_error" class="form-text text-muted alert-danger form_error"></small>
                        <HR>

                    </div>

                    <!-- Price -->
                    <div class="form-group col-sm-4 col-12">
                        <label class="lead info" for="exampleInputEmail1">السعر</label><br>

                        <input type="text" class="form-control fieldForm info" name="price" placeholder="price">

                        <small id="price_error" class="form-text text-muted alert-danger form_error"></small>

                        <HR>
                    </div>

                    <!-- number_of_rooms -->
                    <div class="form-group col-sm-4 col-12">
                        <label class="lead info" for="exampleInputEmail1">عدد الغرف</label><br>

                        <input type="text" class="form-control fieldForm info" name="number_of_rooms" placeholder="number of rooms">

                        <small id="price_error" class="form-text text-muted alert-danger form_error"></small>

                        <HR>
                    </div>

                    <!-- number_of_bathrooms -->
                    <div class="form-group col-sm-4 col-12">
                        <label class="lead info" for="exampleInputEmail1">عدد الحمامات</label><br>

                        <input type="text" class="form-control fieldForm info" name="number_of_bathrooms" placeholder="number of bathrooms">

                        <small id="price_error" class="form-text text-muted alert-danger form_error"></small>

                        <HR>
                    </div>

                    <!-- dimension_of_the_school -->
                    <div class="form-group col-sm-4 col-12">
                        <label class="lead info" for="exampleInputEmail1">البعد عن المدينة  بال: ك.متر</label><br>

                        <input type="text" class="form-control fieldForm info" name="dimension_of_the_city" placeholder="dimension of the city">

                        <small id="price_error" class="form-text text-muted alert-danger form_error"></small>

                        <HR>
                    </div>

                    <!-- dimension_of_the_school -->
                    <div class="form-group col-sm-4 col-12">
                        <label class="lead info" for="exampleInputEmail1">البعد عن المدرسة مقدر  بال: ك.متر</label><br>

                        <input type="text" class="form-control fieldForm info" name="dimension_of_the_school" placeholder="dimension of the school">

                        <small id="price_error" class="form-text text-muted alert-danger form_error"></small>

                        <HR>
                    </div>

                    <!-- dimension_of_the_market -->
                    <div class="form-group col-sm-4 col-12">
                        <label class="lead info" for="exampleInputEmail1">البعد عن السوق مقدر بال: ك.متر</label><br>

                        <input type="text" class="form-control fieldForm info" name="dimension_of_the_market" placeholder="dimension of the marketd">

                        <small id="price_error" class="form-text text-muted alert-danger form_error"></small>

                        <HR>
                    </div>


                    <!-- Description -->
                    <div class="form-group col-sm-9 col-12 ">
                        <label class="lead info" for="exampleInputEmail1">الوصف</label><br>
                        <textarea rows="8" type="text" class="form-control fieldForm info" name="owner_description"
                                  placeholder="description"></textarea>
                        <small id="description_error" class="form-text text-muted alert-danger form_error"></small>

                    </div>


                    <!-- Images -->
                    <div class="form-group col-sm-12 col-12">
                        <label class="lead info" for="exampleInputEmail1">main image</label><br>
                        <label>
                            <input type="file" class="form-control fieldForm info" name="main_image">
                        </label>
{{--                         error message--}}
                        <small id="main_img_error" class="form-text text-muted alert-danger form_error"></small>

                    </div>
                    <!-- Images -->
                    <div class="form-group col-sm-12 col-12">
                        <label class="lead info" for="exampleInputEmail1">secondary image</label><br>
                        <label>
                            <input type="file" class="form-control fieldForm info" name="secondary_image">
                        </label>
{{--                         error message--}}
                        <small id="main_img_error" class="form-text text-muted alert-danger form_error"></small>

                    </div>

                    <!-- End Images -->
                    <!-- Status -->
                    <div class="form-group col-sm-4 col-12">
                        <label class="lead info" for="exampleInputEmail1">Activity Status</label>
                        <select class="form-group info" name="status">
                            <option value='on'> Active</option>
                            <option value='off'> In-active</option>
                            <small id="status_error" class="form-text text-muted alert-danger form_error"></small>
                        </select>
                    </div>


                    <div class="form-group col-sm-4 col-12">
                        <label class="lead info" for="exampleInputEmail1"> Display type</label>
                        <select class="form-group info" name="display_type">
                            <option value=1>for_sell</option>
                            <option value=0>for_rent</option>
                            <small id="status_error" class="form-text text-muted alert-danger form_error"></small>
                        </select>
                    </div>


                    <div class="form-group col-sm-4 col-12">
                        <label class="lead info" for="exampleInputEmail1"> هل يحوي اشتراك هاتف أرضي </label>
                        <select class="form-group info" name="phone_subscription">
                            <option value=1>نعم</option>
                            <option value=0>لا</option>
                            <small id="status_error" class="form-text text-muted alert-danger form_error"></small>
                        </select>
                    </div>

                    <div class="form-group col-sm-4 col-12">
                        <label class="lead info" for="exampleInputEmail1"> هل يحوي اشتراك نت </label>
                        <select class="form-group info" name="net_subscription">
                            <option value=1>نعم</option>
                            <option value=0>لا</option>
                            <small id="status_error" class="form-text text-muted alert-danger form_error"></small>
                        </select>
                    </div>


                </div>

                <!-- Submit -->
                <div class="form-group col-sm-4 col-12">
                    <button id="save" type="submit" class="btn btn-info">save</button>
                </div>
            </div>
        </form>
        <div class="alert alert-success" id="added_success" style="display: none" role="alert">added successfully</div>
        <div class="alert alert-danger" id="add_danger" style="display: none" role="alert">error</div>
    </div>

@endsection

@section('script')
    <script src="{{asset('admin/js/scripts/jquery-3.6.0.min.js')}}" type="text/javascript"></script>
{{--     <script>--}}
{{--        $(document).on('click', '#save', function (e) {--}}
{{--            e.preventDefault();--}}

{{--            $('.form_error').text('');--}}
{{--            $('#added_success').hide();--}}
{{--            var formData = new FormData($('#productForm')[0]);--}}
{{--            $.ajax({--}}
{{--                type: 'post',--}}
{{--                enctype: "multipart/form-data",--}}
{{--                url: "{{route('store.new.property')}}",--}}
{{--                data: formData,--}}
{{--                processData: false,--}}
{{--                contentType: false,--}}
{{--                cache: false,--}}
{{--                success: function (data) {--}}
{{--                    if (data.status == true) {--}}
{{--                        $('#added_success').show();--}}
{{--                        $('#added_success').hide(10000);--}}
{{--                    }--}}
{{--                    $('.fieldForm').val('');--}}

{{--                },--}}
{{--                error: function (reject) {--}}
{{--                    if (reject) {--}}

{{--                        var response = $.parseJSON(reject.responseText);--}}
{{--                        $.each(response.errors, function (key, val) {--}}
{{--                            $("#" + key + "_error").text(val[0]);--}}
{{--                        });--}}
{{--                    }--}}


{{--                    //$('#add_danger').show();--}}
{{--                }--}}


{{--            });--}}
{{--        });--}}


{{--        $('.Category').on('change', function (e) {--}}
{{--            e.preventDefault();--}}
{{--            var category_id = $(this).val();--}}
{{--            // var id_category=$(this).attr('category_id');--}}

{{--            $.ajax({--}}
{{--                type: 'post',--}}
{{--                url: "{{route('show.town')}}",--}}
{{--                data: {--}}
{{--                    '_token': "{{csrf_token()}}",--}}
{{--                    'id': category_id,--}}

{{--                },--}}

{{--                success: function (data) {--}}
{{--                    if (data.status == true) {--}}

{{--                        var d = $('select[name="SubCategory_id"]').empty();--}}
{{--                        $.each(data.data, function (key, value) {--}}

{{--                            $('select[name="SubCategory_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');--}}

{{--                        });--}}

{{--                    } else {--}}
{{--                        alert('الرجاء اختيار قسم');--}}
{{--                    }--}}

{{--                },--}}
{{--                error: function (reject) {--}}
{{--                    if (reject) {--}}
{{--                        $('#add_danger').show();--}}
{{--                    }--}}

{{--                }--}}


{{--            });--}}
{{--        });--}}

{{--    </script>--}}


@endsection

