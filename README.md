<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

- He creado un Job para hacer la llamada a la API de Twitter e informar la BD en otro hilo y que no bloquee el principal.
- Este Job está encolado en un kernel task y lo lanzo cada minuto (pruebas en dev)

1. Levantamos Laravel: php artisan serve
2. Levantamos vite: npm run dev
3. Poner a la escucha un worker: php artisan queue:work
4. Validamos que tememos la tarea en el Scheduler:  php artisan schedule:list 
"* * * * *  App\Jobs\MakeTwitterApiRequest ......................................................................................................."
4. Arrancar el Scheduler desde crontab o manual para probar con artisan: php artisan schedule:run 
