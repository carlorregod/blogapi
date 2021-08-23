# Laravel api + oauth2 - ejercicio

### Uso
* Laravel 8
* Laravel passport
* 

### Instrucciones
1) composer install
2) Cree su archivo .env y en el apartado de database, elegir motor sqlite2. ya viene pre-configurado para aceptar redis, si se usa. la idea es que quede de esta manera (si no existe la opción, favor generarlas)

> DB_CONNECTION=sqlite2 
> 
> FILESYSTEM_DRIVER=public
>

3) php artisan passport:keys

Si desea rehacer la database puede hacer la siguiente migración

4) php artisan migrate
5) php artisan passport:install --uuids
6) php artisan migrate:fresh --seed 
7) php artisan passport:install --uuids

Este último comando hará que se refresquen las migraciones. Estos comandos siguientes son obligatorios

8) php artisan key:generate
9) php artisan config:cache

### Datos para probar 
* Creando un cliente
> php artisan passport:client --password
Password grant client created successfully.
Client ID: 9431b7a2-1c88-4c81-983a-46104215441e
Client secret: 8OSA4ULJgrAWjI0YgBJNSuXUndt6kszhkfYhSqCd



