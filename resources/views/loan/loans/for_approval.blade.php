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
        <a>Loans</a>
    </li>
    <li class="active">For Approval</li>
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
            List of For Approval loans
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
        $colIndex = 1;
        $disable_form_search = 1;

        $element = '#datatable';
        ajaxUrl = "{{url('loans-json')}}";
        ajaxType = "GET";
        ajaxData = {
            status : "FOR APPROVAL"
        };
        _columns = [
            {data : 'transaction_code', title : 'Transaction code'},
            {data : 'client', title : 'Name of Client', render(data){
                return data['lname']+', '+data['fname']+' '+data['mname']+'<br>'+data['contact_no'];
            }},
            {data : null ,title : 'Details', render(data){
                return 'Category: <b>'+data['category']['name']+'</b> | Terms : <b>'+data['term']['no_of_months']+(data['term']['daily_only']==0 ? ' months' : ' days')+'</b><br> Payment Mode : <b>'+data['payment_mode']['name']+'</b> | Loan Amount : <b>'+data['loan_amount_formatted']+'</b>';
            }},
            {data : null, title : 'Action', render(data,type){
                return '<div class="hidden-sm hidden-xs action-buttons">'+
							'<a class="green edit" href="#">'+
								'<i class="ace-icon fa fa-pencil bigger-130"></i>'+
							'</a>'+
							'<a class="red delete" href="#">'+
								'<i class="ace-icon fa fa-trash-o bigger-130"></i>'+
							'</a>'+
						'</div>';
            }},
        ];

        function formatCreateLoan(d){
            
            var generatedForm = '<form class="form-renew" style="width:100%">';
            generatedForm += '<input type="hidden" name="client_id" value="'+d.client_id+'">';
            generatedForm += '<table style="width:100%" cellspacing="5">';
            generatedForm += '<tr>'+
                '<td><label>Category</label></td>'+
                '<td>'+
                    '<select class="form-control" name="category_id" style="width:100%">'+
                    '</select>'+
                '</td>'+
                '</tr>';
            generatedForm += '<tr>'+
            '<td><label>Payment Mode</label></td>'+
            '<td>'+
                '<select class="form-control" name="payment_mode_id" style="width:100%">'+
                '</select>'+
            '</td>'+
            '</tr>';

            generatedForm += '<tr>'+
                '<td><label>Terms</label></td>'+
                '<td>'+
                    '<select class="form-control" name="term_id" style="width:100%">'+
                    '</select>'+
                '</td>'+
                '</tr>';

            generatedForm += '<tr>'+
                '<td><label>Loan Amount</label></td>'+
                '<td><input type="number" class="form-control" name="loan_amount" style="width:100%;margin-left:4px;" value="'+d.loan_amount+'"></td>'+
                '</tr>';

            generatedForm += '<tr>'+
            '<td><label>Loan Interest(%)</label></td>'+
            '<td><input type="number" class="form-control" name="interest" min="1" max="100" style="width:100%;margin-left:4px;"  value="'+d.interest+'"></td>'+
            '</tr>';

            generatedForm += '<tr>'+
            '<td>&nbsp;</td>'+
            '<td>&nbsp;</td>'+
            '</tr>';

            generatedForm += '</table>';

            generatedForm += '<table style="width:100%" cellspacing="5">';
            generatedForm += '<tr>'+
            '<td></td>'+
            '<td><button type="submit" class="btn btn-success pull-right" disabled>Submit</button></td>'+
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

            $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
            new $.fn.dataTable.Buttons( dataTable, {
                buttons: [
                    {
                    "text": "<i class='fa fa-thumbs-up bigger-110 green'></i> <span class=''>Approve</span>",
                    "className": "btn btn-white btn-primary btn-bold btn-approve approval",
                    },
                    {
                    "text": "<i class='fa fa-thumbs-down bigger-110 red'></i> <span class=''>Disapprove</span>",
                    "className": "btn btn-white btn-primary btn-bold btn-disapproved approval",
                    },		  
                ]
            } );

            dataTable.buttons().container().appendTo( $('.tableTools-container') );

            $('.approval').click(function(e){
                $action = $(this).hasClass('btn-approve') ? 'APPROVED' : 'DENIED';
                $question = $(this).hasClass('btn-approve') ? 'Approve' : 'Deny';
                e.preventDefault();
                $tr=$(this).closest('tr');
                var data = dataTable.rows('tr.selected').data();
                var loan_ids = [];
                
                $.each(data.toArray(),function(d){
                    loan_ids.push(this.id); 
                });
                
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: $question+" selected loans",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                    }).then((result) => {    
                    if (result.isConfirmed) {
                        var form_data = { _token : "{{csrf_token()}}" , loan_ids : loan_ids, action: $action};

                        $.ajax({
                            url: "{{url('/loans/approval')}}",
                            type: "POST",
                            data: form_data,
                            success: function(result){
                                Swal.fire(
                                    'Approved!',
                                    'Loan(s) has been '+$action,
                                    'success'
                                ).then((result)=>{
                                    dataTable.rows('tr.selected').remove().draw(false);
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


            dataTable.on('click','a.edit',function(e){
                var tr = $(this).closest('tr');
                var row = dataTable.row( tr );
        
                if ( row.child.isShown() ) {
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    $prevTr=$('#datatable tbody tr.child-row');
                    $prevTr.prev('tr').find('td').eq(0).html('<a class="green show" href="#"><i class="ace-icon fa fa-plus bigger-130"></i></a>')
                    dataTable.row( $prevTr.prev('tr') ).child.hide()
                    $prevTr.prev('tr').removeClass('shown');
                    row.child( formatCreateLoan(row.data()),'child-row' ).show();
                    populate_dropdown("{{url('categories-json')}}",'form.form-renew select[name="category_id"]','id','name');
                    populate_dropdown("{{url('payment-modes-json')}}",'form.form-renew select[name="payment_mode_id"]','id','name');
                    tr.addClass('shown');
                    
                    
                    tr.next('tr.child-row').find('form.form-renew select[name="payment_mode_id"]').off('change');

                    tr.next('tr.child-row').find('form.form-renew select[name="payment_mode_id"]').on('change',function(){
                        tr.next('tr.child-row').find('form.form-renew select[name="term_id"]').html('');
                        var daily_only = $(this).val()==1 ? 1: 0;
                        $.ajax({
                            url: "{{url('terms-json')}}",
                            type: "GET",
                            dataType: 'JSON',
                            data: {
                                daily_only : daily_only,
                                filter : 1
                            },
                            success: function(result){
                                $data = result.data;
                                tr.next('tr.child-row').find('form.form-renew select[name="term_id"]').html('');
                                $.each($data, function() {
                                    tr.next('tr.child-row').find('form.form-renew select[name="term_id"]').append($("<option />").val(this['id']).text(this['name']));
                                });
                                
                            }
                        })
                    });

                    setTimeout(function(){
                        tr.next('tr.child-row').find('form.form-renew select[name="category_id"]').val(row.data()['category_id']);
                        tr.next('tr.child-row').find('form.form-renew select[name="payment_mode_id"]').val(row.data()['payment_mode_id']);
                        tr.next('tr.child-row').find('form.form-renew select[name="payment_mode_id"]').trigger('change');
                        tr.next('tr.child-row').find('form.form-renew button[type="submit"]').removeAttr('disabled');
                    },1500);
                    
                    
                }
                tr.removeClass('selected');
            });

            dataTable.off('submit','.form-renew');

            dataTable.on('submit','.form-renew',function(e){
                e.preventDefault();
                $this=$(this);
                $tr = $this.closest('tr').prev('tr.shown');
                

                var data = dataTable.row($tr).data();
                
                if($(this).valid()){
                    
                    $.ajax({
                        url: "{{url('/loans')}}/"+data['id'],
                        type: "PUT",
                        dataType: "JSON",
                        data: {
                            _token: "{{csrf_token()}}",
                            client_id: data['client_id'],
                            category_id: $this.find('select[name="category_id"]').val(),
                            payment_mode_id: $this.find('select[name="payment_mode_id"]').val(),
                            term_id: $this.find('select[name="term_id"]').val(),
                            loan_amount: $this.find('input[name="loan_amount"]').val(),
                            interest: $this.find('input[name="interest"]').val(),
                            byouts : []
                        },
                        success: function(result){
                            Swal.fire(
                                'Success!',
                                'Loan has been updated',
                                'success'
                            )
                        },
                        error: function(xhr){

                        }
                    })
                }
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
                            url: "{{url('/loans')}}/"+data['id'],
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