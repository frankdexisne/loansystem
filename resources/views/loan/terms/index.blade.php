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
        <a>System Libraries</a>
    </li>
    <li class="active">Terms</li>
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
            List Registered Terms
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
                <h4 class="blue bigger">Create New</h4>
            </div>

            <div class="modal-body">
                <form id="form">
                    <div class="form-group">
                        <label for="">Number of Months/Days</label>
                        <input type="number" class="form-control" name="no_of_months" required>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="is_daily"> For daily terms
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
        ajaxUrl = "{{url('terms-json')}}";
        ajaxType = "GET";
        ajaxData = {};
        _columns = [
            {data : 'no_of_months', title : 'Term'},
            {data : 'daily_only', title : 'Is daily',render(data){
                
                return '<i class="'+(data==1 ? 'green' : 'red')+' fa fa-'+(data==1 ? 'check' : 'times')+'"></i>';
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
                    "text": "<i class='fa fa-plus bigger-110 blue'></i> <span class=''>Add New</span>",
                    "className": "btn btn-white btn-primary btn-bold btn-add",
                    }		  
                ]
            } );

            dataTable.buttons().container().appendTo( $('.tableTools-container') );

            $('.btn-add').click(function(){
                $('#modal-form').modal('show');
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