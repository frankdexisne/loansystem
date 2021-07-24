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
    <li class="active">Expenses</li>
</ul>
<div class="nav-search" id="nav-search">
    <form id="form-search" class="form-search">
        <span class="input-icon">
            <input type="date" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" value="{{date('Y-m-d')}}"/>
            <i class="ace-icon fa fa-search nav-search-icon"></i>
        </span>
    </form>
</div> 
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <!-- <h3 class="header smaller lighter blue">List of Areas</h3> -->

        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            List of Expenses
        </div>

        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->
        <div>
            <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
            </table>
        </div>
    </div>
</div>

<div id="modal-form" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">New Expense</h4>
            </div>

            <div class="modal-body">
                <form id="form-expense">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="">Date Applied</label>
                        <input type="date" class="form-control" name="expense_date" value="{{date('Y-m-d')}}" max="{{date('Y-m-d')}}">
                    </div>
                    <div class="form-group">
                        <label for="">For</label>
                        <select name="payment_mode_id" class="form-control">
                            <option value="1">Daily Expense</option>
                            <option value="2">Weekly Expense</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Type</label>
                        <select name="expense_type_id" class="form-control">
                            @foreach($expense_types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Employee</label>
                        <select name="employee_id" class="form-control">
                            <option value="none" selected>--NO EMPLOYEE INVOLVE--</option>
                            @foreach($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->full_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Description of expense</label>
                        <input type="text" class="form-control" name="description" required>
                    </div>

                    <div class="form-group">
                        <label for="">Official Receipt Number(s)</label>
                        <input type="text" class="form-control" name="ornos" required>
                    </div>

                    <div class="form-group">
                        <label for="">Amount</label>
                        <input type="number" class="form-control" name="amount" required>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm cancel" data-dismiss="modal">
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
        $colIndex = 1;
        $disable_form_search = 1;

        $element = '#datatable';
        ajaxUrl = "{{url('expenses-json')}}";
        ajaxType = "GET";
        ajaxData = {
            expense_date : $('#form-search').find('input[type="date"]').val()
        };
        _columns = [
            {data : 'ornos', title : 'Official Receipt No(s)'},
            {data : null, title : 'Name of Employee',render(data){
                return data['employee_id']!=null ? data['employee']['full_name'] : 'NONE';
            }},
            {data : null ,title : 'Details', render(data){
                return '';
            }},
            {data : null, title : 'Action', render(data,type){
                return '<div class="hidden-sm hidden-xs action-buttons">'+
							'<a class="green edit" href="#" title="Edit">'+
								'<i class="ace-icon fa fa-pencil bigger-130"></i>'+
							'</a>'+
							'<a class="red delete" href="#" title="Delete">'+
								'<i class="ace-icon fa fa-trash-o bigger-130"></i>'+
							'</a>'+
						'</div>';
            }},
        ];

        $('#form-search').find('input[type="date"]').on('change',function(){
            ajaxData.expense_date = $(this).val();
            generateTable($element,ajaxUrl,ajaxType,ajaxData,_columns);
        })

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

            $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
            new $.fn.dataTable.Buttons( dataTable, {
                buttons: [
                    {
                    "text": "<i class='fa fa-plus bigger-110 blue'></i> <span class=''>New Expense</span>",
                    "className": "btn btn-white btn-primary btn-bold btn-add",
                    }		  
                ]
            } );

            dataTable.buttons().container().appendTo( $('.tableTools-container') );

            $('.btn-add').click(function(e){
                $('#form-expense').find('input[name="id"]').removeAttr('value');
                $('#modal-form').modal('show');
            });

            
            $('.submit-form').click(function(e){
                e.preventDefault();
                $('#form-expense').submit();
            });

            $('#form-expense').on('submit',function(e){
                e.preventDefault();
                $this = $(this);
                $.ajax({
                    url: "{{url('/expenses')}}",
                    type : 'POST',
                    data: {
                        _token : $('meta[name="csrf-token"]').attr('content'),
                        id: $this.find('input[name="id"]').val(),
                        expense_date : $this.find('input[name="expense_date"]').val(),
                        payment_mode_id : $this.find('select[name="payment_mode_id"]').val(),
                        expense_type_id : $this.find('select[name="expense_type_id"]').val(),
                        employee_id : $this.find('select[name="employee_id"]').val(),
                        description : $this.find('input[name="description"]').val(),
                        ornos : $this.find('input[name="ornos"]').val(),
                        amount : $this.find('input[name="amount"]').val()
                    },
                    success: function(result){
                        Swal.fire(
                            'Success!',
                            'Expense has been saved',
                            'success'
                        ).then((result)=>{
                            dataTable.ajax.reload();
                            $('#form-expense').find('input[name="id"]').removeAttr('value');
                            $('#modal-form').find('.close').click();
                        })
                    }
                });
            });

            $('#modal-form').find('.close').on('click',function(){
                $('#form-expense').find('input[name="id"]').removeAttr('value');
            })
            
            $('#modal-form').find('.cancel').on('click',function(){
                $('#form-expense').find('input[name="id"]').removeAttr('value');
            })

            

            dataTable.on('click','a.edit',function(e){
                var tr = $(this).closest('tr');
                var data = dataTable.row( tr ).data();
                tr.removeClass('selected');
                $('#form-expense').find('input[name="id"]').val(data['id']);
                $('#form-expense').find('input[name="expense_date"]').val(data['expense_date']),
                $('#form-expense').find('select[name="payment_mode_id"]').val(data['payment_mode_id']),
                $('#form-expense').find('select[name="expense_type_id"]').val(data['expense_type_id']),
                $('#form-expense').find('select[name="employee_id"]').val(data['employee_id']),
                $('#form-expense').find('input[name="description"]').val(data['description']),
                $('#form-expense').find('input[name="ornos"]').val(data['ornos']),
                $('#form-expense').find('input[name="amount"]').val(data['amount'])
                $('#modal-form').modal('show');
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
                            url: "{{url('/expenses')}}/"+data['id'],
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


    });
</script>
@endsection