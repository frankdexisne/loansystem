@extends('layouts.ace_master')

@section('content-header')
<div class="nav-search" id="nav-search">
    <form class="form-search">
        <span class="input-icon">
            <!-- <input type="date" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" value="{{date('Y-m-d')}}"/> -->
            <!-- <label for="">Report Type</label> -->
            <select name="payment_mode_id" id="" class="form-control">
                <option value="none" selected disabled>--Please select report type--</option>
                <option value="1">Daily</option>
                <option value="2">Weekly</option>
            </select>
            <!-- <i class="ace-icon fa fa-search nav-search-icon"></i> -->
        </span>
    </form>
</div> 
@endsection

@section('content')

<h3>DAILY TRANSACTION REPORT</h3>
<!-- <button class="btn btn-success btn-sm pull-right"><i class="fa fa-print"></i> Print Report</button> -->
<!-- <br><br> -->
<table class="table table-bordered table-striped" style="width:100%">
    <tbody>
        <tr>
            <td>TOTAL RELEASE TO DATE</td>
            <td>
                <b class="blue total-release">0</b>
            </td>
        </tr>

        <tr>
            <td>TOTAL PRINCIPAL AMOUNT</td>

            <td>
                <b class="blue principal-amount">0</b>
            </td>
        </tr>

        <tr>
            <td>TOTAL NET RELEASE</td>
            <td>
                <b class="blue net-release">0</b>
            </td>
        </tr>
    </tbody>

    <tfoot>
        <tr>
            <th>CASH BEGINNING</th>
            <th>
            <b class="blue cash-beginning"></b>
            <button class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-sm btn-bold pull-right btn-add_fund">
                <span><i class="fa fa-plus bigger-110 blue"></i> Add fund</span>
            </button>
            </th>
        </tr>
    </tfoot>
</table>

<h4>Loan Releases</h4>
<table id="table-loan-release" class="table table-bordered" style="width:100%">
    <thead>
        <th>Client Name</th>
        <th>Status</th>
        <th>Loan Balance</th>
        <th>Loan Amount</th>
        <th>Net</th>
    </thead>
</table>

<div class="row">
    <div class="col-md-6 col-lg-6">
        <h4>Expenses</h4>
        <table id="table-expense" class="table table-bordered" style="width:100%">
            <thead>
                <th>Expenses Description</th>
                <th>Amount</th>
            </thead>
        </table>    
    </div>

    <div class="col-md-6 col-lg-6">
        <h4>Reimbursement</h4>
        <table id="table-reimbursement" class="table table-bordered" style="width:100%">
            <thead>
                <th>Area</th>
                <th>Amount</th>
            </thead>
            <tfoot>
                <th></th>
                <th></th>
            </tfoot>
        </table>
    </div>
</div>

<table class="table table-bordered table-striped" style="width:100%">

    <tbody>
        <tr>
            <td>CASH BEGINNING</td>
            <td class="text-right">
                <b class="blue cash-beginning">0</b>
            </td>
        </tr>

        <tr>
            <td>TOTAL REIMBURSEMENT</td>

            <td class="text-right">
                <b class="blue total-reimbursement">0</b>
            </td>
        </tr>

        <tr>
            <th>LESS</th>
            <td></td>
        </tr>

        <tr>
            <td>TOTAL CASH RELEASE (NET)</td>
            <td class="text-right">
                <b class="blue net-release">0</b>
            </td>
        </tr>

        <tr>
            <td>TOTAL EXPENSE</td>

            <td class="text-right">
                <b class="blue total-expenses">0</b>
            </td>
        </tr>
    </tbody>


    <tfoot>
        <tr>
            <th>CASH ON HAND</th>
            <th class="text-right">
            <b class="blue coh">0</b>
            </th>
        </tr>
    </tfoot>
</table>

<div id="modal-form" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Please provide fund</h4>
            </div>

            <div class="modal-body">
                <form id="form-fund">
                    <input type="hidden" name="payment_mode_id">
                    <div class="form-group">
                        <label for="">Name of Branch</label>
                        <input type="text" class="form-control" readonly="true" value="{{getWorkStation()->branch->name}}">
                    </div>
                    <div class="form-group">
                        <label for="">Fund</label>
                        <input type="text" class="form-control" name="fund" required>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Cancel
                </button>

                <button class="btn btn-sm btn-primary submit-fund">
                    <i class="ace-icon fa fa-check"></i>
                    Save
                </button>
            </div>
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->
@endsection

@section('scripts')
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
<script>
    $(document).ready(function(){  
        
        $('form.form-search').find('select').on('change',function(e){
            $payment_mode=$(this).val();
            $.ajax({
                url: "{{url('/daily-transactions')}}/"+$payment_mode,
                type: "GET",
                success: function(res){
                    
                    $coh = $('.cash-beginning');
                    $coh.each(function(){
                        $(this).html(0);
                        if(res.data!=null){
                            $(this).html(res.data.coh);
                        }else{
                            if($payment_mode==1){
                                $(this).html("{{$coh_daily}}");
                            }else{
                                $(this).html("{{$coh_weekly}}");
                            }
                        }
                    });
                    
                    getReleases("{{date('Y-m-d')}}",$payment_mode);
                    getRemittances("{{date('Y-m-d')}}",$payment_mode);
                    getExpenses("{{date('Y-m-d')}}",$payment_mode);
                }
            })
            
            
        });

        function getReleases(selectedDate,payment_mode_id){
            if($.fn.DataTable.isDataTable('#table-loan-release')){
                $('#table-loan-release').DataTable().destroy();
            }
            var table_release_daily = $('#table-loan-release').DataTable({
                ajax: {
                    url : "{{url('loans-releases-json')}}",
                    type : "POST",
                    data: {
                        date_release : selectedDate,
                        payment_mode_id : payment_mode_id,
                        _token : $('meta[name="csrf-token"]').attr('content')
                    }
                },
                bInfo : false,
                bFilter: false,
                paging: false,
                columnDefs: [
                    {className : 'text-right', targets: [2,3,4]}
                ],
                columns: [
                    {data: null, render(data,type){
                        return data['client']['lname']+', '+data['client']['fname']+' '+data['client']['mname'];
                    }},
                    {data : 'is_renew', render(data,type){
                        return data==1 ? 'RENEW' : 'NEW';
                    }},
                    {data : 'balance'},
                    {data : 'loan_amount'},
                    {data: null, render(data,type){
                        var total = 0;
                        $.each(data['loan_charge'],function(){
                            total+=parseFloat(this.amount);
                        });
                        return parseFloat(data['loan_amount'])-total;
                    }}
                ],
                rowGroup: {
                    dataSrc: 'client.area.name',
                    startRender: function ( rows, group ){
                        return $('<tr/>')
                            .append('<td colspan="5"> AREA ' + group + ' (' + rows.count() + ' loans)</td>');
                    }
                },
                initComplete:function(setting,json){
                    var overall_loan_amount = 0;
                    var overall_charge = 0;
                    $.each(json.data,function(){
                        overall_loan_amount += parseFloat(this.loan_amount);
                        $.each(this['loan_charge'],function(){
                            overall_charge+=parseFloat(this.amount);
                        });
                    });
                    
                    $net_release = $('.net-release');
                    $net_release.each(function(){
                        $(this).html(parseFloat(overall_loan_amount)-parseFloat(overall_charge));
                    })
                    $principal_amount = $('.principal-amount');
                    $principal_amount.each(function(){
                        $(this).html(overall_loan_amount);
                    })
                }
            });
        }

        function getExpenses(selectedDate,payment_mode_id){
            if($.fn.DataTable.isDataTable('#table-expense')){
                $('#table-expense').DataTable().destroy();
            }
            var table_expense_daily = $('#table-expense').DataTable({
                ajax: {
                    url : "{{url('expenses-json')}}",
                    type: "GET",
                    data: {
                        expense_date : selectedDate,
                        payment_mode_id : payment_mode_id ==1 ? 1 : 0
                    }
                },
                bInfo : false,
                bFilter: false,
                paging: false,
                columns: [
                    {data : 'description'},
                    {data: 'amount'}
                ]
            });
        }

        function getRemittances(selectedDate,payment_mode_id){
            if($.fn.DataTable.isDataTable('#table-reimbursement')){
                $('#table-reimbursement').DataTable().destroy();
            }
            var table_remittances = $('#table-reimbursement').DataTable({
                ajax: {
                    url : "{{url('areas-json')}}",
                    type: "GET",
                    data: {
                        reimburse_date : selectedDate,
                        for_daily_areas : payment_mode_id ==1 ? 1 : 0
                    }
                },
                bInfo : false,
                bFilter: false,
                paging: false,
                columns: [
                    {data : 'name', render(data,type){
                        return 'AREA '+data;
                    }},
                    {data: 'reimbursement',render(data,type){
                        var total_collection = 0;
                        $.each(data,function(){
                            total_collection+= parseFloat(this.total_collection);
                            
                        })
                        return total_collection;
                    }}
                ],
                initComplete: function(setting,json){
                    var total = 0;
                    $('#table-reimbursement tbody > tr').each(function(){
                        $td = $(this).find('td');
                        total+= parseFloat($td.eq(1)[0].innerHTML);
                    });
                    $('#table-reimbursement tfoot').find('th').eq(1).html(total);
                    $('.total-reimbursement').each(function(){
                        $(this).html(total);
                    })
                }
            });
        }

        
        
    })
</script>
@endsection
