<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <meta name="robots" content="noindex" /> --}}
        <!-- CSRF Stuff -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

        <title>Contest</title>
        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,900&amp;subset=latin-ext" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
    <script>
    window.addEventListener("load", function(){
    window.cookieconsent.initialise({
      "palette": {
        "popup": {
          "background": "#ffffff",
          "text": "#df1780"
        },
        "button": {
          "background": "#df1780",
          "text": "#ffffff"
        }
      },
      "showLink": false,
      "theme": "classic",
      "content": {
        "message": "Niniejsza strona internetowa wykorzystuje pliki cookies w celu zapewnienia prawidłowego funkcjonowania Serwisu, prowadzenia odpowiednich statystyk, a także zapamiętywania preferencji i personalizowania strony w zakresie wyświetlanych treści. Poprzez zmianę ustawień w przeglądarce internetowej można wyrazić zgodę na zapisywanie plików cookies lub je zablokować. Kontynuując przeglądanie tej strony internetowej bez zmiany ustawień plików cookies w Twoim urządzeniu, wyrażasz zgodę na ich zapisywanie. <a href='/assets/downloads/polityka_prywatnosci.pdf' target='_blank'>Dowiedz się więcej o plikach cookies</a>.",
        "dismiss": "OK"
      }
    })});
    </script>
    </head>
    <body>
        <div id="app">
            <transition name="fade" mode="out-in">
                <router-view></router-view>
            </transition>

        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
