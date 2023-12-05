<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
 

        <title>Laravel</title>

      
        <!-- Styles -->
        @vite('resources/css/app.css')
    </head>


    <body >
 
     <!-- Contenu de votre application -->
             <div id="app">
               
             <example-component></example-component>
            </div>

            @vite('resources/js/app.js')
    </body>
</html>
