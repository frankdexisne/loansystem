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
        <a href="{{url('/home')}}">Home</a>
    </li>
    <li>
        <a>System Administration</a>
    </li>
    <li class="active">Users</li>
</ul>

@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <!-- <h3 class="header smaller lighter blue">List of Areas</h3> -->

        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            List Registered Employees
        </div>

        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->
        <div>
            <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
            </table>
        </div>
    </div>
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
<script src="{{asset('/ace-master')}}/js/dataTables.rowGroup.min.js"></script>
<script src="{{asset('/js/sweetalert2.js')}}"></script>
<script src="{{asset('/js/references.js')}}"></script>
<script>
    $(document).ready(function(){
        
        $temp = null;
        $colIndex = 2;
        $disable_form_search = 1;

        $element = '#datatable';
        ajaxUrl = "{{url('users-json')}}";
        ajaxType = "GET";
        ajaxData = {};
        _columns = [
            {data : 'name', title : 'Name'},
            {data : 'email', title : 'Email'},
            {data : null, title : 'Action', render(data,type){
                return '<div class="hidden-sm hidden-xs action-buttons">'+
							'<a class="green edit" href="#">'+
								'<i class="ace-icon fa fa-pencil bigger-130"></i>'+
							'</a>'+
							'<a class="red delete" href="#">'+
								'<i class="ace-icon fa fa-trash-o bigger-130"></i>'+
							'</a>'+
                            '<a class="orange reset-password" href="#">'+
								'<i class="ace-icon fa fa-undo bigger-130"></i>'+
							'</a>'+
						'</div>';
            }},
        ];

        

        function generateTable($element,ajaxUrl,ajaxType,ajaxData,_columns){

            if($.fn.DataTable.isDataTable( $element )){
                $($element).DataTable().destroy();
            }

            var dataTable = $($element).DataTable({
                ajax: {
                    url : ajaxUrl,
                    type : ajaxType,
                    data: ajaxData
                },
                columns: _columns,
                select: {
                    style: 'multi'
                }
            })

            dataTable.on('click','a.reset-password',function(e){
                e.preventDefault();
                $tr=$(this).closest('tr');
                var data = dataTable.row($tr).data();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Resetting user password",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, reset it!'
                    }).then((result) => {    
                    if (result.isConfirmed) {
                        var form_data = { _token : "{{csrf_token()}}" , id: data['id']};

                        $.ajax({
                            url: "{{url('/users/reset-password')}}/"+data['id'],
                            type: "POST",
                            data: form_data,
                            success: function(result){
                                Swal.fire(
                                    'Reset!',
                                    'Password is already reset',
                                    'success'
                                )
                            },
                            error: function(xhr){
                                if(xhr.status==422){
                                    Swal.fire(
                                        'Ooops!',
                                        xhr.responseJSON.message,
                                        'error'
                                    )   
                                }
                            }
                        });
                        
                    }
                })
            })

            dataTable.on('click','a.edit',function(e){
                $tr=$(this).closest('tr');
                $temp = dataTable.row($tr).data();
                $td = $tr.find('td');
                // CHANGE COLUMN TO INPUT
                $td.eq(0).html('<input type="text" class="form-input" style="width:100%" value="'+$temp['name']+'">');
                $td.eq(1).html('<input type="email" class="form-input" style="width:100%" value="'+$temp['email']+'">');

                
                $td.eq($colIndex).find('a.edit').removeClass('edit').addClass('save');
                $td.eq($colIndex).find('a').eq(0).find('i').removeClass('fa-pencil').addClass('fa-check');

                $td.eq($colIndex).find('a.delete').removeClass('delete').addClass('cancel');
                $td.eq($colIndex).find('a').eq(1).find('i').removeClass('fa-trash-o').addClass('fa-times');
                
                $tr.removeClass('selected');
            });

            dataTable.on('click','a.save',function(e){
                $tr=$(this).closest('tr');
                $temp = dataTable.row($tr).data();
                $td = $tr.find('td');
                
                var form_data = {
                    id : $temp['id'],
                    _token : $('meta[name="csrf-token"]').attr('content'),
                    name : $td.eq(0).find('.form-input').val(),
                    email : $td.eq(1).find('.form-input').val()
                };
                
                $.ajax({
                    url: "{{url('users')}}/"+$temp['id'],
                    type: "PUT",
                    data: form_data,
                    success: function(result){
                        // ASSIGN NEW VALUES
                        $temp['name']=$td.eq(0).find('.form-input').val();
                        $temp['email']=$td.eq(1).find('.form-input').val();
                        $td.eq($colIndex).find('a.edit').removeClass('edit').addClass('save');
                        $td.eq($colIndex).find('a').eq(0).find('i').removeClass('fa-pencil').addClass('fa-check');
                        $td.eq($colIndex).find('a.delete').removeClass('delete').addClass('cancel');
                        $td.eq($colIndex).find('a').eq(1).find('i').removeClass('fa-trash-o').addClass('fa-times');
                        
                        Swal.fire(
                            'Success!',
                            'Record has been saved!',
                            'success'
                        ).then((result)=>{
                            dataTable.row($tr).data($temp).invalidate();
                        });
                    },
                    error: function(xhr){
                        if(xhr.status==422){
                            var responseJSON = xhr.responseJSON;
                            var jsonData = responseJSON.errors;
                            console.log(jsonData);
                            Object.keys(jsonData).forEach(function(key) {
                                var value = jsonData[key][0];
                                $span = $tr.find('.error-'+key);
                                $span.removeClass('hidden');
                                $span.html(value);
                            });
                        }
                    }
                })

                $tr.removeClass('selected');
            });

            dataTable.on('click','a.cancel',function(e){
                $tr=$(this).closest('tr');
                $td.eq($colIndex).find('a.save').removeClass('save').addClass('edit');
                $td.eq($colIndex).find('a').eq(0).find('i').removeClass('fa-check').addClass('fa-pencil');

                $td.eq($colIndex).find('a.cancel').removeClass('cancel').addClass('delete');
                $td.eq($colIndex).find('a').eq(1).find('i').removeClass('fa-times').addClass('fa-trash-o');
        
                dataTable.row($tr).data($temp).invalidate();
                $tr.removeClass('selected');
            });

            dataTable.on('click','a.delete',function(e){
                e.preventDefault();
                $tr=$(this).closest('tr');
                var data = dataTable.row($tr).data();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete this data",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {    
                    if (result.isConfirmed) {
                        var form_data = { _token : "{{csrf_token()}}", _method: "_delete" , id: data['id']};

                        $.ajax({
                            url: "{{url('/users')}}/"+data['id'],
                            type: "DELETE",
                            data: form_data,
                            success: function(result){
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                ).then((result)=>{
                                    dataTable.row($tr).remove().draw(false);
                                    $tr.removeClass('selected');
                                })
                            },
                            error: function(xhr){
                                if(xhr.status==422){
                                    Swal.fire(
                                        'Ooops!',
                                        xhr.responseJSON.message,
                                        'error'
                                    )   
                                }
                            }
                        });
                        
                    }
                })
                
                
            });
        }

        generateTable($element,ajaxUrl,ajaxType,ajaxData,_columns);

        $('form.form-search').find('select').on('change',function(e){
            ajaxData = {
                for_daily_areas : $('form.form-search').find('select').val()
            };
            generateTable($element,ajaxUrl,ajaxType,ajaxData,_columns);
        });

        if($disable_form_search==1){
            $('#nav-search').remove();
        }


    });
</script>
@endsection