<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="manifest" href="manifest.json" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
        @media print {
    body * {
      visibility: hidden;
    }
    #jj, #jj * {
      visibility: visible;
    }
    #nav,#navbar{
        visibility: hidden;
    }
    #jj {
      position: absolute;
      left: 0;
      top: 0;
    }
  }

        </style>
    </head>
    <body>
        <div id="app">
            <app></app>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
