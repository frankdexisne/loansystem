@extends('layouts.ace_master')



@section('content-header')
<ul class="breadcrumb">
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="#">Home</a>
    </li>
    <li class="active">Account Profile</li>
</ul>
@endsection

@section('content')
<div class="page-header">
    <h1>
        User Profile Page
        
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
            <div class="clearfix">
                <!-- <div class="pull-left alert alert-success no-margin alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>

                    <i class="ace-icon fa fa-umbrella bigger-120 blue"></i>
                    Click on the image below or on profile fields to edit them ...
                </div> -->

                <div class="pull-right">
                    
                </div>

            </div>

            <div class="hr dotted"></div>

            <div>
                <div id="user-profile-1" class="user-profile row">
                    <div class="col-xs-12 col-sm-3 center">
                        
                        <div>
                    
                            <span class="profile-picture">
                                <img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="{{asset('/images/default-avatar.png')}}" />
                            </span>

                            <div class="space-4"></div>

                            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                <div class="inline position-relative">
                                    <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                        <i class="ace-icon fa fa-circle light-green"></i>
                                        &nbsp;
                                        <span class="white">{{Auth::user()->name}}</span>
                                    </a>

                                    <ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
                                        <li class="dropdown-header"> Change Status </li>

                                        <li>
                                        
                                            <a href="#">
                                                <i class="ace-icon fa fa-circle green"></i>
                                                &nbsp;
                                                <span class="green">Available</span>
                                            </a>

                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ace-icon fa fa-circle red"></i>
                                                &nbsp;
                                                <span class="red">Busy</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ace-icon fa fa-circle grey"></i>
                                                &nbsp;
                                                <span class="grey">Invisible</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-9 center">
                        <div class="form-horizontal">
                            <div class="tabbable">
                                <ul class="nav nav-tabs padding-16">
                                    
                                    @if($data->employee!=null)
                                    <li class="active">
                                        <a data-toggle="tab" href="#edit-basic">
                                            <i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
                                            Employee Profile
                                        </a>
                                    </li>
                                    @endif
                                    

                                    
                                    <li class="{{$data->employee==null ? 'active' : ''}}">
                                        <a data-toggle="tab" href="#edit-password">
                                            <i class="blue ace-icon fa fa-key bigger-125"></i>
                                            Password
                                        </a>
                                    </li>
                                        

                                    

                                </ul>

                                <div class="tab-content profile-edit-tab-content">
                                    
                                    @if($data->employee!=null)
                                    <div id="edit-basic" class="tab-pane {{$data->employee!=null ? 'in active' : ''}}">
                                        <div class="space-10"></div>
                                        <form id="form-basic">
                                            
                                            
                                            
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-pass1">Last name : <font color="red">*</font></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="lname" value="{{Auth::user()->employee->lname}}" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-pass1">First name : <font color="red">*</font></label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="fname" value="{{Auth::user()->employee->fname}}" />
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-pass2">Middle name</label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="mname" value="{{Auth::user()->employee->mname}}"/>
                                                </div>
                                            </div>

                                            
                                            <div class="form-group">
                                                <div class="col-xs-12">
                                                    <div class="clearfix pull-right">
                                                        <button type="submit" class="btn btn-success submit">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                    
                                    
                                    
                                    
                                    

                                    
                                    
                                    <div id="edit-password" class="tab-pane {{$data->employee==null ? 'in active' : ''}}">
                                        <div class="space-10"></div>
                                        <form id="form-password">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-pass1">Current Password</label>

                                                <div class="col-sm-9">
                                                    <input type="password" id="current_password" name="current_password" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-pass1">New Password</label>

                                                <div class="col-sm-9">
                                                    <input type="password" id="new_password" name="new_password" required />
                                                </div>
                                            </div>

                                            <div class="space-4"></div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-pass2">Confirm Password</label>

                                                <div class="col-sm-9">
                                                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" required />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-xs-12">
                                                    <div class="clearfix pull-right">
                                                        <button type="submit" class="btn btn-success submit">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    
                                    
                                    


                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('plugins')
<!-- page specific plugin scripts -->
<script src="{{asset('/theme/js/wizard.min.js')}}"></script>
<script src="{{asset('/theme/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('/theme/js/jquery-additional-methods.min.js')}}"></script>
<script src="{{asset('/theme/js/bootbox.js')}}"></script>
<script src="{{asset('/theme/js/jquery.maskedinput.min.js')}}"></script>
<script src="{{asset('/theme/js/select2.min.js')}}"></script>

<script src="{{asset('/theme/js/jquery-ui.custom.min.js')}}"></script>
<script src="{{asset('/theme/js/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('/theme/js/chosen.jquery.min.js')}}"></script>

<script src="{{asset('/theme/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/theme/js/jquery.dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('/theme/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/theme/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('/theme/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('/theme/js/buttons.print.min.js')}}"></script>
<script src="{{asset('/theme/js/buttons.colVis.min.js')}}"></script>
<!-- <script src="{{asset('/theme/js/dataTables.select.min.js')}}"></script> -->
<script src="{{asset('/theme/js/jquery.gritter.min.js')}}"></script>

@endsection

@section('scripts')
<script type="text/javascript">
    jQuery(function($) {

    $('#form-basic').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
        rules: {
            
            lname: {
                required: true
            },

            fname: {
                required: true
            },

            mname: {
                required: true
            }
            
        },
            
        
            
            
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },
            
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
            $(e).remove();
        },
            
        errorPlacement: function (error, element) {
            if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else error.insertAfter(element.parent());
        },
            
        submitHandler: function (form) {
            var form_data = new FormData(form);
            
            $('#form-basic .submit').html('<i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i><span class="bigger-110"><font size="1">Please wait..</font></span>');
            $('#form-basic .submit').attr('disabled',true);
            form_data.append('_token',"{{csrf_token()}}");
            $.ajax({
                url: "{{url('/employees/')}}"+$('#form-basic').find('input[name="id"]').val(),
                type: "PUT",
                data: form_data,
                dataType: 'JSON',
                processData: false,
                contentType:false,
                cache:false,
                success: function(result){

                    if(result.type=="success"){
                        // $('#form-basic').trigger('reset');
                        $('#form-basic .submit').html('Save');
                        $('#form-basic .submit').removeAttr('disabled');   
                    }

                    


                }
            });
            return false;
        },
        invalidHandler: function (form) {
        }
    });

    $('#form-password').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
        rules: {
            password: {
                required: true
            },
            new_password: {
                required: true,
                equalTo: '#new_password_confirmation'
            },
        },
            
        messages: {
            password: "Password is required",
           
            new_password: {
                required: "New password is required",
                equalTo: "Mismatch password"
            }
        },
            
            
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },
            
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
            $(e).remove();
        },
            
        errorPlacement: function (error, element) {
            if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else error.insertAfter(element.parent());
        },
            
        submitHandler: function (form) {
            var form_data = new FormData(form);
            form_data.append('_token',"{{csrf_token()}}");
            $('#form-password .submit').html('<i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i><span class="bigger-110"><font size="1">Please wait..</font></span>');
            $('#form-password .submit').attr('disabled',true);
            $.ajax({
                url: "{{url('password-update')}}",
                type: "POST",
                data: form_data,
                dataType: 'JSON',
                processData: false,
                contentType:false,
                cache:false,
                success: function(result){

                    if(result.type=="success"){
                        $('#form-password').trigger('reset');
                        $('#form-password .submit').html('Save');
                        $('#form-password .submit').removeAttr('disabled');     
                    }

                    
                }
            });
            return false;
        },
        invalidHandler: function (form) {
        }
    });

    


})
</script>
@endsection