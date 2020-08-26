
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

  
    <title>Inventory</title>
    <!-- Custom CSS -->
    <link href="{{ asset('inventory/assets/libs/flot/css/float-chart.css') }}" rel="stylesheet">

    @yield('per_page_css')
    <!-- Custom CSS -->
    <link href="{{ asset('inventory/dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('inventory/dist/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('inventory/assets/libs/toastr/toastr.css') }}" rel="stylesheet">


    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>