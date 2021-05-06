@extends('layouts.ace_master')

@section('style')
<style>
.error-provider{
    color: red;
}
.hide-error{
    display:none;
}
.step-pane{
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
    <li><a href="#">Reports</a></li>
    <li class="active">Loan Report</li>
</ul>

<div class="nav-search" id="nav-search">
    <form id="form-search" class="form-inline">
        <div class="form-group">
            <label for="">Area</label>
            <select name="area_id" id="" class="form-control">
                
            </select>
        </div>
        <div class="form-group">
            <label for="">Month</label>
            <input type="month" class="form-control" name="cutoff_month" value="{{date('Y-m')}}" required>
        </div>
        <div class="form-group">
            <label for="">Cutoff</label>
            <select name="cutoff_date" id="" class="form-control">
                <option value="07">07</option>
                <option value="15">15</option>
                <option value="23">23</option>
                <option value="t">Last day</option>
            </select>
        </div>
        <div class="form-group">
            <div class="btn-group">
                <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-search"></i> Search</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('content')
<div class="row">
    <div class="widget-box">
        <div class="widget-header">
            <h4 class="widget-title">
                
            </h4>
            <span class="widget-toolbar">
                <div class="pull-right tableTools-container"></div>
            </span>
        </div>

        <div class="widget-body">
            <div class="widget-main">
            
            
            <table class="table table-bordered" id="table-report" width="100%">
                <thead>                  
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Loan Amount</th>
                        <th>Loan Balance</th>
                        <th>Sales</th>
                        <th>Deduction</th>
                        <th>Byout</th>
                        <th>Net Amount</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
                
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
    $('#form-search').off('submit');

    $('#form-search').on('submit',function(e){
        e.preventDefault();
        $form = $(this);
        if($form.valid()){
            generateReport();
        }
    })

    function generateReport(){
        if($.fn.DataTable.isDataTable('#table-report')){
            $('#table-report').DataTable().destroy();    
        }
        var tableReport = $('#table-report').DataTable({
            ajax: {
                url: "{{route('reports.ncr-json')}}",
                type: "GET",
                data: {
                    cutoff_month : $('#form-search input[name="cutoff_month"]').val(),
                    cutoff_date : $('#form-search select[name="cutoff_date"]').val(),
                    area_id : $('#form-search select[name="area_id"]').val()
                }
            },
            
            columnDefs: [
                {width: '20%', targets: [0]},
                {width: '5%', targets: [1,2,3,4,5,6,7,8]}

            ],
            columns: [
                
                {data: null,render(data,type){
                    return '';
                }},
                {data: null,render(data,type){
                    return '';
                }},
                {data: 'client_name'},
                {data: null,render(data,type){
                    return '';
                }},
                {data: null,render(data,type){
                    return '';
                }},
                {data: null,render(data,type){
                    return '';
                }},
                {data: null,render(data,type){
                    return '';
                }},
                {data: null,render(data,type){
                    return '';
                }},
                {data: null,render(data,type){
                    return '';
                }},
                {data: null,render(data,type){
                    return '';
                }}
            ],
            initComplete: function(datatable,ajax){
                
            }
        });

        $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
        new $.fn.dataTable.Buttons( tableReport, {
            buttons: [
                
                {
                "extend": "csv",
                "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                "className": "btn btn-white btn-primary btn-bold"
                },
                {
                "extend": "excel",
                "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                "className": "btn btn-white btn-primary btn-bold"
                },
                {
                "extend": "pdf",
                "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                "className": "btn btn-white btn-primary btn-bold"
                },
                {
                "extend": "print",
                "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                "className": "btn btn-white btn-primary btn-bold",
                autoPrint: false,
                exportOptions: {
                    // columns: ':visible'
                },
                customize: function (win) {
                    $(win.document.body).find('table').addClass('display').css('font-size', '9px');
                    // $(win.document.body).find('tr:nth-child(odd) td').each(function(index){
                    //     $(this).css('background-color','#D0D0D0');
                    // });
                    // $(win.document.body).find('h1').css('text-align','center');
                },
                title: 'Loan Report',
                message: 'Cutoff : '+$('#form-search').find('input[name="cutoff_month"]').val()+'-'+$('#form-search').find('select[name="cutoff_date"]').find('option:selected').text()
                }		  
            ]
        } );
        tableReport.buttons().container().appendTo( $('.tableTools-container') );

        
    }

    generateReport();
});
</script>
@endsection

