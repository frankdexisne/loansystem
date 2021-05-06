
<!DOCTYPE html>
<html lang="en">
	
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Loan System | Workstation </title>

    <!-- Bootstrap -->
    <link href="{{asset('/gentelella/workstation')}}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('/gentelella/workstation')}}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('/gentelella/workstation')}}/css/custom.css" rel="stylesheet">
	
	<script type="text/javascript" src="{{asset('/gentelella/workstation')}}/loader/js/jquery.min.js"></script>
	<script type="text/javascript" language="javascript">
		
	</script> 	
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
                @if($workstation->branch_id==null && $workstation->allowed==1)
                    <div class="text-center text-center">
                        <h2>No branch assigned to this worksation.</h2>
                        <h1>
                        {{$code_generated}}
                        </h1>
                        
                        <p>Please contact admin to solve this issue.
                        </p>
                    </div>					
				@else
                    <div class="text-center text-center">
                        <h2>Sorry but this worksation is not allowed to access our system.</h2>
                        <h1>
                        {{$code_generated}}
                        </h1>
                        <p>A system generate <b>WORKSATION ID</b> has been generated.<br>Please inform our administrator to allow this computer.
                        </p>
                    </div>					
				@endif

          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('/gentelella/workstation')}}/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{asset('/gentelella/workstation')}}/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="{{asset('/gentelella/workstation')}}/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{asset('/gentelella/workstation')}}/vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{asset('/gentelella/workstation')}}/js/custom.js"></script>
  </body>
</html>
