<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            :root {
                --font-sans: 'Figtree', sans-serif;
            }

            body {
                font-family: var(--font-sans);
                line-height: 1.5;
                background-color: #f0f0f0;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .container {
                text-align: center;
                background: white;
                padding: 2rem;
                border-radius: 0.5rem;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }

            .title {
                font-size: 2rem;
                margin-bottom: 1rem;
            }

            .links > a {
                margin: 0 10px;
                color: #6366f1;
                text-decoration: none;
                font-weight: 600;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="title">
                Welcome to Laravel
            </div>

            @if (Route::has('login'))
                <div class="links">
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </body>
</html>
