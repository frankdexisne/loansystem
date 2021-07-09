@extends('layouts.ace_master')


@section('content-header')
<ul class="breadcrumb">
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="#">Home</a>
    </li>
    <li>
        <a href="#">System Libraries</a>
    </li>
    <li class="active">Payments</li>
</ul>
@endsection

@section('content')
<div class="row">
    <div class="widget-box">
        <div class="widget-header">
            <h4 class="widget-title">
                Active loans and Payments
            </h4>
            <span class="widget-toolbar">
                <!-- <a href="#" id="open-wizard">
                    <i class="ace-icon fa fa-plus"></i> Apply loan
                </a> -->
                <form action="" class="form-inline" id="form-search">
                    <div class="form-group">
                        <label for="">Area : </label>
                        <select name="area_id" class="form-control">
                            <option selected disabled>--Please select area--</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Payment mode : </label>
                        <select name="payment_mode_id" class="form-control">
                            <option selected disabled>--Please payment mode--</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Payment date : </label>
                        <input type="date" class="form-control" name="payment_date" value="{{date('Y-m-d')}}">
                    </div>
                </form>
                
            </span>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active">
                            <a data-toggle="tab" href="#active-loans">
                                <i class="orange ace-icon fa fa-credit-card bigger-120"></i>
                                Active Loans
                            </a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#payments">
                            <i class="blue ace-icon fa fa-money bigger-120"></i>
                                Payments
                                <span class="badge badge-success">4</span>
                            </a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div id="active-loans" class="tab-pane fade in active">
                            <table class="table table-bordered" id="table-loan" width="100%">
                                <thead>                  
                                <tr>
                                    
                                    <th>Name</th>
                                    <th>Loan Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>

                        <div id="payments" class="tab-pane fade">
                            <table class="table table-bordered" id="table-payment" width="100%">
                                <thead>                  
                                <tr>
                                    <th>Name</th>
                                    <th>OR #</th>
                                    <th>Amount</th>
                                    <th>PS</th>
                                    <th>CBU</th>
                                    <th>Ins</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            
                
            </div>
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
<script src="{{asset('/ace-master')}}/js/wizard.min.js"></script>
<script src="{{asset('/js/sweetalert2.js')}}"></script>
<script src="{{asset('/js/references.js')}}"></script>
<script src="{{asset('/ace-master')}}/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){    

    populate_dropdown("{{url('areas-json')}}",'form#form-search select[name="area_id"]','id','name');
    populate_dropdown("{{url('payment-modes-json')}}",'form#form-search select[name="payment_mode_id"]','id','name');

    $('form#form-search select[name="area_id"]').on('change',function(e){
        e.preventDefault();
        $('#table-loan').DataTable().destroy();
        tableLoans();
        $('#table-payment').DataTable().destroy();
        tablePayments();
    });

    $('form#form-search select[name="payment_mode_id"]').on('change',function(e){
        e.preventDefault();
        $('#table-loan').DataTable().destroy();
        tableLoans();
        $('#table-payment').DataTable().destroy();
        tablePayments();
    });

    $('form#form-search input[name="payment_date"]').on('change',function(e){
        e.preventDefault();
        $('#table-payment').DataTable().destroy();
        tablePayments();
    });
    function loanList(data){
        var returnHTML ='';
        returnHTML += '<table class="table table-bordered">'+
                            '<thead>'+
                                '<th>Details</th>'+
                                '<th>Payment Form</th>'+
                            '</thead>'+
                            '<tbody>';
                            $.each(data['loan'],function(i){
                                var actionButtons = '';
                                

                                returnHTML+='<tr data-index="'+i+'" id="'+this.id+'">'+
                                    '<td width="450px">'+
                                        '<table>'+
                                            '<tr>'+
                                                '<td>Transaction code :</td>'+
                                                '<td>'+this.transaction_code+'</td>'+
                                                '<td width="10px"></td>'+
                                                '<td>Applied date : </td>'+
                                                '<td>'+this.date_loan_formatted+'</td>'+
                                            '</tr>'+
                                            '<tr>'+
                                                '<td>Category :</td>'+
                                                '<td>'+this.category.name+'</td>'+
                                                '<td></td>'+
                                                '<td>Date release : </td>'+
                                                '<td>'+this.date_release_formatted+'</td>'+
                                            '</tr>'+
                                            '<tr>'+
                                                '<td>Payment mode :</td>'+
                                                '<td>'+this.payment_mode.name+'</td>'+
                                                '<td></td>'+
                                                '<td>First payment : </td>'+
                                                '<td>'+this.first_payment_formatted+'</td>'+
                                            '</tr>'+
                                            '<tr>'+
                                                '<td>Term :</td>'+
                                                '<td>'+this.term.name+'</td>'+
                                                '<td></td>'+
                                                '<td>Maturity : </td>'+
                                                '<td>'+this.maturity_date_formatted+'</td>'+
                                            '</tr>'+
                                            '<tr>'+
                                                '<td>Loan amount :</td>'+
                                                '<td>'+this.loan_amount_formatted+'</td>'+
                                                '<td></td>'+
                                                '<td>Balance : </td>'+
                                                '<td>'+this.balance_formatted+'</td>'+
                                            '</tr>'+
                                        '</table>'+
                                    '</td>'+
                                    '<td>'+
                                        
                                        '<form class="form-payment">'+
                                            '<table width="80%" style="border-spacing: 2px; border-collapse: separate;">'+
                                                '<tr>'+
                                                    '<td>OR Number:</td>'+
                                                    '<td><input type="text" name="orno" class="form-control" style="width:100%"></td>'+
                                                    '<td width="15px"></td>'+
                                                    '<td>Amount:</td>'+
                                                    '<td><input type="number" name="amount" class="form-control" style="width:100%"></td>'+
                                                    '<td></td>'+
                                                    '<td></td>'+
                                                    '<td></td>'+
                                                '</tr>';
                                                
                                            if(this.payment_mode_id!==1){
                                                returnHTML+='<tr cellspacing="2">'+
                                                    '<td>PS:</td>'+
                                                    '<td><input type="number" name="ps" class="form-control" style="width:100%;margin-left:4px;"></td>'+
                                                    '<td width="15px"></td>'+
                                                    '<td>CBU:</td>'+
                                                    '<td><input type="number" name="cbu" class="form-control" style="width:100%"></td>'+
                                                    '<td width="15px"></td>'+
                                                    '<td>Ins:</td>'+
                                                    '<td><input type="number" name="ins" class="form-control" style="width:100%"></td>'+
                                                '</tr>';
                                            }
                                                


                                            returnHTML+='<tr>'+
                                                    '<td></td>'+
                                                    '<td>'+
                                                        '<button style="margin-left:4px;" type="submit" class="btn btn-xs btn-success">Post payment</button>'+
                                                    '</td>'+
                                                    '<td></td>'+
                                                    '<td></td>'+
                                                    '<td></td>'+
                                                    '<td></td>'+
                                                    '<td></td>'+
                                                    '<td></td>'+
                                                '</tr>'+
                                            '</table>'+
                                            
                                            
                                        '</form>'+
                                        
                                    '</td>'+
                                    '</tr>';
                            })
                            returnHTML+='</tbody>';
                            returnHTML+='</table>';
                                
        return returnHTML;
    }

    function tableLoans(){
        
        var table_loan = $('#table-loan').DataTable({
            
            ajax: {
                url : "{{url('loans-json')}}",
                type: "GET",
                data: {
                    payment_mode_id : $('#form-search select[name="payment_mode_id"]').val(),
                    area_id : $('#form-search select[name="area_id"]').val(),
                    table_type: "payment" 
                }
            },
            columnDefs: [
                {width: '20%', targets: [0]}
            ],
            columns: [
                {data : null,render(data,type){
                    return data['lname']+', '+data['fname']+' '+data['mname'];
                }},
                {data: null,render(data,type){
                    return loanList(data);
                }}
            ]
        });
        table_loan.off('submit','.form-payment');

        table_loan.on('submit','.form-payment',function(e){
            e.preventDefault();
            $form = $(this);
            $table = $(this).closest('table');
            $loan_id = $(this).closest('tr').attr('id');
            $tr = $table.closest('tr');
            $subTr = $(this).closest('tr');
            var data = table_loan.row($tr).data();
            
            $.ajax({
                url: "{{url('payments')}}",
                type: "POST",
                data: {
                    _token : "{{csrf_token()}}",
                    id: null,
                    orno : $table.find('input[name="orno"]').val(),
                    payment_date : $('#form-search').find('input[name="payment_date"]').val(),
                    amount : $table.find('input[name="amount"]').val(),
                    ps : $table.find('input[name="ps"]').val(),
                    cbu : $table.find('input[name="cbu"]').val(),
                    loan_client_id : data['id'],
                    loan_id : $loan_id
                },
                success: function(result){
                    var json_data =result;
                    Swal.fire(
                        'Success!',
                        "Payments has been submitted",
                        'success'
                    ).then((result)=>{
                        $form.trigger('reset');
                        if(json_data.settled_loan==1){
                            $subTr.remove();
                            $table_tr = $table.find('tbody').find('tr');
                            
                            if($table_tr.length==0){
                                $tr.remove();
                            }
                        }
                    })
                    
                },
                error: function(xhr){

                }
            })
        })
    }

    function tablePayments(){
        var table_payment = $('#table-payment').DataTable({
            
            ajax: {
                url : "{{url('payments-json')}}",
                type: "GET",
                data: {
                    payment_date : $('#form-search input[name="payment_date"]').val(),
                    area_id : $('#form-search select[name="area_id"]').val(),
                    payment_mode_id : $('#form-search select[name="payment_mode_id"]').val()
                }
            },
            columnDefs: [
                {width: '40%',targets: [0]},
                {width: '10%',targets: [1,2,3,4,5,6]}
            ],
            columns: [
                {data: 'client',render(data,type){
                    return data['lname']+', '+data['fname']+' '+data['mname'];
                }},
                {data: 'payment',render(data,type){
                    return data[0]['orno'];
                }},
                {data: 'payment',render(data,type){
                    return data[0]['amount_formatted'];
                }},
                {data: 'payment',render(data,type){
                    return data[0]['ps_amount'];
                }},
                {data: 'payment',render(data,type){
                    return data[0]['cbu_amount'];
                }},
                {data: 'payment',render(data,type){
                    return data[0]['ins_amount'];
                }},
                {data: null, render(data,type){
                    var actionButtons = '<div class="action-buttons">';
                    
                    @can('payments.edit')
                        actionButtons += '<a class="blue edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
                    @endcan
                    @can('payments.destroy')
                        actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
                    @endcan

                    actionButtons += '</div>';

                    return actionButtons;
                }}
            ],
            initComplete: function(){
                $('.badge-success').html(table_payment.data().count());
            }
        });
        @can('payments.destroy')
        table_payment.off('click','.edit');
        table_payment.on('click','.edit',function(e){
            e.preventDefault();
            $tr = $(this).closest('tr');
            $td=$tr.find('td');
            
            var data = table_payment.row($tr).data();
            var actionButtons = '<div class="action-buttons">';    
            actionButtons += '<a class="green update-payment" href="#"><i class="ace-icon fa fa-check bigger-130"></i></a>';
            actionButtons += '<a class="red cancel" href="#"><i class="ace-icon fa fa-times bigger-130"></i></a>';
            actionButtons += '</div>';
            console.log(data);
            $td.eq(0).html(data['client']['lname']+', '+data['client']['fname']+' '+data['client']['mname']+' Change payment date : <input type="date" name="payment_date" class="form-control" value="'+data['payment'][0]['payment_date']+'">');
            $td.eq(1).html('<input type="text" name="orno" class="form-control" value="'+data['payment'][0]['orno']+'">');
            $td.eq(2).html('<input type="number" name="amount" class="form-control" value="'+data['payment'][0]['amount']+'">');
            if(data['payment_mode_id']!==1){
                $td.eq(3).html('<input type="number" name="ps" class="form-control" value="'+parseFloat(data['payment'][0]['ps_amount'])+'">');
                $td.eq(4).html('<input type="number" name="cbu" class="form-control" value="'+parseFloat(data['payment'][0]['cbu_amount'])+'">');
            }
            $td.eq(6).html(actionButtons);
        })
        table_payment.off('click','.update-payment');
        table_payment.on('click','.update-payment',function(e){
            e.preventDefault();
            $tr = $(this).closest('tr');
            $td=$tr.find('td');
            var data = table_payment.row($tr).data();
            var actionButtons = '<div class="action-buttons">'; 
            @can('payments.edit')
                actionButtons += '<a class="blue edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            @endcan
            @can('payments.destroy')
                actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            @endcan
            actionButtons += '</div>';
            $.ajax({
                url: "{{url('payments')}}/"+data['payment'][0]['id'],
                type: "PUT",
                data: {
                    _token : "{{csrf_token()}}",
                    id: data['payment'][0]['id'],
                    orno : $tr.find('input[name="orno"]').val(),
                    payment_date : $tr.find('input[name="payment_date"]').val(),
                    amount : $tr.find('input[name="amount"]').val(),
                    ps : $tr.find('input[name="ps"]').val(),
                    cbu : $tr.find('input[name="cbu"]').val(),
                    loan_client_id : data['client_id']
                },
                success: function(result){
                    
                    data['payment'][0]['orno']=$tr.find('input[name="orno"]').val();
                    data['payment'][0]['payment_date']=$tr.find('input[name="payment_date"]').val();
                    data['payment'][0]['amount']=$tr.find('input[name="amount"]').val();
                    data['payment'][0]['ps_amount']=$tr.find('input[name="ps"]').val();
                    data['payment'][0]['cbu_amount']=$tr.find('input[name="cbu"]').val();
                    $td.eq(0).html(data['client']['lname']+', '+data['client']['fname']+' '+data['client']['mname']);
                    $td.eq(1).html($tr.find('input[name="orno"]').val());
                    $td.eq(2).html($tr.find('input[name="amount"]').val());
                    if(data['payment_mode_id']!==1){
                        $td.eq(3).html($tr.find('input[name="ps"]').val());
                        $td.eq(4).html($tr.find('input[name="cbu"]').val());
                    }
                    $td.eq(6).html(actionButtons);
                },
                error: function(xhr){

                }
            })
            
        });
        table_payment.on('click','.cancel',function(e){
            e.preventDefault();
            $tr = $(this).closest('tr');
            $td=$tr.find('td');
            var data = table_payment.row($tr).data();
            var actionButtons = '<div class="action-buttons">';
                    
            @can('payments.edit')
                actionButtons += '<a class="blue edit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            @endcan
            @can('payments.destroy')
                actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            @endcan

            actionButtons += '</div>';
            $td.eq(0).html(data['client']['lname']+', '+data['client']['fname']+' '+data['client']['mname']);
            $td.eq(1).html(data['payment'][0]['orno']);
            $td.eq(2).html(data['payment'][0]['amount']);
            if(data['payment_mode_id']!==1){
                $td.eq(3).html(data['payment'][0]['ps_amount']);
                $td.eq(4).html(data['payment'][0]['cbu_amount']);
            }
            $td.eq(6).html(actionButtons);
        });
        @endcan
        @can('payments.destroy')
        table_payment.on('click','.delete',function(e){
            e.preventDefault();
            $tr = $(this).closest('tr');
            var data = table_payment.row($tr).data();
            Swal.fire({
                title: 'Are you sure?',
                text: "Cancel this payment",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {    
                if (result.isConfirmed) {
                    var form_data = { _token : "{{csrf_token()}}", _method: "_delete" , id: data['payment'][0]['id']};

                    $.ajax({
                        url: "{{url('/payments')}}/"+data['payment'][0]['id'],
                        type: "DELETE",
                        data: form_data,
                        success: function(result){
                            Swal.fire(
                                'Success!',
                                "Client's payment has been cancelled.",
                                'success'
                            ).then((result)=>{
                                table_payment.row($tr).remove().draw();
                            })
                        }
                    });
                    
                }
            })

        })
        @endcan
    }

    tablePayments();

    tableLoans();
    

});
</script>
@endsection