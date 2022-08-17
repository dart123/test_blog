<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="/css/app.css">

    <title>@yield('title')</title>
    <script>
        var current_user_id = {{ !empty(Auth::user()) ? Auth::user()->id : 0 }};
        var csrf_token = '{{ csrf_token() }}';
    </script>
</head>
