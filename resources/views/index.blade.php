<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>G-Mart</title>
	<meta name="description" content="G-Mart Dashboard by Karyanto" />
	<meta name="keywords" content="gmart, dashboard, karyanto" />
	<meta name="author" content="karyanto"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
	
	<!-- Data table CSS -->
	<link href="{{ asset('dist/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
	
	<!-- Toast CSS -->
	<link href="{{ asset('dist/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet" type="text/css">
	
	<!-- Morris Charts CSS -->
    <link href="{{ asset('dist/vendors/bower_components/morris.js/morris.css') }}" rel="stylesheet" type="text/css"/>

    <!-- select2 CSS -->
	<link href="{{ asset('dist/vendors/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>

	<!-- Bootstrap Dropify CSS -->
	<link href="{{ asset('dist/vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>
	
	<!-- Chartist CSS -->
	<link href="{{ asset('dist/vendors/bower_components/chartist/dist/chartist.min.css') }}" rel="stylesheet" type="text/css"/>
	
	
	<!-- vector map CSS -->
	<link href="{{ asset('dist/vendors/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" type="text/css"/>
	
	<!-- Custom CSS -->
	<link href="{{ asset('dist/css/style.css') }}" rel="stylesheet" type="text/css">
</head>

<body>

	<div id="dw">
        <app></app>
    </div>

	<!-- JavaScript -->
	
    <!-- jQuery -->
    <script src="{{ asset('dist/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('dist/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    
	<!-- Data table JavaScript -->
	<script src="{{ asset('dist/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('dist/vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('dist/vendors/bower_components/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
	<script src="{{ asset('dist/vendors/bower_components/jszip/dist/jszip.min.js') }}"></script>
	<script src="{{ asset('dist/vendors/bower_components/pdfmake/build/pdfmake.min.js') }}"></script>
	<script src="{{ asset('dist/vendors/bower_components/pdfmake/build/vfs_fonts.js') }}"></script>
	
	<script src="{{ asset('dist/vendors/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('dist/vendors/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>
	
	<!-- Progressbar Animation JavaScript -->
	<script src="{{ asset('dist/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js') }}"></script>
	<script src="{{ asset('dist/vendors/bower_components/jquery.counterup/jquery.counterup.min.js') }}"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="{{ asset('dist/js/dropdown-bootstrap-extended.js') }}"></script>
	
	<!-- Sparkline JavaScript -->
	<script src="{{ asset('dist/vendors/jquery.sparkline/dist/jquery.sparkline.min.js') }}"></script>
	
	<!-- Owl JavaScript -->
	<script src="{{ asset('dist/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>
	
	<!-- Switchery JavaScript -->
	<script src="{{ asset('dist/vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>
	
	<!-- Vector Maps JavaScript -->
    <script src="{{ asset('dist/vendors/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
	<script src="{{ asset('dist/vendors/vectormap/jquery-jvectormap-us-aea-en.js') }}"></script>
    <script src="{{ asset('dist/vendors/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
	<script src="{{ asset('dist/js/vectormap-data.js') }}"></script>
	
	<!-- Toast JavaScript -->
	<script src="{{ asset('dist/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
	
	<!-- Piety JavaScript -->
	<script src="{{ asset('dist/vendors/bower_components/peity/jquery.peity.min.js') }}"></script>
	<script src="{{ asset('dist/js/peity-data.js') }}"></script>
	
	<!-- Chartist JavaScript -->
	<script src="{{ asset('dist/vendors/bower_components/chartist/dist/chartist.min.js') }}"></script>

	<!-- Bootstrap Daterangepicker JavaScript -->
	<script src="{{ asset('dist/vendors/bower_components/dropify/dist/js/dropify.min.js') }}"></script>

	<!-- Select2 JavaScript -->
	<script src="{{ asset('dist/vendors/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
	
	<!-- Morris Charts JavaScript -->
    <script src="{{ asset('dist/vendors/bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('dist/vendors/bower_components/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('dist/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
	
	<!-- ChartJS JavaScript -->
	<script src="{{ asset('dist/vendors/chart.js/Chart.min.js') }}"></script>
	
	<!-- Init JavaScript -->
	<script src="{{ asset('dist/js/init.js') }}"></script>
	<script src="{{ asset('dist/js/dashboard-data.js') }}"></script>
	<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
