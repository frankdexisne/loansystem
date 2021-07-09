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
    <li class="active">Employees</li>
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

<div id="modal-credential" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">User credential</h4>
            </div>

            <div class="modal-body">
                <form id="form-user">
                    <input type="hidden" name="id">
                    <input type="hidden" name="name">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Cancel
                </button>

                <button class="btn btn-sm btn-primary submit-form">
                    <i class="ace-icon fa fa-check"></i>
                    Save
                </button>
            </div>
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->

<div id="modal-form" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Create New</h4>
            </div>

            <div class="modal-body">
                <form id="form">
                    <div class="form-group">
                        <label for="">Lastname</label>
                        <input type="text" class="form-control" name="lname" required>
                    </div>
                    <div class="form-group">
                        <label for="">Firstname</label>
                        <input type="text" class="form-control" name="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="">Middlename</label>
                        <input type="text" class="form-control" name="mname" required>
                    </div>
                    <div class="form-group">
                        <label for="">Gender</label>
                        <select name="gender" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Job Title</label>
                        <select name="job_title_id" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Branch</label>
                        <select name="branch_id" class="form-control">
                        </select>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Cancel
                </button>

                <button class="btn btn-sm btn-primary submit-form">
                    <i class="ace-icon fa fa-check"></i>
                    Save
                </button>
            </div>
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->


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
        ajaxUrl = "{{url('employees-json')}}";
        ajaxType = "GET";
        ajaxData = {};
        _columns = [
            {data : null, title : 'Name',render(data){
                return data['lname']+','+data['fname']+data['mname'];
            }},
            {data : 'job_title.name', title : 'Job Title'},
            {data : null, title : 'Action', render(data,type){
                return '<div class="hidden-sm hidden-xs action-buttons">'+
							'<a class="green edit" href="#">'+
								'<i class="ace-icon fa fa-pencil bigger-130"></i>'+
							'</a>'+
							'<a class="red delete" href="#">'+
								'<i class="ace-icon fa fa-trash-o bigger-130"></i>'+
							'</a>'+
                            (data['user_id']==null ? '<a class="blue add-user" href="#" title="Add User"><i class="ace-icon fa fa-user-plus bigger-130"></i></a>' : '')+
						'</div>';
            }},
        ];

        function format(d){
            
            var generatedForm = '<form class="form-edit" style="width:100%">';
            
            generatedForm += '<table style="width:100%" cellspacing="5">';
            generatedForm += '<tr>'+
                '<td><label>Lastname</label></td>'+
                '<td><input type="text" class="form-control" name="lname" value="'+d.lname+'" style="width:100%" required></td>'+
                '</tr>';
            generatedForm += '<tr>'+
            '<td><label>Firstname</label></td>'+
            '<td><input type="text" class="form-control" name="fname" value="'+d.fname+'" style="width:100%"  required></td>'+
            '</tr>';

            generatedForm += '<tr>'+
                '<td><label>Middlename</label></td>'+
                '<td><input type="text" class="form-control" name="mname" value="'+d.mname+'" style="width:100%"  required></td>'+
                '</tr>';

            generatedForm += '<tr>'+
                '<td><label>Gender</label></td>'+
                '<td>'+
                '<select class="form-control" name="gender" style="width:100%">'+
                    '<option value="Male" '+(d.gender=='Male' ? 'selected' : '')+'>Male</option>'+
                    '<option value="Female" '+(d.gender=='Female' ? 'selected' : '')+'>Female</option>'+
                '</select>'
                +'</td>'+
                '</tr>';

            generatedForm += '<tr>'+
                '<td><label>Job Title</label></td>'+
                '<td>'+
                '<select class="form-control" name="job_title_id" style="width:100%">'+
                '</select>'
                +'</td>'+
                '</tr>';

            generatedForm += '<tr>'+
                '<td><label>Branch Assignement</label></td>'+
                '<td>'+
                '<select class="form-control" name="branch_id" style="width:100%">'+
                '</select>'
                +'</td>'+
                '</tr>';
            generatedForm += '</table>';
            generatedForm += '</form>';
            return generatedForm;
        }

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

            // $('#table-barcode-waybill-summary tbody').on('click','tr td a.waybill-no',function(){
            //     $tr = $(this).closest('tr');
            //     $row = barcodeWaybillTableSummary.row($tr);
                
            //     if($row.child.isShown()){
            //         $row.child.hide();
            //         $tr.removeClass('shown');
            //     }else{
            //         $row.child( format($row.data()),'child-row' ).show();
            //         $tr.addClass('shown');
                    
            //     }
            // });
            $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
            new $.fn.dataTable.Buttons( dataTable, {
                buttons: [
                    {
                    "text": "<i class='fa fa-plus bigger-110 blue'></i> <span class=''>Add New</span>",
                    "className": "btn btn-white btn-primary btn-bold btn-add",
                    }		  
                ]
            } );

            dataTable.buttons().container().appendTo( $('.tableTools-container') );

            $('.btn-add').click(function(){
                populate_dropdown("{{url('job-titles-json')}}",'#modal-form form#form select[name="job_title_id"]','id','name');
                populate_dropdown("{{url('branches-json')}}",'#modal-form form#form select[name="branch_id"]','id','name');
                $('#modal-form').modal('show');
            });

            $('form#form').submit(function(e){
                e.preventDefault();
                $form = $(this);
                var form_data = {
                    _token : $('meta[name="csrf-token"]').attr('content'),
                    lname : $form.find('input[name="lname"]').val(),
                    fname : $form.find('input[name="fname"]').val(),
                    mname : $form.find('input[name="mname"]').val(),
                    gender : $form.find('select[name="gender"]').val(),
                    job_title_id : $form.find('select[name="job_title_id"]').val(),
                    branch_id : $form.find('select[name="branch_id"]').val()
                };
                $.ajax({
                    url: "{{route('employees.store')}}",
                    type: "POST",
                    data: form_data,
                    success: function(res){
                        Swal.fire(
                            'Success!',
                            'Record has been saved!',
                            'success'
                        ).then((result)=>{
                            dataTable.row.add(res.data).draw(false);
                            $('#modal-form').find('.close').click();
                            $('#modal-form').find('button.submit-form').removeAttr('disabled');
                            $form.trigger('reset');                
                        });
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.message);
                    }
                })
            })

            $('#modal-form').find('button.submit-form').click(function(e){
                e.preventDefault();
                $(this).attr('disabled',true);
                $('form#form').submit();
            });

            dataTable.on('click','a.add-user',function(e){
                $tr = $(this).closest('tr');
                var data = dataTable.row($tr).data();
                $('#modal-credential').find('input[name="id"]').val(data['id']);
                $('#modal-credential').find('input[name="name"]').val(data['lname']+', '+data['fname']+' '+data['mname']);
                $('#modal-credential').modal('show');
            });

            $('form#form-user').submit(function(e){
                e.preventDefault();
                $form = $(this);
                var form_data = {
                    _token : $('meta[name="csrf-token"]').attr('content'),
                    username : $form.find('input[name="email"]').val(),
                    password : $form.find('input[name="password"]').val(),
                    name : $form.find('input[name="name"]').val(),
                    id: $form.find('input[name="id"]').val()
                };
                $.ajax({
                    url: "{{url('/employees/add-user')}}",
                    type: "POST",
                    data: form_data,
                    success: function(res){
                        Swal.fire(
                            'Success!',
                            'Record has been saved!',
                            'success'
                        ).then((result)=>{
                            // dataTable.row.add(res.data).draw(false);
                            $('#modal-credential').find('.close').click();
                            $('#modal-credential').find('button.submit-form').removeAttr('disabled');
                            dataTable.ajax.reload();
                            $form.trigger('reset');                
                        });
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.message);
                    }
                })
            })

            $('#modal-credential').find('button.submit-form').click(function(e){
                e.preventDefault();
                $(this).attr('disabled',true);
                $('form#form-user').submit();
                
            });

            dataTable.on('click','a.edit',function(e){
                $tr = $(this).closest('tr');
                $row = dataTable.row($tr);
                var data = $row.data();
                $td = $tr.find('td');

                if(!$row.child.isShown()){
                    populate_dropdown("{{url('job-titles-json')}}",'.form-edit select[name="job_title_id"]','id','name');
                    populate_dropdown("{{url('branches-json')}}",'.form-edit select[name="branch_id"]','id','name');
                    $td.eq($colIndex).find('a.edit').removeClass('edit').addClass('save');
                    $td.eq($colIndex).find('a').eq(0).find('i').removeClass('fa-pencil').addClass('fa-check');

                    $td.eq($colIndex).find('a.delete').removeClass('delete').addClass('cancel');
                    $td.eq($colIndex).find('a').eq(1).find('i').removeClass('fa-trash-o').addClass('fa-times');

                    $td.eq($colIndex).find('a.add-user').addClass('hidden');
                    $row.child( format($row.data()),'child-row' ).show();
                    $tr.addClass('shown');
                    setTimeout(function(){
                        $tr.next('tr.child-row').find('select[name="job_title_id"]').val(data['job_title_id']);
                        $tr.next('tr.child-row').find('select[name="branch_id"]').val(data['branch_id']);
                    },1500);
                    
                    // console.log(data);
                }
                
                $tr.removeClass('selected');
            });

            dataTable.on('click','a.save',function(e){
                $tr=$(this).closest('tr');
                $row = dataTable.row($tr);
                $temp = $row.data();
                // $td = $tr.find('td');
                // ASSIGN NEW VALUES
                // $temp['name']=$td.eq(0).find('.form-input').val();
                $child_tr = $tr.next('tr.child-row');
                
                var form_data = {
                    id : $temp['id'],
                    _token : $('meta[name="csrf-token"]').attr('content'),
                    lname : $child_tr.find('input[name="lname"]').val(),
                    fname : $child_tr.find('input[name="fname"]').val(),
                    mname : $child_tr.find('input[name="mname"]').val(),
                    gender : $child_tr.find('select[name="gender"]').val(),
                    job_title_id : $child_tr.find('select[name="job_title_id"]').val(),
                    branch_id : $child_tr.find('select[name="branch_id"]').val(),
                };

                

                $.ajax({
                    url: "{{url('employees')}}/"+$temp['id'],
                    type: "PUT",
                    data: form_data,
                    success: function(result){
                        $temp['lname']= $child_tr.find('input[name="lname"]').val();
                        $temp['fname']=$child_tr.find('input[name="fname"]').val();
                        $temp['mname']=$child_tr.find('input[name="mname"]').val();
                        $temp['gender']=$child_tr.find('select[name="gender"]').val();
                        $temp['job_title_id']=$child_tr.find('select[name="job_title_id"]').val();
                        $temp['branch_id']=$child_tr.find('select[name="branch_id"]').val();
                        if($row.child.isShown()){
                            $row.child.hide();
                            $tr.removeClass('shown');
                        }
                        $td.eq($colIndex).find('a.edit').removeClass('edit').addClass('save');
                        $td.eq($colIndex).find('a').eq(0).find('i').removeClass('fa-pencil').addClass('fa-check');
                        $td.eq($colIndex).find('a.delete').removeClass('delete').addClass('cancel');
                        $td.eq($colIndex).find('a').eq(1).find('i').removeClass('fa-trash-o').addClass('fa-times');
                        $td.eq($colIndex).find('a.add-user').removeClass('hidden');
                        Swal.fire(
                            'Success!',
                            'Record has been saved!',
                            'success'
                        ).then((result)=>{
                            dataTable.row($tr).data($temp).invalidate();
                        });
                    },
                    error: function(xhr){
                        // if(xhr.status==422){
                        //     var responseJSON = xhr.responseJSON;
                        //     var jsonData = responseJSON.errors;
                        //     console.log(jsonData);
                        //     Object.keys(jsonData).forEach(function(key) {
                        //         var value = jsonData[key][0];
                        //         $span = $tr.find('.error-'+key);
                        //         $span.removeClass('hidden');
                        //         $span.html(value);
                        //     });
                        // }
                    }
                })

                $tr.removeClass('selected');
            });

            dataTable.on('click','a.cancel',function(e){

                $tr = $(this).closest('tr');
                $row = dataTable.row($tr);
                
                if($row.child.isShown()){
                    $row.child.hide();
                    $tr.removeClass('shown');
                }
                $temp= $row.data();
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
                            url: "{{url('/employees')}}/"+data['id'],
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