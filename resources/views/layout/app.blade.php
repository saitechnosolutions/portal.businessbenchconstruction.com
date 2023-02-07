<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>

    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/introjs.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/cdcced96ff.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="preloader">
        <img src="/assets/images/preloader.gif" class="img-fluid">
    </div>
    @include('layout.navbar')
    @include('layout.breadcrumb')

    @section('main-content')

    @show



    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="/assets/js/slick.min.js"></script>
    <script src="/assets/js/bootstrap_js/bootstrap.min.js"></script>
    <script src="/assets/js/aos.js"></script>


    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="/assets/js/script.js" type="text/javascript"></script>
    <script src="/assets/js/formvalidation.js" type="text/javascript"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script> --}}

    {{-- <script src="/assets/js/createArea.js"></script>
    <script src="/assets/js/createZone.js"></script>
    <script src="/assets/js/designation.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/intro.min.js"></script>

    <script>
        // Intro JS

        introJs().start();
        // introJs().setOption("dontShowAgain", true).start();
    </script>
    <script src="/assets/js/just_validate/validate.js"></script>
    @isset($areas)
    <script src="/assets/js/createArea.js"></script>
@endisset
@isset($zones)
    <script src="/assets/js/createZone.js"></script>
@endisset
@isset($designations)
    <script src="/assets/js/designation.js"></script>
@endisset

</body>

</html>
<!-- Modal -->
