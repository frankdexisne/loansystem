@extends('layouts.ace_master')

@section('style')
<style>
.error-provider{
    color: red;
}
.hide-error{
    display:none;
}
</style>
@endsection

@section('content-header')
<ul class="breadcrumb">
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="#">Home</a>
    </li>
    <li class="active">Loan References</li>
</ul>
@endsection

@section('content')



<div class="row">
    
    <div class="col-12">
        <div class="tabbable">
            <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
                @canany('categories.index|categories.create')
                <li class="active">
                    <a data-toggle="tab" href="#category">Categories</a>
                </li>
                @endcanany
                @canany('terms.index|terms.create')
                <li>
                    <a data-toggle="tab" href="#term">Terms</a>
                </li>
                @endcanany
                @canany('payment-modes.index|payment-modes.create')
                <li>
                    <a data-toggle="tab" href="#payment-mode">Payment Modes</a>
                </li>
                @endcanany
                @canany('charges.index|charges.create')
                <li>
                    <a data-toggle="tab" href="#charge">Charges</a>
                </li>
                @endcanany
                @canany('branches.index|branches.create')
                <li>
                    <a data-toggle="tab" href="#branch">Branches</a>
                </li>
                @endcanany
                @canany('employees.index|employees.create')
                <li>
                    <a data-toggle="tab" href="#employee">Employees & Users</a>
                </li>
                @endcanany
                @can('roles-and-permission.index') 
                <li>
                    <a data-toggle="tab" href="#role">Roles</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#permission">Permission</a>
                </li>
                @endcan
                
            </ul>

            <div class="tab-content">
                @canany('categories.index|categories.create')
                <div id="category" class="tab-pane in active">
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            @can('categories.index')
                                @include('references.categories.index')
                            @endcan
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            @can('categories.create')
                                @include('references.categories.form')
                            @endcan
                        </div>
                    </div>
                </div>
                @endcanany
                @canany('terms.index|terms.create')
                <div id="term" class="tab-pane">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            @can('terms.index')
                            @include('references.terms.index')
                            @endcan
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            @can('terms.create')
                                @include('references.terms.form')
                            @endcan
                        </div>
                    </div>
                    
                </div>
                @endcanany

                @canany('payment-modes.index|payment-modes.create')
                <div id="payment-mode" class="tab-pane">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            @can('payment-modes.index')
                                @include('references.payment-modes.index')
                            @endcan
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            @can('payment-modes.create')
                                @include('references.payment-modes.form')
                            @endcan
                        </div>
                    </div>
                </div>
                @endcanany

                @canany('charges.index|charges.create')
                <div id="charge" class="tab-pane">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            @can('charges.index')
                                @include('references.charges.index')
                            @endcan
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            @can('charges.create')
                                @include('references.charges.form')
                            @endcan
                        </div>
                    </div>
                    
                </div>
                @endcanany
                @canany('branches.index|branches.create')
                <div id="branch" class="tab-pane">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            @can('branches.index')
                                @include('references.branches.index')
                            @endcan
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            @can('branches.create')
                                @include('references.branches.form')
                            @endcan
                        </div>
                    </div>
                    
                </div>
                @endcanany

                @canany('employees.index|employees.create')
                <div id="employee" class="tab-pane">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            @can('employees.index')
                                @include('references.employees.index')
                            @endcan
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            @canany('employees.create|employees.edit')
                                @include('references.employees.form')
                            @endcanany
                        </div>
                    </div>
                    
                </div>
                @endcanany
                
                @can('roles-and-permission.index')
                <div id="role" class="tab-pane">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            @include('references.roles_and_permission.roles')
                        </div>
                    </div>
                    
                </div>
                <div id="permission" class="tab-pane">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            @include('references.roles_and_permission.index')
                        </div>
                    </div>
                    
                </div>
                @endcan

                
            </div>
        </div>
    </div><!-- /.col -->
</div>
@endsection

@section('scripts')
<!-- page specific plugin scripts -->
<script src="{{asset('/ace-master')}}/js/jquery.dataTables.min.js"></script>
<script src="{{asset('/ace-master')}}/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="{{asset('/ace-master')}}/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/ace-master')}}/js/buttons.flash.min.js"></script>
<script src="{{asset('/ace-master')}}/js/buttons.html5.min.js"></script>
<script src="{{asset('/ace-master')}}/js/buttons.print.min.js"></script>
<script src="{{asset('/ace-master')}}/js/buttons.colVis.min.js"></script>
<script src="{{asset('/ace-master')}}/js/dataTables.select.min.js"></script>
<script src="{{asset('/ace-master')}}/js/jquery.validate.min.js"></script>
<script src="{{asset('/js/sweetalert2.js')}}"></script>
<script src="{{asset('/js/references.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){    

    
    //  START OF CATEGORY

    var table_category = $('#table-category').DataTable({
        ajax: "{{url('categories-json')}}",
        rowId: "id",
        processing: true,
        columnDefs: [
            {width: "20%", targets: [1]}
        ],
        columns: [
            {data : 'name'},
            {data: null, render(data,type){
                var actionButtons = '<div class="action-buttons">';
                @can('categories.edit')
                    actionButtons += '<a class="green edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
                @endcan
                @can('categories.destroy')
                    actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
                @endcan
                actionButtons += '</div>';
                return actionButtons;
            }}
        ]
    });

    @can('categories.create')
        
        $("#form-category").validate(
            {                   
                rules:
                {   
                    name:
                    {
                        required: true
                    }
                    
                },
                messages:
                {   
                    name:
                    {
                        required: 'Please enter name'
                    }
                },                  
                
                errorPlacement: function(error, element)
                {
                    error.insertAfter(element.parent());
                },
                submitHandler: function(form) {
                var form_data = new FormData(form);
                form_data.append('_token',"{{csrf_token()}}");
                $.ajax({
                    url: "{{route('categories.store')}}",
                    type: "POST",
                    data: form_data,
                    dataType: 'JSON',
                    processData: false,
                    contentType:false,
                    cache:false,
                    success: function(result){
                        
                        Swal.fire(
                            'Success!',
                            'Record has been saved.',
                            'success'
                        ).then((result)=>{
                            $('#form-category').trigger('reset');   
                            table_category.ajax.url("{{url('categories-json')}}").load();
                        })
                    },
                    error: function(xhr,status){
                        
                    }
                });
                return false;
                }
        });


    @endcan

    @can('categories.edit')
        table_category.on('click','.edit',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            var data = table_category.row($tr).data();
            $tds = $tr.find('td');
            $tds.eq(0).html('<div class="form-group"><input type="text" class="form-control name" value="'+data['name']+'" style="width:100%;" required><span class="name" style="display:none"></div></div>');
            $actionButtonTD.html('<div class="action-buttons"><a class="green submit" href="#"><i class="ace-icon fa fa-check bigger-130"></i></a><a class="red cancel" href="#"><i class="ace-icon fa fa-times bigger-130"></i></a></div>');
        })

        table_category.on('click','.submit',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            
            var actionButtons = '<div class="action-buttons">';
            @can('categories.edit')
                actionButtons += '<a class="green edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            @endcan
            @can('categories.destroy')
                actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            @endcan
            actionButtons += '</div>';
            var data = table_category.row($tr).data();
            
            $tds = $tr.find('td');         
            $name = $tds.eq(0).find('input.name').val();
            
            
            $.ajax({
                url: "{{url('/categories')}}/"+data['id'],
                type: "PUT",
                data: {_token : "{{csrf_token()}}", id: data['id'], name: $name},
                success: function(result){
                    data['name']=$name;
                    $tds.eq(0).html($name);
                    $actionButtonTD.html(actionButtons);
                },
                error: function(xhr,status){
                    if(xhr.status==422){
                        var responseJSON = xhr.responseJSON;
                        var jsonData = responseJSON.errors;
                        Object.keys(jsonData).forEach(function(key) {
                            var value = jsonData[key][0];
                            $span = $tr.find('.'+key);
                            $span.attr('style','color:red');
                            $span.html(value);
                        });
                    }
                }
            })
            
            
        });

        table_category.on('click','.cancel',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            var data = table_category.row($tr).data();
            $tds = $tr.find('td');
            $tds.eq(0).html(data['name']);
            var actionButtons = '<div class="action-buttons">';
            @can('categories.edit')
                actionButtons += '<a class="green edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            @endcan
            @can('categories.destroy')
                actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            @endcan
            actionButtons += '</div>';
            $actionButtonTD.html(actionButtons);
        })

    @endcan
    
    @can('categories.destory')
        table_category.on('click','.delete',function(e){
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
            }
            var data = table_category.row($tr).data();
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this category!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {    
                if (result.isConfirmed) {
                    var form_data = { _token : "{{csrf_token()}}", _method: "_delete" , id: data['id']};

                    $.ajax({
                        url: "{{url('/categories')}}/"+data['id'],
                        type: "DELETE",
                        data: form_data,
                        success: function(result){
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then((result)=>{
                                table_category.row($tr).remove().draw();
                            })
                        }
                    });
                    
                }
            })
            
            e.preventDefault();
        });
    @endcan

    // END OF CATEGORY

    // START OF TERMS
    var table_term = $('#table-term').DataTable({
        ajax: "{{url('terms-json')}}",
        rowId: "id",
        processing: true,
        columnDefs: [
            {width: "20%", targets: [1]}
        ],
        columns: [
            {data : 'no_of_months'},
            {data: null, render(data,type){
                var actionButtons = '<div class="action-buttons">';
                @can('terms.edit')
                    actionButtons += '<a class="green edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
                @endcan
                @can('terms.destroy')
                    actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
                @endcan
                actionButtons += '</div>';
                return actionButtons;
            }}
        ]
    });

    @can('terms.create')
        
        $("#form-term").validate(
            {                   
                rules:
                {   
                    no_of_months:
                    {
                        required: true,
                        number: true
                    }
                    
                },
                messages:
                {   
                    no_of_months:
                    {
                        required: 'Please enter name',
                        number: 'Please enter number'
                    }
                },                  
                
                errorPlacement: function(error, element)
                {
                    error.insertAfter(element.parent());
                },
                submitHandler: function(form) {
                var form_data = new FormData(form);
                form_data.append('_token',"{{csrf_token()}}");
                $.ajax({
                    url: "{{route('terms.store')}}",
                    type: "POST",
                    data: form_data,
                    dataType: 'JSON',
                    processData: false,
                    contentType:false,
                    cache:false,
                    success: function(result){
                        
                        Swal.fire(
                            'Success!',
                            'Record has been saved.',
                            'success'
                        ).then((result)=>{
                            $('#form-term').trigger('reset');   
                            table_term.ajax.url("{{url('terms-json')}}").load();
                        })
                    },
                    error: function(xhr,status){
                        
                    }
                });
                return false;
                }
        });


    @endcan

    @can('terms.edit')
        table_term.on('click','.edit',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            var data = table_term.row($tr).data();
            $tds = $tr.find('td');
            $tds.eq(0).html('<div class="form-group"><input type="number" class="form-control no_of_months" value="'+data['no_of_months']+'" style="width:100%;" required><span class="no_of_months" style="display:none"></div></div>');
            $actionButtonTD.html('<div class="action-buttons"><a class="green submit" href="#"><i class="ace-icon fa fa-check bigger-130"></i></a><a class="red cancel" href="#"><i class="ace-icon fa fa-times bigger-130"></i></a></div>');
        })

        table_term.on('click','.submit',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            
            var actionButtons = '<div class="action-buttons">';
            @can('terms.edit')
                actionButtons += '<a class="green edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            @endcan
            @can('terms.destroy')
                actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            @endcan
            actionButtons += '</div>';
            var data = table_term.row($tr).data();
            $tds = $tr.find('td');         
            $no_of_months = $tds.eq(0).find('input.no_of_months').val();
            $.ajax({
                url: "{{url('/terms')}}/"+data['id'],
                type: "PUT",
                data: {_token : "{{csrf_token()}}", id: data['id'], no_of_months: $no_of_months},
                success: function(result){
                    data['no_of_months']=$no_of_months;
                    $tds.eq(0).html($no_of_months);
                    $actionButtonTD.html(actionButtons);
                },
                error: function(xhr,status){
                    if(xhr.status==422){
                        var responseJSON = xhr.responseJSON;
                        var jsonData = responseJSON.errors;
                        Object.keys(jsonData).forEach(function(key) {
                            var value = jsonData[key][0];
                            $span = $tr.find('.'+key);
                            $span.attr('style','color:red');
                            $span.html(value);
                        });
                    }
                }
            })
            
            
        });

        table_term.on('click','.cancel',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            var data = table_term.row($tr).data();
            $tds = $tr.find('td');
            $tds.eq(0).html(data['name']);
            var actionButtons = '<div class="action-buttons">';
            @can('terms.edit')
                actionButtons += '<a class="green edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            @endcan
            @can('terms.destroy')
                actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            @endcan
            actionButtons += '</div>';
            $actionButtonTD.html(actionButtons);
        })

    @endcan
    
    @can('terms.destory')
        table_term.on('click','.delete',function(e){
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
            }
            var data = table_term.row($tr).data();
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this category!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {    
                if (result.isConfirmed) {
                    var form_data = { _token : "{{csrf_token()}}", _method: "_delete" , id: data['id']};

                    $.ajax({
                        url: "{{url('/terms')}}/"+data['id'],
                        type: "DELETE",
                        data: form_data,
                        success: function(result){
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then((result)=>{
                                table_term.row($tr).remove().draw();
                            })
                        }
                    });
                    
                }
            })
            
            e.preventDefault();
        });
    @endcan
    // END OF TERMS

    // START OF PAYMENT MODE
    var table_payment_mode = $('#table-payment-mode').DataTable({
        ajax: "{{url('payment-modes-json')}}",
        rowId: "id",
        processing: true,
        columnDefs: [
            {width: "20%", targets: [1]}
        ],
        columns: [
            {data : 'name'},
            {data : 'add_days'},
            {data: null, render(data,type){
                var actionButtons = '<div class="action-buttons">';
                @can('payment-modes.edit')
                    actionButtons += '<a class="green edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
                @endcan
                @can('payment-modes.destroy')
                    actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
                @endcan
                actionButtons += '</div>';
                return actionButtons;
            }}
        ]
    });

    @can('categories.create')
        
        $("#form-payment-mode").validate(
            {                   
                rules:
                {   
                    name:
                    {
                        required: true
                    },
                    add_days: {
                        required: true,
                        number: true,
                    }
                    
                },
                messages:
                {   
                    name:
                    {
                        required: 'Please enter name'
                    },
                    add_days: {
                        required: 'Please enter additional days',
                        number: 'Please enter number'
                    }
                },                  
                
                errorPlacement: function(error, element)
                {
                    error.insertAfter(element.parent());
                },
                submitHandler: function(form) {
                var form_data = new FormData(form);
                form_data.append('_token',"{{csrf_token()}}");
                $.ajax({
                    url: "{{route('payment-modes.store')}}",
                    type: "POST",
                    data: form_data,
                    dataType: 'JSON',
                    processData: false,
                    contentType:false,
                    cache:false,
                    success: function(result){
                        
                        Swal.fire(
                            'Success!',
                            'Record has been saved.',
                            'success'
                        ).then((result)=>{
                            $('#form-payment-mode').trigger('reset');   
                            table_payment_mode.ajax.url("{{url('payment-modes-json')}}").load();
                        })
                    },
                    error: function(xhr,status){
                        
                    }
                });
                return false;
                }
        });


    @endcan

    @can('categories.edit')
        table_payment_mode.on('click','.edit',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            var data = table_payment_mode.row($tr).data();
            $tds = $tr.find('td');
            $tds.eq(0).html('<div class="form-group"><input type="text" class="form-control name" value="'+data['name']+'" style="width:100%;" required><span class="name" style="display:none"></div></div>');
            $tds.eq(1).html('<div class="form-group"><input type="number" class="form-control add_days" value="'+data['add_days']+'" style="width:100%;" required><span class="add_days" style="display:none"></div></div>');
            $actionButtonTD.html('<div class="action-buttons"><a class="green submit" href="#"><i class="ace-icon fa fa-check bigger-130"></i></a><a class="red cancel" href="#"><i class="ace-icon fa fa-times bigger-130"></i></a></div>');
        })

        table_payment_mode.on('click','.submit',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            
            var actionButtons = '<div class="action-buttons">';
            @can('payment-modes.edit')
                actionButtons += '<a class="green edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            @endcan
            @can('payment-modes.destroy')
                actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            @endcan
            actionButtons += '</div>';
            var data = table_payment_mode.row($tr).data();
            $tds = $tr.find('td');         
            $name = $tds.eq(0).find('input.name').val();
            $add_days = $tds.eq(1).find('input.add_days').val();
            $.ajax({
                url: "{{url('/payment-modes')}}/"+data['id'],
                type: "PUT",
                data: {_token : "{{csrf_token()}}", id: data['id'], name: $name, add_days : $add_days},
                success: function(result){
                    data['name']=$name;
                    data['add_days']=$add_days;
                    $tds.eq(0).html($name);
                    $tds.eq(1).html($add_days);
                    $actionButtonTD.html(actionButtons);
                },
                error: function(xhr,status){
                    if(xhr.status==422){
                        var responseJSON = xhr.responseJSON;
                        var jsonData = responseJSON.errors;
                        Object.keys(jsonData).forEach(function(key) {
                            var value = jsonData[key][0];
                            $span = $tr.find('.'+key);
                            $span.attr('style','color:red');
                            $span.html(value);
                        });
                    }
                }
            })
            
            
        });

        table_payment_mode.on('click','.cancel',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            var data = table_payment_mode.row($tr).data();
            $tds = $tr.find('td');
            $tds.eq(0).html(data['name']);
            $tds.eq(1).html(data['add_days']);
            var actionButtons = '<div class="action-buttons">';
            @can('payment-modes.edit')
                actionButtons += '<a class="green edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            @endcan
            @can('payment-modes.destroy')
                actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            @endcan
            actionButtons += '</div>';
            $actionButtonTD.html(actionButtons);
        })

    @endcan
    
    @can('payment-modes.destory')
        table_payment_mode.on('click','.delete',function(e){
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
            }
            var data = table_payment_mode.row($tr).data();
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this category!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {    
                if (result.isConfirmed) {
                    var form_data = { _token : "{{csrf_token()}}", _method: "_delete" , id: data['id']};

                    $.ajax({
                        url: "{{url('/payment-modes')}}/"+data['id'],
                        type: "DELETE",
                        data: form_data,
                        success: function(result){
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then((result)=>{
                                table_payment_mode.row($tr).remove().draw();
                            })
                        }
                    });
                    
                }
            })
            
            e.preventDefault();
        });
    @endcan
    // END OF PAYMENT MODE

    // START OF CHARGES
    var table_charge = $('#table-charge').DataTable({
        ajax: "{{url('charges-json')}}",
        rowId: "id",
        processing: true,
        columnDefs: [
            {width: "20%", targets: [1]}
        ],
        columns: [
            {data : 'name'},
            {data: 'value'},
            {data: 'is_percent',render(data,type){
                var returnHTML = data==1 ? '<i class="ace-icon fa fa-check bigger-130"  style="color:green;"></i>' : '<i class="ace-icon fa fa-times bigger-130" style="color:red;"></i>';
                return returnHTML;
            }},
            {data: 'is_visible',render(data,type){
                var returnHTML = data==1 ? '<i class="ace-icon fa fa-check bigger-130"  style="color:green;"></i>' : '<i class="ace-icon fa fa-times bigger-130" style="color:red;"></i>';
                return returnHTML;
            }},
            {data: null, render(data,type){
                var actionButtons = '<div class="action-buttons">';
                @can('changes.edit')
                    actionButtons += '<a class="green edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
                @endcan
                @can('charges.destroy')
                    actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
                @endcan
                actionButtons += '</div>';
                return actionButtons;
            }}
        ]
    });

    @can('charges.create')
        
        $("#form-charge").validate(
            {                   
                rules:
                {   
                    name:
                    {
                        required: true
                    },
                    value:
                    {
                        required: true,
                        number: true,
                    },
                    
                },
                messages:
                {   
                    name:
                    {
                        required: 'Please enter name'
                    },
                    value:{
                        required: 'Please enter value',
                        number: 'Please enter number'
                    }
                },                  
                
                errorPlacement: function(error, element)
                {
                    error.insertAfter(element.parent());
                },
                submitHandler: function(form) {
                var form_data = new FormData(form);
                form_data.append('_token',"{{csrf_token()}}");
                $.ajax({
                    url: "{{route('charges.store')}}",
                    type: "POST",
                    data: form_data,
                    dataType: 'JSON',
                    processData: false,
                    contentType:false,
                    cache:false,
                    success: function(result){
                        
                        Swal.fire(
                            'Success!',
                            'Record has been saved.',
                            'success'
                        ).then((result)=>{
                            $('#form-charge').trigger('reset');   
                            table_category.ajax.url("{{url('charges-json')}}").load();
                        })
                    },
                    error: function(xhr,status){
                        
                    }
                });
                return false;
                }
        });


    @endcan

    @can('charges.edit')
        table_charge.on('click','.edit',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            var data = table_charge.row($tr).data();
            $tds = $tr.find('td');
            $tds.eq(0).html('<div class="form-group"><input type="text" class="form-control name" value="'+data['name']+'" style="width:100%;" required><span class="name" style="display:none"></div></div>');
            $tds.eq(1).html('<div class="form-group"><input type="number" class="form-control value" value="'+data['value']+'" style="width:100%;" required><span class="value" style="display:none"></div></div>');
            $tds.eq(2).html('<div class="form-group"><input type="checkbox" class="form-control is_percent" '+(data['is_percent']==1 ? 'checked' : '')+'>');
            $tds.eq(3).html('<div class="form-group"><input type="checkbox" class="form-control is_visible" '+(data['is_visible']==1 ? 'checked' : '')+'>');
            $actionButtonTD.html('<div class="action-buttons"><a class="green submit" href="#"><i class="ace-icon fa fa-check bigger-130"></i></a><a class="red cancel" href="#"><i class="ace-icon fa fa-times bigger-130"></i></a></div>');
        })

        table_charge.on('click','.submit',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            
            var actionButtons = '<div class="action-buttons">';
            @can('categories.edit')
                actionButtons += '<a class="green edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            @endcan
            @can('categories.destroy')
                actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            @endcan
            actionButtons += '</div>';
            var data = table_charge.row($tr).data();
            $tds = $tr.find('td');         
            $name = $tds.eq(0).find('input.name').val();
            $value = $tds.eq(1).find('input.value').val();
            $is_percent = $tds.eq(2).find('input.is_percent').is(':checked') ? 1 : 0;
            $is_visible = $tds.eq(3).find('input.is_visible').is(':checked') ? 1 : 0;
            $.ajax({
                url: "{{url('/charges')}}/"+data['id'],
                type: "PUT",
                data: {_token : "{{csrf_token()}}", id: data['id'], name: $name,value: $value, is_percent : $is_percent, is_visible: $is_visible},
                success: function(result){
                    data['name']=$name;
                    data['value']=$value;
                    data['is_percent']=$is_percent;
                    data['is_visible']=$is_visible;
                    $tds.eq(0).html($name);
                    $tds.eq(1).html($value);
                    $percent_html = $is_percent==1 ? '<i class="ace-icon fa fa-check bigger-130"  style="color:green;"></i>' : '<i class="ace-icon fa fa-times bigger-130" style="color:red;"></i>';
                    $tds.eq(2).html($percent_html);
                    $visible_html = $is_visible==1 ? '<i class="ace-icon fa fa-check bigger-130"  style="color:green;"></i>' : '<i class="ace-icon fa fa-times bigger-130" style="color:red;"></i>'
                    $tds.eq(3).html($visible_html);
                    $actionButtonTD.html(actionButtons);
                },
                error: function(xhr,status){
                    if(xhr.status==422){
                        var responseJSON = xhr.responseJSON;
                        var jsonData = responseJSON.errors;
                        Object.keys(jsonData).forEach(function(key) {
                            var value = jsonData[key][0];
                            $span = $tr.find('.'+key);
                            $span.attr('style','color:red');
                            $span.html(value);
                        });
                    }
                }
            })
            
            
        });

        table_charge.on('click','.cancel',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            var data = table_charge.row($tr).data();
            $tds = $tr.find('td');
            $tds.eq(0).html(data['name']);
            var actionButtons = '<div class="action-buttons">';
            @can('categories.edit')
                actionButtons += '<a class="green edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            @endcan
            @can('categories.destroy')
                actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            @endcan
            actionButtons += '</div>';
            $actionButtonTD.html(actionButtons);
        })

    @endcan
    
    @can('charges.destory')
        table_charge.on('click','.delete',function(e){
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
            }
            var data = table_charge.row($tr).data();
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this charge!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {    
                if (result.isConfirmed) {
                    var form_data = { _token : "{{csrf_token()}}", _method: "_delete" , id: data['id']};

                    $.ajax({
                        url: "{{url('/charges')}}/"+data['id'],
                        type: "DELETE",
                        data: form_data,
                        success: function(result){
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then((result)=>{
                                table_charge.row($tr).remove().draw();
                            })
                        }
                    });
                    
                }
            })
            
            e.preventDefault();
        });
    @endcan
    // END OF CHARGES

    // START OF BRANCH
    var table_branch = $('#table-branch').DataTable({
        ajax: "{{url('branches-json')}}",
        rowId: "id",
        processing: true,
        columnDefs: [
            {width: "20%", targets: [1]}
        ],
        columns: [
            {data : 'name'},
            {data: null, render(data,type){
                var actionButtons = '<div class="action-buttons">';
                @can('branches.edit')
                    actionButtons += '<a class="green edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
                @endcan
                @can('branches.destroy')
                    actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
                @endcan
                actionButtons += '</div>';
                return actionButtons;
            }}
        ]
    });

    @can('branches.create')
        
        $("#form-branch").validate(
            {                   
                rules:
                {   
                    name:
                    {
                        required: true
                    }
                    
                },
                messages:
                {   
                    name:
                    {
                        required: 'Please enter name'
                    }
                },                  
                
                errorPlacement: function(error, element)
                {
                    error.insertAfter(element.parent());
                },
                submitHandler: function(form) {
                var form_data = new FormData(form);
                form_data.append('_token',"{{csrf_token()}}");
                $.ajax({
                    url: "{{route('branches.store')}}",
                    type: "POST",
                    data: form_data,
                    dataType: 'JSON',
                    processData: false,
                    contentType:false,
                    cache:false,
                    success: function(result){
                        
                        Swal.fire(
                            'Success!',
                            'Record has been saved.',
                            'success'
                        ).then((result)=>{
                            $('#form-category').trigger('reset');   
                            table_branch.ajax.url("{{url('branches-json')}}").load();
                        })
                    },
                    error: function(xhr,status){
                        
                    }
                });
                return false;
                }
        });


    @endcan

    @can('branches.edit')
        table_branch.on('click','.edit',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            var data = table_branch.row($tr).data();
            $tds = $tr.find('td');
            $tds.eq(0).html('<div class="form-group"><input type="text" class="form-control name" value="'+data['name']+'" style="width:100%;" required><span class="name" style="display:none"></div></div>');
            $actionButtonTD.html('<div class="action-buttons"><a class="green submit" href="#"><i class="ace-icon fa fa-check bigger-130"></i></a><a class="red cancel" href="#"><i class="ace-icon fa fa-times bigger-130"></i></a></div>');
        })

        table_branch.on('click','.submit',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            
            var actionButtons = '<div class="action-buttons">';
            @can('branches.edit')
                actionButtons += '<a class="green edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            @endcan
            @can('branches.destroy')
                actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            @endcan
            actionButtons += '</div>';
            var data = table_branch.row($tr).data();
            
            $tds = $tr.find('td');         
            $name = $tds.eq(0).find('input.name').val();
            
            
            $.ajax({
                url: "{{url('/branches')}}/"+data['id'],
                type: "PUT",
                data: {_token : "{{csrf_token()}}", id: data['id'], name: $name},
                success: function(result){
                    data['name']=$name;
                    $tds.eq(0).html($name);
                    $actionButtonTD.html(actionButtons);
                },
                error: function(xhr,status){
                    if(xhr.status==422){
                        var responseJSON = xhr.responseJSON;
                        var jsonData = responseJSON.errors;
                        Object.keys(jsonData).forEach(function(key) {
                            var value = jsonData[key][0];
                            $span = $tr.find('.'+key);
                            $span.attr('style','color:red');
                            $span.html(value);
                        });
                    }
                }
            })
            
            
        });

        table_branch.on('click','.cancel',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            var data = table_branch.row($tr).data();
            $tds = $tr.find('td');
            $tds.eq(0).html(data['name']);
            var actionButtons = '<div class="action-buttons">';
            @can('categories.edit')
                actionButtons += '<a class="green edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            @endcan
            @can('categories.destroy')
                actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            @endcan
            actionButtons += '</div>';
            $actionButtonTD.html(actionButtons);
        })

    @endcan
    
    @can('categories.destory')
        table_branch.on('click','.delete',function(e){
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
            }
            var data = table_branch.row($tr).data();
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this category!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {    
                if (result.isConfirmed) {
                    var form_data = { _token : "{{csrf_token()}}", _method: "_delete" , id: data['id']};

                    $.ajax({
                        url: "{{url('/categories')}}/"+data['id'],
                        type: "DELETE",
                        data: form_data,
                        success: function(result){
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then((result)=>{
                                table_branch.row($tr).remove().draw();
                            })
                        }
                    });
                    
                }
            })
            
            e.preventDefault();
        });
    @endcan
    // END OF BRANCH

    // START OF EMPLOYEE

    populate_dropdown("{{url('job-titles-json')}}",'#form-employee select[name="job_title_id"]','id','name');
    populate_dropdown("{{url('branches-json')}}",'#form-employee select[name="branch_id"]','id','name');
    
    
    var table_employee = $('#table-employee').DataTable({
        ajax: "{{url('employees-json')}}",
        rowId: "id",
        processing: true,
        
        columns: [
            {data : null, render(data,type){
                var returnHTML = '';
                returnHTML = data['lname']+', '+data['fname']+' '+data['mname'];
                if(data['user']!=null) {
                    returnHTML+= '<br>Email : <b>'+data['user']['email']+'</b>';
                    @can('users.destroy')
                        returnHTML += ' <a class="red remove-user" href="#" title="Remove"><i class="ace-icon fa fa-times bigger-130"></i></a>';
                    @endcan
                    returnHTML += '<br>Role: <select class="form-control select-role" style="width:80%" name="role"></select>'
                }
                
                return returnHTML;
            }},
            {data: null,render(data,type){
                var returnHTML = '';
                returnHTML=data['job_title']['name']
                if(data['area']!=null) returnHTML+= '<br>Area : <b>'+data['area']['name']+'</b>';
                if(data['job_title']['name']=='CREDIT OFFICER' && data['area_id']==null) returnHTML+='<br><a class="blue add-area" href="#" title="Add Area"><i class="ace-icon fa fa-plus bigger-130"></i> Add Area</a>'
                return returnHTML;
            }},
            {data: 'branch',render(data,type){
                return data['name'];
            }},
            {data: null, render(data,type){
                var actionButtons = '<div class="action-buttons">';
                @can('employees.add_user')
                    if(data['user_id']==null){
                        actionButtons += '<a class="blue add-user" href="#" title="Add User"><i class="ace-icon fa fa-user-plus bigger-130"></i></a>';
                    }
                @endcan
                @can('employees.edit')
                    actionButtons += '<a class="green edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
                @endcan
                @can('employees.destroy')
                    actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
                @endcan
                actionButtons += '</div>';
                return actionButtons;
            }}
        ],
        initComplete: function(){
            
            $.ajax({
                url: "{{url('roles-json')}}",
                type: "GET",
                dataType: "JSON",
                success: function(result){
                    $roles = result.data;
                    $rolesHTML = '';
                    $.each($roles,function(){
                        $rolesHTML += '<option value="'+this.id+'">'+this.name+'</option>';
                    })
                    
                    $('#table-employee > tbody > tr').each(function(){
                        $tr = $(this);
                        
                        $td = $tr.find('td');
                        $td.eq(0).find('select').html($rolesHTML);
                        $td.eq(0).find('select').prepend("<option value='none' disabled selected='selected'>Please select role</option>")
                        var data = table_employee.row($tr).data();
                        if(data['user']!=null){
                            if(data['user']['model_has_role']!=null){
                                $td.eq(0).find('select').val(data['user']['model_has_role']['role_id']);
                            }
                        }
                    })
                }
            })
            
        }
    });

    @canany('employees.create|employees.edit')
        
        $("#form-employee").validate(
            {                   
                rules:
                {   
                    lname:
                    {
                        required: true
                    },
                    fname:
                    {
                        required: true
                    },
                    gender:
                    {
                        required: true
                    },
                    job_title_id:
                    {
                        required: true
                    },
                    branch_id:
                    {
                        required: true
                    },
                    
                },
                                  
                
                errorPlacement: function(error, element)
                {
                    error.insertAfter(element.parent());
                },
                submitHandler: function(form) {
                var form_data = new FormData(form);
                form_data.append('_token',"{{csrf_token()}}");
                $.ajax({
                    url: "{{route('employees.store')}}",
                    type: "POST",
                    data: form_data,
                    dataType: 'JSON',
                    processData: false,
                    contentType:false,
                    cache:false,
                    success: function(result){
                        
                        Swal.fire(
                            'Success!',
                            'Record has been saved.',
                            'success'
                        ).then((result)=>{
                            $('#form-employee').trigger('reset');   
                            table_employee.ajax.url("{{url('employees-json')}}").load();
                        })
                    },
                    error: function(xhr,status){
                        
                    }
                });
                return false;
                }
        });


    @endcanany

    table_employee.on('change','.select-role',function(e){
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
        $tr = $tr.prev('.parent');
        }
        var data = table_employee.row($tr).data();
        
        $.ajax({
            url: "{{url('/users/assign-role')}}",
            type: "POST",
            dataType: "JSON",
            data: {_token: "{{csrf_token()}}", role_id: $(this).val(), user_id: data['user_id']},
            success: function(result){

            },
            error: function(xhr,status){

            }
        })
        
        e.preventDefault();
    });

    @can('users.destory')
        table_employee.on('click','.remove-user',function(e){
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
            }
            var data = table_employee.row($tr).data();
            
            Swal.fire({
                title: 'Are you sure?',
                text: "Remove this user!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
                }).then((result) => {    
                if (result.isConfirmed) {
                    var form_data = { _token : "{{csrf_token()}}", _method: "_delete" , id: data['user_id']};

                    $.ajax({
                        url: "{{url('/users')}}/"+data['user_id'],
                        type: "DELETE",
                        data: form_data,
                        success: function(result){
                            Swal.fire(
                                'Removed!',
                                'User has been removed.',
                                'success'
                            ).then((result)=>{
                                table_employee.ajax.url("{{url('employees-json')}}").load();
                            })
                        }
                    });
                    
                }
            })
            
            e.preventDefault();
        });
    @endcan

    @can('employees.edit')
        table_employee.on('click','.edit',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            var data = table_employee.row($tr).data();
            $form = $('#form-employee');
            $form.find('input[name="id"]').val(data['id']);
            $form.find('input[name="lname"]').val(data['lname']);
            $form.find('input[name="fname"]').val(data['fname']);
            $form.find('input[name="mname"]').val(data['mname']);
            $form.find('select[name="gender"]').val(data['gender']);
            $form.find('select[name="job_title_id"]').val(data['job_title_id']);
            $form.find('select[name="branch_id"]').val(data['branch_id']);
        })

        
        
    @endcan
    @can('employees.add_area')
        table_employee.on('click','.add-area',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            var data = table_employee.row($tr).data();
            $.ajax({
                url: "{{url('areas/get-name')}}/"+data['branch_id'],
                type: "GET",
                dataType :"JSON",
                success: function(result){
                    $name = result['name'];
                    Swal.fire({
                        title: 'Adding area?',
                        text: "AREA "+$name+" will be added to this employee",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Proceed!'
                        }).then((result) => {    
                        if (result.isConfirmed) {
                            var form_data = { _token : "{{csrf_token()}}" , id: data['id'], branch_id: data['branch_id'], name: $name};

                            $.ajax({
                                url: "{{url('/employees/assign')}}",
                                type: "POST",
                                data: form_data,
                                success: function(result){
                                    Swal.fire(
                                        'Success!',
                                        'Employee is already assigned',
                                        'success'
                                    ).then((result)=>{
                                        table_employee.ajax.url("{{url('employees-json')}}").load();
                                    })
                                }
                            });
                            
                        }
                    })
                }
            })
            
            
            e.preventDefault();
        })
    @endcan
    @can('employees.add_user')
        table_employee.on('click','.add-user',function(e){
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            var data = table_employee.row($tr).data();
            $modal=$('#modal-add-user');
            $form = $('#form-add-user');
            $form.find('input[name="id"]').val(data['id']);
            $form.find('input[name="name"]').val(data['lname']+', '+data['fname']+' '+data['mname']);
            $modal.modal('show');
        })

        $("#form-add-user").validate(
            {                   
                rules:
                {   
                    username:
                    {
                        required: true
                    }
                    
                },
                                  
                
                errorPlacement: function(error, element)
                {
                    error.insertAfter(element.parent());
                },
                submitHandler: function(form) {
                var form_data = new FormData(form);
                form_data.append('_token',"{{csrf_token()}}");
                $.ajax({
                    url: "{{route('employees.addUser')}}",
                    type: "POST",
                    data: form_data,
                    dataType: 'JSON',
                    processData: false,
                    contentType:false,
                    cache:false,
                    success: function(result){
                        
                        Swal.fire(
                            'Success!',
                            'Record has been saved.',
                            'success'
                        ).then((result)=>{
                            $('#form-employee').trigger('reset');   
                            table_employee.ajax.url("{{url('employees-json')}}").load();
                            $('#modal-add-user').modal('hide');
                        })
                    },
                    error: function(xhr,status){
                        
                    }
                });
                return false;
                }
        });
        
    @endcan
    
    @can('employees.destory')
        table_employee.on('click','.delete',function(e){
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
            }
            var data = table_employee.row($tr).data();
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this employee!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {    
                if (result.isConfirmed) {
                    var form_data = { _token : "{{csrf_token()}}", _method: "_delete" , id: data['id']};

                    $.ajax({
                        url: "{{url('/employees')}}/"+data['id'],
                        type: "DELETE",
                        data: form_data,
                        success: function(result){
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then((result)=>{
                                table_charge.row($tr).remove().draw();
                            })
                        }
                    });
                    
                }
            })
            
            e.preventDefault();
        });
    @endcan
    // END OF EMPLOYEE
    
    // START OF ROLES AND PERMISSIONS
    
    function permissions(d){
        var returnHTML = '';
        
        returnHTML+='<table width="100%">';
        returnHTML+='<tr>';
        returnHTML+='<td width="70%" valign="top">'+
        '<table width="100%" class="table table-bordered table-permission">'+
            '<thead>'+
            '<tr>'+
                '<th>Permission name</th>'+
            '</tr>'+
            '</thead>'+
            '<tbody>';
        
        $.each(d.permissions,function(){
            returnHTML+='<tr><td>'+this.display_name+'</td></tr>';
        })    
        if(d.name=='PRESIDENT' || d.name=='SYSTEM ADMINISTRATOR'){
            returnHTML+='<tr><td>--ALL PERMISSIONS--</td></tr>';
        }
        
        returnHTML+='</tbody></table>';
        
        
        returnHTML+='</tr>';
        returnHTML+='</table>';
        
        return returnHTML;
    }

    var table_role = $('#table-role').DataTable({
        ajax: "{{url('roles-vendor-json')}}",
        rowId: "id",
        processing: true,
        columnDefs: [
            {width: "5%", targets: [0]}
        ],
        columns: [
            {data: null, render(data,type){
                return '<a class="green show" href="#"><i class="ace-icon fa fa-plus bigger-130"></i></a>';
            }},
            {data : null, render(data,type){
                return data['name'];
            }},
        ]
    });

    $('#table-role tbody').on('click', '.show', function (e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        var row = table_role.row( tr );
 
        if ( row.child.isShown() ) {
            
            tr.find('td').eq(0).html('<a class="green show" href="#"><i class="ace-icon fa fa-plus bigger-130"></i></a>')
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            tr.find('td').eq(0).html('<a class="red show" href="#"><i class="ace-icon fa fa-minus bigger-130"></i></a>');
            row.child( permissions(row.data()) ).show();
            tr.addClass('shown');
            
            
        }
    } );

    function child_module(d){
        var returnHTML = '';
        returnHTML+='<form class="form-role">';
        returnHTML+='<table width="100%">';
        returnHTML+='<tr>';
        returnHTML+='<td width="70%" valign="top">'+
        '<table width="100%" class="table table-bordered table-permission">'+
            '<thead>'+
            '<tr>'+
                '<th></th>'+
                '<th>Permission name</th>'+
            '</tr>'+
            '</thead>'+
            '<tbody>';
        $.each(d.permission,function(){
            returnHTML+='<tr><td><input type="checkbox" class="select-permission" name="permission" value="'+this.name+'"></td><td>'+this.display_name+'</td></tr>';
        })    
        returnHTML+='</tbody>'+
        '</table>'+
        '</td>';
        returnHTML+='<td width="30%" valign="top">'+
        
            '<div>'+
                '<select name="role" style="width:100%" class="form-control" required>'+
                
                '</select>'+
            '</div>'+
        '</form>'+
        '</td>';
        returnHTML+='</tr>';
        returnHTML+='</table>';
        returnHTML+='<div class="form-group"><button type="submit" class="btn btn-success">Add to selected role(s)</button></div>';
        returnHTML+='</form>';
        return returnHTML;
    }

    var table_module = $('#table-module').DataTable({
        ajax: "{{url('modules-json')}}",
        rowId: "id",
        processing: true,
        columnDefs: [
            {width: "5%", targets: [0]}
        ],
        columns: [
            {data: null, render(data,type){
                return '<a class="green show" href="#"><i class="ace-icon fa fa-plus bigger-130"></i></a>';
            }},
            {data : null, render(data,type){
                return data['name'];
            }},
        ]
    });

    $('#table-module tbody').on('click', '.show', function (e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        var row = table_module.row( tr );
 
        if ( row.child.isShown() ) {
            
            tr.find('td').eq(0).html('<a class="green show" href="#"><i class="ace-icon fa fa-plus bigger-130"></i></a>')
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            tr.find('td').eq(0).html('<a class="red show" href="#"><i class="ace-icon fa fa-minus bigger-130"></i></a>');
            row.child( child_module(row.data()) ).show();
            tr.addClass('shown');
            populate_dropdown("{{url('roles-json')}}",'form.form-role select[name="role"]','id','name');
            tr.next('tr').find('form.form-role select[name="role"]').prepend("<option value='none' disabled selected='selected'>Please select role(s)</option>");
            tr.next('tr').find('form.form-role select[name="role"]').attr('multiple',true);
            tr.next('tr').find('form.form-role select[name="role"]').attr('size',15);
        }
    } );
    
    // adding in first position of select
    $('#form-role select[name="role"]').prepend("<option value='none' disabled selected='selected'>Please select role</option>");
    $('#form-role select[name="role"]').attr('multiple',true);
    $('#form-role select[name="role"]').change(function(e){
        
    })

    table_module.on('submit','form.form-role',function(e){
        e.preventDefault();
        $selected = [];
        $this=$(this);
        $input=$this.find('input:checked');
        for(var i=0;i<$input.length;i++){
            $selected.push($input[i].value);
        }
        $.ajax({
            url: "{{url('/roles-async-permission')}}",
            type: "POST",
            data: {_token: "{{csrf_token()}}",roles: $this.find('select').val(), permissions: $selected},
            success: function(result){
                table_role.ajax.url("{{url('roles-vendor-json')}}").load();
                $this.trigger('reset');
            },
            error:function(xhr){
                if(xhr.status==422){
                    Swal.fire(
                        'Ooops!',
                        'Invalid inputs',
                        'error'
                    );
                }
            }
        })
        
        
    })

    

    // END OF ROLES AND PERMISSIONS

});
</script>
@endsection