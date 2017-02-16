<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>TubeLara</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="login-status" content="{{ Auth::check() }}">

    @if (Auth::user() != null)
        <meta name="api_token" content="{{ Auth::user()->apiKey->key }}">
        <meta name="user" content="{{ Auth::user()}}">
    @endif

</head>
<body>
<app></app>
</body>
</html>