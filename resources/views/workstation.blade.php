<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>{{env('APP_ALIAS')}}</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{asset('ace-master')}}/css/bootstrap.min.css" />
		<link rel="stylesheet" href="{{asset('ace-master')}}/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="{{asset('ace-master')}}/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{asset('ace-master')}}/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="{{asset('ace-master')}}/css/ace-skins.min.css" />
		<link rel="stylesheet" href="{{asset('ace-master')}}/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="{{asset('ace-master')}}/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="{{asset('ace-master')}}/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="{{asset('ace-master')}}/js/html5shiv.min.js"></script>
		<script src="{{asset('ace-master')}}/js/respond.min.js"></script>
        <![endif]-->
	</head>

	<body class="no-skin">
  <div class="main-content">
				<div class="main-content-inner">
					

					<div class="page-content">
						

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="error-container">
									<div class="well">
										<h1 class="grey lighter smaller">
											<span class="blue bigger-125">
												<i class="ace-icon fa fa-exclamation-circle"></i>
												401
											</span>
											Unauthorize Workstation
										</h1>

										<hr />
										<h3 class="lighter smaller">
											Your workstation code is <b>{{$workstation_name}}</b>
										</h3>

										<div class="space"></div>

										<div>

											<h4 class="lighter smaller">
                        @if($workstation->allowed==0)
                          Please contact your administrator to allow your workstation
                        @else
                          No workstation branch is set
                        @endif
                      </h4>
										</div>

										<hr />
										<div class="space"></div>

										<div class="center">
											<a href="#" class="btn btn-primary">
												<i class="ace-icon fa fa-check"></i>
												Allow by administrator
											</a>
										</div>
									</div>
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

      <!--[if !IE]> -->
		<script src="{{asset('ace-master')}}/js/jquery-2.1.4.min.js"></script>

		

    <!-- <![endif]-->

    <!--[if IE]>
    <script src="assets/js/jquery-1.11.3.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='{{asset('ace-master')}}/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    <script src="{{asset('ace-master')}}/js/bootstrap.min.js"></script>

    <!-- page specific plugin scripts -->

    <!-- ace scripts -->
    <script src="{{asset('ace-master')}}/js/ace-elements.min.js"></script>
    <script src="{{asset('ace-master')}}/js/ace.min.js"></script>

      <!-- inline scripts related to this page -->
  </body>
</html>
