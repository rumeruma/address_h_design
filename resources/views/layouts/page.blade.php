<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="author" content="">
    <meta name="description" content="">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/faviconfinal.png') }}">

    <!-- Style Sheets -->
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/responsive_style.css') }}" type="text/css">

    <!-- Google Fonts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700,800%7CMontserrat:400,700'
          rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900" rel="stylesheet">

    <!-- Fucking CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('nasty-template') }}/css/rev-style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/edit.css') }}" rel="stylesheet">
    @yield('style')


</head>
<body>

@include('template-parts/nav')

@yield('content')

@include('template-parts/footer')
@include('template-parts/authpop')

<script type="text/javascript" src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/waypoints.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery_counterup.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery_custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/theme.js') }}"></script>
@include('template-parts/motherfucking-scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });
        $('.scrollup').click(function () {
            $("html, body").animate({scrollTop: 0}, 600);
            return false;
        });

        $("#{{Request::segment(1)}}").addClass('active');

        // $('.alert').alert()
    });
</script>
<script>
    $(document).ready(function () {
        $('#submitContact').on('click', function () {
            var name = $('#contact-nmae').val();
            var email = $('#contact-email').val();
            var message = $('#contact-message').val();
            $.ajax({
                method: "POST",
                url: "{{ route('home.contact') }}",
                data: {name: name, email: email, message: message},
                success: function (data) {
                    swal({
                        title: "Sending Request",
                        text: 'please wait',
                        timer: 5000,
                        onOpen: function () {
                            swal.showLoading()
                        }
                    }).then(function (result) {
                        if (result.dismiss === swal.DismissReason.timer) {

                        }

                        $('#contact-form-common').hide('slow');
                        $('#contact-form-success').show('slow').html('<strong>Your Message Has Been Sent</strong>, {{ config('app.name') }} will reply you soon.');
                    });
                },
                error: function (msg) {
                    var errorMsg = "";
                    if (msg.status === 422) {
                        $.each(msg.responseJSON, function (key, value) {
                            errorMsg += '<li class="text-danger">' + value + '</li>';
                        });
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            html: '<ol>' + errorMsg + '</ol>',
                        });
                    }
                }
            });
        });
    })
</script>
@yield('script')
</body>
</html>
