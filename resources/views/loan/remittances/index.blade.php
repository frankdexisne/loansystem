@extends('layouts.ace_master')

@section('styles')
<style>
.error-provider{
    color: red;
}
.hide-error{
    display:none;
}
<link rel="stylesheet" href="{{asset('/')}}/css/select2.min.css" />
</style>
@endsection

@section('content-header')
<ul class="breadcrumb">
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="{{url('/home')}}">Home</a>
    </li>
    <li class="active">Remittances</li>
</ul>

@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <!-- <h3 class="header smaller lighter blue">List of Areas</h3> -->

        <div class="clearfix">
            <div class="tableTools-container">
                <form action="" class="form-inline">
                    <div class="form-group">
                        <label for="">Transaction date: </label>
                        <input type="date" class="form-control" name="remit_date" value="{{date('Y-m-d')}}">
                    </div>
                    <div class="form-group">
                        <label for="">Area</label>
                        <select name="area_id" class="form-control">
                            @foreach($areas as $area)
                                <option value="{{$area->id}}">AREA {{$area->name}} {{$area->for_daily_areas==1 ? ' (daily)' : ' (weekly)'}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-sm" type="submit">Load Data</button>
                    </div>
                </form>
                
            </div>
        </div>
        <div class="table-header">
            Remittances
        </div>

        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->
        <div>
            <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>OR</th>
                        <th>Amount</th>
                        <th>PS</th>
                        <th>CBU</th>
                        <th>Penalty</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                    <select name="loan_id" id="" class="form-control select2" style="width:100%">

                                    </select>
                                </div>                        
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    <button id="reload-active-clients" class="dt-button btn btn-white btn-primary btn-bold"><i class="fa fa-refresh"></i></button>
                                </div>
                            </div>
                            
                            
                        </th>
                        <th>
                            <input type="text" class="form-control" name="orno" style="width:100%">
                        </th>
                        <th>
                            <input type="number" class="form-control" id="amount" name="amount" min="0" style="width:100%">
                        </th>
                        <th>
                            <input type="number" class="form-control" name="ps" min="0" style="width:100%">
                        </th>
                        <th>
                            <input type="number" class="form-control" name="cbu" min="0" style="width:100%">
                        </th>
                        <th>
                            <input type="number" class="form-control" name="penalty" min="0" style="width:100%">
                        </th>
                        <th>
                            <button id="submit-payment" class="btn btn-primary btn-success btn-sm">
                                <i class="ace-icon fa fa-save bigger-130"></i> <span>POST</span>
                            </button>
                        </th>
                    </tr>
                </thead>

                <tfoot>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tfoot>
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
<script src="{{asset('/ace-master')}}/js/select2.min.js"></script>
<script src="{{asset('/js/sweetalert2.js')}}"></script>
<script src="{{asset('/js/references.js')}}"></script>
<script>
    $(document).ready(function(){
        
        $('.select2').css('width','100%').select2({allowClear:true})
        $('#select2-multiple-style .btn').on('click', function(e){
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('.select2').addClass('tag-input-style');
                else $('.select2').removeClass('tag-input-style');
        });

        $temp = null;
        $colIndex = 2;
        $disable_form_search = 1;

        var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'PHP',
        });
        $element = '#datatable';
        ajaxUrl = "{{url('/remittances/json-payments')}}";
        ajaxType = "GET";
        ajaxData = {
            payment_date : $('form').find('input[name="remit_date"]').val(),
            area_id : $('form').find('select[name="area_id"]').val()
        };
        _columns = [
            {data : 'loan.client',render(data){
                return data['lname']+', '+data['fname']+' '+data['mname'];
            }},
            {data : 'orno'},
            {data : 'amount', render : $.fn.dataTable.render.number( ',', '.', 2, '&#8369; ' )},
            {data : 'ps.amount', render : $.fn.dataTable.render.number( ',', '.', 2, '&#8369; ' )},
            {data : 'cbu.amount', render : $.fn.dataTable.render.number( ',', '.', 2, '&#8369; ' )},
            {data : 'penalty', render : $.fn.dataTable.render.number( ',', '.', 2, '&#8369; ' )},
            {data : null, render(data,type){
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

        $('#reload-active-clients').on('click',function(e){
            e.preventDefault();
            $('select[name="loan_id"]').html('');
            $.ajax({
                url: "{{url('loans-json')}}",
                type: "GET",
                dataType: 'JSON',
                data: {
                    status: 'RELEASED',
                    area_id : $('select[name="area_id"]').val()
                },
                success: function(result){
                    $data = result.data;
                    $.each($data, function() {
                        $('select[name="loan_id"]').append($("<option data-client_id='"+this.client_id+"' />").val(this['id']).text(this['client']['full_name']));
                    });
                    
                }
            })
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
                processing: true,
                language: {
                    loadingRecords: '&nbsp;',
                    processing: '<div class="spinner"><i class="fa fa-spinner"></i> Please wait</div>'
                },
                ordering: false,
                columnDefs: [
                    {width: '30%', targets: [0]},
                    {width: '11%', targets: [1,2,3,4,5]},
                    {width: '5%', targets: [6]},
                ],
                columns: _columns,
                initComplete: function(setting,json){
                    $total_amount =0;
                    $total_ps =0;
                    $total_cbu =0;
                    $total_penalty=0;
                    $.each(json.data,function(){
                        $total_amount +=this.amount;
                        $total_ps =this.ps.amount;
                        $total_cbu =this.cbu.amount;
                        $total_penalty=this.penalty;
                    });

                    $th = $($element).find('tfoot').find('tr').eq(0).find('th');
                    $th.eq(2).html(formatter.format($total_amount).replace('PHP','&#8369;'));
                    $th.eq(3).html(formatter.format($total_ps).replace('PHP','&#8369;'));
                    $th.eq(4).html(formatter.format($total_cbu).replace('PHP','&#8369;'));
                    $th.eq(5).html(formatter.format($total_penalty).replace('PHP','&#8369;'));
                    $('#reload-active-clients').click();
                    
                    
                }
            })

            $('#submit-payment').click(function(){
                $tr=$(this).closest('tr');
                $.ajax({
                    url: "{{route('payments.store')}}",
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        loan_id : $tr.find('select[name="loan_id"]').val(),
                        loan_client_id : $tr.find('select[name="loan_id"]').find('option:selected').data('client_id'),
                        payment_date : $('input[name="remit_date"]').val(),
                        orno : $tr.find('input[name="orno"]').val(),
                        amount : $tr.find('input[name="amount"]').val(),
                        ps : $tr.find('input[name="ps"]').val(),
                        cbu : $tr.find('input[name="cbu"]').val(),
                        penalty : $tr.find('input[name="penalty"]').val()
                    },
                    success: function(res){
                        console.log(res);
                    },
                    error: function(xhr){

                    }
                })
            });

            $('form#form').submit(function(e){
                e.preventDefault();
                $form = $(this);
                var form_data = {
                    _token : $('meta[name="csrf-token"]').attr('content'),
                    no_of_months : $form.find('input[name="no_of_months"]').val(),
                    is_daily : $form.find('input[name="is_daily"]').is(':checked') ? 1 : 0
                };
                $.ajax({
                    url: "{{route('terms.store')}}",
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

            dataTable.on('click','a.edit',function(e){
                $tr=$(this).closest('tr');
                $temp = dataTable.row($tr).data();
                $td = $tr.find('td');
                // CHANGE COLUMN TO INPUT
                $td.eq(0).html('<input type="text" class="form-input" style="width:100%" value="'+$temp['no_of_months']+'"><span class="hidden red error-no_of_months"></div>');
                $td.eq(1).html('<input type="checkbox" class="form-input" "'+($temp['daily_only']==1 ? 'checked="checked"' : '')+'"></div>');

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
                    no_of_months : $td.eq(0).find('.form-input').val()
                };
                $.ajax({
                    url: "{{url('terms')}}/"+$temp['id'],
                    type: "PUT",
                    data: form_data,
                    success: function(result){
                        // ASSIGN NEW VALUES
                        $temp['name']=$td.eq(0).find('.form-input').val();
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
                            url: "{{url('/terms')}}/"+data['id'],
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

        $('form').on('submit',function(e){
            e.preventDefault();
            ajaxData = {
                payment_date : $('form').find('input[type="date"]').val(),
                area_id : $('form').find('select').val()
            };
            generateTable($element,ajaxUrl,ajaxType,ajaxData,_columns);
        });

        if($disable_form_search==1){
            $('#nav-search').remove();
        }


    });
</script>
@endsection