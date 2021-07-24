@extends('layouts.ace_master')

@section('content-header')
<!-- <div class="nav-search" id="nav-search">
    <form class="form-search">
        <span class="input-icon">
            <input type="date" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" value="{{date('Y-m-d')}}"/>
            <i class="ace-icon fa fa-search nav-search-icon"></i>
        </span>
    </form>
</div>  -->
@endsection

@section('content')

<div class="col-sm-7 infobox-container">
    <div class="infobox infobox-blue">
        <div class="infobox-icon">
            <i class="ace-icon fa fa-users"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">32</span>
            <div class="infobox-content">clients</div>
        </div>

        <!-- <div class="stat stat-success">8%</div> -->
    </div>

    <div class="infobox infobox-orange">
        <div class="infobox-icon">
            <i class="ace-icon fa fa-question"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">11</span>
            <div class="infobox-content">For Approval loans</div>
        </div>

        <!-- <div class="badge badge-success">
            +32%
            <i class="ace-icon fa fa-arrow-up"></i>
        </div> -->
    </div>

    <div class="infobox infobox-green">
        <div class="infobox-icon">
            <i class="ace-icon fa fa-thumbs-up"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">8</span>
            <div class="infobox-content">Approved Loans</div>
        </div>
        <!-- <div class="stat stat-important">4%</div> -->
    </div>

    <div class="infobox infobox-orange">
        <div class="infobox-icon">
            <i class="ace-icon fa fa-send"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">7</span>
            <div class="infobox-content">For Release</div>
        </div>
    </div>

    <div class="infobox infobox-green">
        <div class="infobox-icon">
            <i class="ace-icon fa fa-list"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">7</span>
            <div class="infobox-content">Released</div>
        </div>
    </div>

    <div class="infobox infobox-red">
        <div class="infobox-icon">
            <i class="ace-icon fa fa-calendar"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">7</span>
            <div class="infobox-content">Overdues</div>
        </div>
    </div>

    <div class="infobox infobox-blue">
        <div class="infobox-icon">
            <i class="ace-icon fa fa-credit-card"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">7</span>
            <div class="infobox-content">Expenses</div>
        </div>
    </div>

    <div class="infobox infobox-red">
        <div class="infobox-icon">
            <i class="ace-icon fa fa-download"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">7</span>
            <div class="infobox-content">Withdrawals</div>
        </div>
    </div>

    
</div>


<!-- <h3>DAILY TRANSACTION REPORT <small class="date-selected">02/03/2021</small></h3>
<div class="tabbable">
    <ul class="nav nav-tabs" id="myTab">
        <li class="active">
            <a data-toggle="tab" href="#daily">
                <i class="green ace-icon fa fa-asterisk bigger-120"></i>
                Daily
            </a>
        </li>

        <li>
            <a data-toggle="tab" href="#weekly">
                <i class="blue ace-icon fa fa-calendar bigger-120"></i>
                Weekly
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="daily" class="tab-pane fade in active">
            <button class="btn btn-success btn-sm pull-right"><i class="fa fa-print"></i> Print Report</button>
            <br><br>
            <table class="table table-bordered table-striped" style="width:100%">

                <tbody>
                    <tr>
                        <td>TOTAL RELEASE TO DATE</td>
                        <td>
                            <b class="blue total-release daily">0</b>
                        </td>
                    </tr>

                    <tr>
                        <td>TOTAL PRINCIPAL AMOUNT</td>

                        <td>
                            <b class="blue principal-amount daily">0</b>
                        </td>
                    </tr>

                    <tr>
                        <td>TOTAL NET RELEASE</td>
                        <td>
                            <b class="blue net-release daily">0</b>
                        </td>
                    </tr>
                </tbody>

                <tfoot>
                    <tr>
                        <th>CASH BEGINNING</th>
                        <th>
                        <b class="blue cash-beginning daily no-balance">{{$coh_daily}}</b>
                        <button data-payment_mode_id="1" class="{{$coh_daily>0 ? 'hidden' : ''}} dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-sm btn-bold pull-right btn-add_fund">
                            <span><i class="fa fa-plus bigger-110 blue"></i> Add fund</span>
                        </button>
                        </th>
                    </tr>
                </tfoot>
            </table>

            <h4>Loan Releases</h4>
            <table id="table-loan-release-daily" class="table table-bordered" style="width:100%">
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
                    <table id="table-expense-daily" class="table table-bordered" style="width:100%">
                        <thead>
                            <th>Expenses Description</th>
                            <th>Amount</th>
                        </thead>
                    </table>    
                </div>

                <div class="col-md-6 col-lg-6">
                    <h4>Reimbursement</h4>
                    <table id="table-reimbursement-daily" class="table table-bordered" style="width:100%">
                        <thead>
                            <th>Area</th>
                            <th>Amount</th>
                        </thead>
                    </table>
                </div>
            </div>
            
            <table class="table table-bordered table-striped" style="width:100%">

                <tbody>
                    <tr>
                        <td>CASH BEGINNING</td>
                        <td class="text-right">
                            <b class="blue total-release-daily">0</b>
                        </td>
                    </tr>

                    <tr>
                        <td>TOTAL REIMBURSEMENT</td>

                        <td class="text-right">
                            <b class="blue principal-amount-daily">0</b>
                        </td>
                    </tr>

                    <tr>
                        <th>LESS</th>
                        <td></td>
                    </tr>

                    <tr>
                        <td>TOTAL CASH RELEASE (NET)</td>
                        <td class="text-right">
                            <b class="blue total-release-daily">0</b>
                        </td>
                    </tr>

                    <tr>
                        <td>TOTAL EXPENSE</td>

                        <td class="text-right">
                            <b class="blue principal-amount-daily">0</b>
                        </td>
                    </tr>
                </tbody>


                <tfoot>
                    <tr>
                        <th>CASH ON HAND</th>
                        <th class="text-right">
                        <b class="blue cash-beginning-daily">0</b>
                        </th>
                    </tr>
                </tfoot>
            </table>

        </div>

        <div id="weekly" class="tab-pane fade">
            <button class="btn btn-success btn-sm pull-right"><i class="fa fa-print"></i> Print Report</button>
            <br><br>
            <table class="table table-bordered table-striped" style="width:100%">
            
                <tbody>
                    <tr>
                        <td>TOTAL RELEASE TO DATE</td>
                        <td>
                            <b class="blue total-release weekly">0</b>
                        </td>
                    </tr>

                    <tr>
                        <td>TOTAL PRINCIPAL AMOUNT</td>

                        <td>
                            <b class="blue principal-amount weekly">0</b>
                        </td>
                    </tr>

                    <tr>
                        <td>TOTAL NET RELEASE</td>
                        <td>
                            <b class="blue net-release weekly">0</b>
                        </td>
                    </tr>
                </tbody>

                <tfoot>
                    <tr>
                        <th>CASH BEGINNING</th>
                        <th>
                        <b class="blue cash-beginning weekly no-balance">{{$coh_weekly}}</b>
                        <button data-payment_mode_id="2" class="{{$coh_weekly>0 ? 'hidden' : ''}} dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-sm btn-bold pull-right btn-add_fund">
                            <span><i class="fa fa-plus bigger-110 blue"></i> Add fund</span>
                        </button>
                        </th>
                    </tr>
                </tfoot>
            </table>

            <h4>Loan Releases</h4>
            <table id="table-loan-release-weekly" class="table table-bordered" style="width:100%">
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
                    <table id="table-expense-weekly" class="table table-bordered"  style="width:100%">
                        <thead>
                            <th>Expenses Description</th>
                            <th>Amount</th>
                        </thead>
                    </table>    
                </div>

                <div class="col-md-6 col-lg-6">
                    <h4>Reimbursement</h4>
                    <table id="table-reimbursement-weekly" class="table table-bordered"  style="width:100%">
                        <thead>
                            <th>Area</th>
                            <th>Amount</th>
                        </thead>
                    </table>
                </div>
            </div>

            <table class="table table-bordered table-striped" style="width:100%">

                <tbody>
                    <tr>
                        <td>CASH BEGINNING</td>
                        <td class="text-right">
                            <b class="blue total-release-daily">0</b>
                        </td>
                    </tr>

                    <tr>
                        <td>TOTAL REIMBURSEMENT</td>

                        <td class="text-right">
                            <b class="blue principal-amount-daily">0</b>
                        </td>
                    </tr>

                    <tr>
                        <th>LESS</th>
                        <td></td>
                    </tr>

                    <tr>
                        <td>TOTAL CASH RELEASE (NET)</td>
                        <td class="text-right">
                            <b class="blue total-release-daily">0</b>
                        </td>
                    </tr>

                    <tr>
                        <td>TOTAL EXPENSE</td>

                        <td class="text-right">
                            <b class="blue principal-amount-daily">0</b>
                        </td>
                    </tr>
                </tbody>


                <tfoot>
                    <tr>
                        <th>CASH ON HAND</th>
                        <th class="text-right">
                        <b class="blue cash-beginning-daily">0</b>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div> -->

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
        
        $('.btn-add_fund').click(function(e){
            e.preventDefault();
            $('#modal-form').find('input[name="payment_mode_id"]').val($(this).data('payment_mode_id'));
            $('#modal-form').modal('show');
        });

        $('.submit-fund').click(function(e){
            e.preventDefault();
            $('#form-fund').submit();
        });

        $('#form-fund').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                url: "{{url('/branches/submit-fund')}}",
                type : 'POST',
                data: {
                    _token : $('meta[name="csrf-token"]').attr('content'),
                    payment_mode_id : $(this).find('input[name="payment_mode_id"]').val(),
                    fund : $(this).find('input[name="fund"]').val()
                },
                success: function(result){

                }
            });
        });
        
        function getReleasesDaily(selectedDate){
            var table_release_daily = $('#table-loan-release-daily').DataTable({
                ajax: {
                    url : "{{url('loans-releases-json')}}",
                    type : "POST",
                    data: {
                        date_release : selectedDate,
                        payment_mode_id : 1,
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
                    {data : null, render(data,type){
                        return '';
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
                }
            });
        }

        function getReimbursementDaily(selected_date){
            var table_reimbursement_daily = $('#table-reimbursement-daily').DataTable({
                ajax: {
                    url : "{{url('areas-json')}}",
                    type: "GET",
                    data: {
                        reimburse_date : selected_date,
                        for_daily_areas : 1
                    }
                },
                bInfo : false,
                bFilter: false,
                paging: false,
                columns: [
                    {data : 'name', render(data,type){
                        return 'AREA '+data;
                    }},
                    {data: 'reimbusement',render(data,type){
                        return '';
                    }}
                ]
            });
        }

        function getExpensesDaily(selected_date){
            
            var table_expense_daily = $('#table-expense-daily').DataTable({
                ajax: {
                    url : "{{url('expenses-json')}}",
                    type: "GET",
                    data: {
                        expense_date : selected_date,
                        payment_mode_id : 1
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

        $('form.form-search').find('input[type="date"]').change(function(e){
            $('#table-loan-release-daily').DataTable().destroy();
            $('#table-reimbursement-daily').DataTable().destroy();
            $('#table-expense-daily').DataTable().destroy();
            getReleasesDaily($(this).val());
            getReimbursementDaily($(this).val());
            getExpensesDaily($(this).val());
        });

        $('form.form-search').find('input[type="date"]').trigger('change');
        

        

        

        var table_release_weekly = $('#table-loan-release-weekly').DataTable({
            bInfo : false,
            bFilter: false,
            paging: false
        });

        var table_expense_weekly = $('#table-expense-weekly').DataTable({
            bInfo : false,
            bFilter: false,
            paging: false
        });

        var table_reimbursement_weekly = $('#table-reimbursement-weekly').DataTable({
            bInfo : false,
            bFilter: false,
            paging: false
        });
    })
</script>
@endsection
