<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Calvin') }}</title> --}}
    <title>Calvin</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
</body>
<script src="{{ asset('front/js/jquery-3.5.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script>
    $('#terms-and-condition-check-modal').click((e) => {
        e.preventDefault();
        $('#terms-and-condition-modal').modal('show');


        // $('#registerForm').submit();
    });

    $("#registerButton").click((e) => {
        let confirmTerms = $("#termsAndConditionAccept").is(':checked');
        if (confirmTerms) {
            $('#registerForm').submit();
        } else {
            $("#terms-and-condition-error").css({
                'display' : 'block'
            })
            $("#terms-and-condition-error-message").html("Accept our terms and conditions.")
            return false;
        }
    })
    // let confirm = $('#terms-and-condition-modal').is(':visible');

    //     if (!confirm) {
    //         $('#terms-and-condition-modal').modal('show');
    //     }else{
    //     let confirmTerms = $("#termsAndConditionAccept").val();

    //     }
</script>

</html>
