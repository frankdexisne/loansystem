@extends('layouts.ace_master')


@section('content-header')
<ul class="breadcrumb">
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="#">Home</a>
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
    });

    $('form#form-search select[name="payment_mode_id"]').on('change',function(e){
        e.preventDefault();
        $('#table-loan').DataTable().destroy();
        tableLoans();
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
                                                '</tr>'+
                                                
                                                
                                                '<tr cellspacing="2">'+
                                                    '<td>PS:</td>'+
                                                    '<td><input type="number" name="ps" class="form-control" style="width:100%;margin-left:4px;"></td>'+
                                                    '<td width="15px"></td>'+
                                                    '<td>CBU:</td>'+
                                                    '<td><input type="number" name="cbu" class="form-control" style="width:100%"></td>'+
                                                    '<td width="15px"></td>'+
                                                    '<td>Ins:</td>'+
                                                    '<td><input type="number" name="ins" class="form-control" style="width:100%"></td>'+
                                                '</tr>'+

                                                '<tr>'+
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
    }

    function tablePayments(){
        var table_payment = $('#table-payment').DataTable({
            
            ajax: {
                url : "{{url('payments-json')}}",
                type: "GET",
                data: {
                    payment_date : $('#form-search input[name="payment_date"]').val()
                }
            },
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
                    return '';
                }}
            ]
        });
    }

    tablePayments();

    tableLoans();
    

});
</script>
@endsection