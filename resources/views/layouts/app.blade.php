
<!DOCTYPE html>
<html lang="en" ng-app="convercity">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Conver.City">
    <link rel="icon" href="/favicon.ico">

    <title>Conver.City - {{$page['name'] or 'Talk to the people'}}</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/jquery-ui.css" />

    @yield('style')

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <script src="/js/angular.min.js"></script>
    <script src="/js/app/app.js"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('js-head')
    
</head>

<body>


@include('layouts._navheader')

@include('layouts._navpanel')

@yield('model')

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/js/jquery-2.1.0.min.js"></script>
<script src="/js/jquery-ui.js"></script>
<script src="/js/bootstrap.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> -->

@yield('js-foot')

</body>
</html>
