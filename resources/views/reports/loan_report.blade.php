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
    <li class="active">Sales Report</li>
</ul>

<div class="nav-search" id="nav-search">
    <form id="form-search" class="form-inline">
        <div class="form-group">
            <label for="">Area</label>
            <select name="area_id" class="form-control">
                
            </select>
        </div>
        <div class="form-group">
            <label for="">Date Range: </label>
            <input type="date" class="form-control" name="start_date" value="{{date('Y-m-d')}}" required>
        </div>
        <div class="form-group">
            <label for=""> - </label>
            <input type="date" class="form-control" name="end_date" value="{{date('Y-m-d')}}" required>
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
<script src="{{asset('/ace-master')}}/js/dataTables.rowGroup.min.js"></script>
<script src="{{asset('/ace-master')}}/js/dataTables.checkboxes.min.js"></script>
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

    $start_date = $('#form-search').find('input[name="start_date"]');
    $end_date = $('#form-search').find('input[name="end_date"]');
    $area_id = $('#form-search').find('select[name="area_id"]');

    $start_date.on('change',function(e){
        e.preventDefault();
        $this = $(this);
        if($start_date.val()>$end_date.val()){
            $end_date.val($start_date.val());
        }
    })

    $end_date.on('change',function(e){
        e.preventDefault();
        $this = $(this);
        if($end_date.val()<$start_date.val()){
            $start_date.val($end_date.val());
        }
    })

    function generateReport(){
        if($.fn.DataTable.isDataTable('#table-report')){
            $('#table-report').DataTable().destroy();    
        }
        var tableReport = $('#table-report').DataTable({
            ajax: {
                url: "{{route('reports.sr-json')}}",
                type: "GET",
                data: {
                    start_date : $start_date.val(),
                    end_date : $end_date.val(),
                    area_id : $area_id.val()
                }
            },
            processing: true,
            language: {
                infoFiltered:"",
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
            },
            columns: [
                {data: null,render(data,type){
                    return '';
                }},
                {data: 'client.full_name'},
                {data: 'loan_amount_formatted'},
                {data: 'balance_formatted'},
                {data: null,render(data,type){
                    return parseFloat(data['loan_amount']) * (parseFloat(data['interest'])/100);
                }},
                {data: 'deduction_formatted'},
                {data: null,render(data,type){
                    return data['byout'].length > 0 ? data['total_byout_formatted'] : null;
                }},
                {data: null,render(data,type){
                    return parseFloat(data['loan_amount'])-parseFloat(data['deduction_formatted'].replace(',',''));
                }}
            ],
            // rowGroup: {
            //     dataSrc: 'payment_date',
            //     startRender: function ( rows, group ) {
            //         var groupName = 'group-' + group.replace(/[^A-Za-z0-9]/g, '');
            //         var rowNodes = rows.nodes();
            //         rowNodes.to$().addClass(groupName);
                    
            //         // Get selected checkboxes
            //         // var checkboxesSelected = $('.dt-checkboxes:checked', rowNodes);
                    
            //         // // Parent checkbox is selected when all child checkboxes are selected
            //         // var isSelected = (checkboxesSelected.length == rowNodes.length);
                    
            //         // var collapsed = !!collapsedGroups[group];
            //         // rows.nodes().each(function(r) {
            //         // r.style.display = 'none';
            //         // if (collapsed) {
            //         //     r.style.display = '';
            //         // }
            //         // });

            //         // return '<label><input type="checkbox" class="group-checkbox" data-group-name="' 
            //         //     + groupName + '"' + (isSelected ? ' checked' : '') +'> ' + group + ' (' + rows.count() + ' waybills)</label>';
            //         return $('<tr/>')
            //             .append('<td colspan="8"><a href="#">' + group + ' (' + rows.count() + ' payments)</a></td>')
            //             .attr('data-name', group);
            //             // .toggleClass('collapsed', collapsed);
            //     }
            // },
            initComplete: function(datatable,ajax){
                if(tableReport.data().length>0){
                    $('#table-report').find('tfoot').removeAttr('style');
                }else{
                    $('#table-report').find('tfoot').attr('style','display:none;');
                }
            }
        });

        $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
        function formatDate(dateString){
            var d = dateString.split("-");
            return d[1]+'/'+d[2]+'/'+d[0]; 
        }
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
                orientation: 'landscape',
                pageSize: 'LEGAL',
                autoPrint: true,
                exportOptions: {
                    // columns: ':visible'
                },
                customize: function (win) {
                    var image_path = "{{asset(env('APP_LOGO'))}}";
                    var start = formatDate($start_date.val());
                    var end = formatDate($end_date.val());
                    $(win.document.body).css('font-size','10pt')
                                        .prepend('<img src="'+image_path+'" style="width:70px; height:70px;"><h2 style="position:absolute; top:0; left:80px;">Sales Report</h2><font style="font-size:10px;position:absolute;top:50px;left:80px;">Date : '+start+' - '+end+'</font>');
                                                            
                    $(win.document.body).find('table').addClass('display').css('font-size', '9px');
                    $(win.document.body).find('tr:nth-child(odd) td').each(function(index){
                        $(this).css('background-color','#D0D0D0');
                    });
                    $(win.document.body).append('<br><br><br><br><br><table width="100%">'+
                                                    '<tr>'+
                                                        '<td width="5%"></td>'+
                                                        '<td width="35%" align="center" style="border-top: 1px solid #000;">Collector</td>'+
                                                        '<td width="20%"></td>'+
                                                        '<td width="35%" align="center" style="border-top: 1px solid #000;">Cashier</td>'+
                                                        '<td width="5%"></td>'+
                                                    '</tr>'+
                                                '</table>'
                                                )
                    // $(win.document.body).find('h1').css('text-align','center');
                },
                title: ''
                }		  
            ]
        } );
        tableReport.buttons().container().appendTo( $('.tableTools-container') );

        
    }

    generateReport();
});
</script>
@endsection

