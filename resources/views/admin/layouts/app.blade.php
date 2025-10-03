<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- @yield('nome-da-seção-dinâmica'): informa que essa seção será dinâmica nas outras views -->
    <title> @yield('title') - Especializa TI</title>
</head>

<body>
    <header>header default</header>
    @yield('content')
    <footer>footer</footer>
</body>

</html>