
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

@include('backend.inc.style')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('backend.inc.slider')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

        @include('backend.inc.main-content-wrapper')

        @include('backend.inc.footer')

        </div>
        <!-- End of Content Wrapper -->


    </div>

@yield('content')

    <!-- End of Page Wrapper -->

        @include('backend.inc.scroll')

        @include('backend.inc.logout')

        @include('backend.inc.script')

</body>

</html>
