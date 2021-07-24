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
    <li class="active">Report Generation</li>
</ul>

@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">

        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Report Generation
        </div>

        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->
        <div>
            <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                    <th>Report Name</th>
                    <th></th>
                </thead>
                <tbody>
                    <tr>
                        <td>Collection Report</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sales Report</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Loan Report</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Withdrawal Report</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Expenses Report</td>
                        <td></td>
                    </tr>
                </tbody>
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

</script>
@endsection