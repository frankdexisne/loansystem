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
                List
            </h4>
            <span class="widget-toolbar">
                <!-- <a href="#" id="open-wizard">
                    <i class="ace-icon fa fa-plus"></i> Apply loan
                </a> -->
                <form action="" class="form-inline">
                    <div class="form-group">
                        <label for="">Payment date : </label>
                        <input type="date" class="form-control" name="payment_date" value="{{date('Y-m-d')}}">
                    </div>
                </form>
                
            </span>
        </div>

        <div class="widget-body">
            <div class="widget-main">
            <!-- <form action="" id="search">
                <div class="form-group">
                    
                    <select name="area" id="area" class="form-control">

                    </select>
                </div>
            </form> -->
            <table class="table table-bordered" id="table-loan" width="100%">
                <thead>                  
                <tr>
                    
                    <th>Name</th>
                    <!-- <th>Details</th>
                    <th>OR #</th>
                    <th>Amount</th>
                    <th>PS</th>
                    <th>CBU</th>
                    <th></th> -->
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

    function tableLoans(){
        var table_loan = $('#table-loan').DataTable({
            ajax: "{{url('loans-json')}}",
            columns: [
                {data : 'lname'}
            ]
        });
    }

    tableLoans();
    

});
</script>
@endsection