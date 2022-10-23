<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<h1 align="center">DevoraTweet</h1>
<p align="center"> Aplicación que recupera los 100 útimos tweets con el hasta #farina </p>

- He creado un Job para hacer la llamada a la API de Twitter e informar la BD en otro hilo y que no bloquee el principal.<br>
- Este Job está encolado en un kernel task y lo lanzo cada minuto (pruebas en dev)<br>

1. Levantamos Laravel: php artisan serve<br>
2. Levantamos vite: npm run dev<br>
3. Poner a la escucha un worker: php artisan queue:work<br>
4. Validamos que tememos la tarea en el Scheduler:  php artisan schedule:list <br>
"* * * * *  App\Jobs\MakeTwitterApiRequest ......................................................................................................."<br>
4. Arrancar el Scheduler desde crontab o manual para probar con artisan: php artisan schedule:run 
