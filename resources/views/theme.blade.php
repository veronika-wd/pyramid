<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>@yield('title')</title>
</head>
<body>

<header
    class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
            <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
                <use xlink:href="#bootstrap"></use>
            </svg>
        </a>
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><h1 class="text-primary">Финансовая пирамида</h1></li>
    </ul>

    <div class="col-md-3 text-end">
        @auth
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
        @endauth
    </div>
</header>

<main class="container">
    @yield('content')
</main>


<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">
            <ya-tr-span data-index="1-0" data-translated="true" data-source-lang="en" data-target-lang="ru"
                        data-value="© 2025 Company, Inc" data-translation="© 2025 Company, Inc" data-ch="0"
                        data-type="trSpan" style="visibility: inherit !important;">© 2025 Company, Inc
            </ya-tr-span>
        </p>
        <a href="/"
           class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"
           aria-label="Загрузочный Стрэп">
            <svg class="bi me-2" width="40" height="32" aria-hidden="true">
                <use xlink:href="#bootstrap"></use>
            </svg>
        </a>
        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">
                    <ya-tr-span data-index="2-0" data-translated="true" data-source-lang="en" data-target-lang="ru"
                                data-value="Home" data-translation="Главная" data-ch="0" data-type="trSpan"
                                style="visibility: inherit !important;">Главная
                    </ya-tr-span>
                </a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">
                    <ya-tr-span data-index="2-0" data-translated="true" data-source-lang="en" data-target-lang="ru"
                                data-value="Pricing" data-translation="Цены" data-ch="0" data-type="trSpan"
                                style="visibility: inherit !important;">Цены
                    </ya-tr-span>
                </a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">
                    <ya-tr-span data-index="2-0" data-translated="true" data-source-lang="en" data-target-lang="ru"
                                data-value="FAQs" data-translation="Часто задаваемые вопросы" data-ch="0" data-type="trSpan"
                                style="visibility: inherit !important;">Часто задаваемые вопросы
                    </ya-tr-span>
                </a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">
                    <ya-tr-span data-index="2-0" data-translated="true" data-source-lang="en" data-target-lang="ru"
                                data-value="About" data-translation="О нас" data-ch="0" data-type="trSpan"
                                style="visibility: inherit !important;">О нас
                    </ya-tr-span>
                </a></li>
        </ul>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html>
