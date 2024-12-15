# HexaTask

A continuación se presenta la documentación para la puesta en marcha, configuración y uso del proyecto desarrollado con Laravel, incluyendo la integración con MySQL, JWT, Sail y
Docker.

## Requisitos Previos

1. Docker: Asegúrese de tener instalado Docker en su entorno.
2. Docker Compose: Viene incluido con Docker Desktop en la mayoría de las instalaciones. De no ser así, instálelo desde Docker Compose.
3. Git (opcional): Para clonar el repositorio si no dispone de él localmente.
   Se asume que el código fuente del proyecto ya está descargado en su máquina local.

## Herramientas Utilizadas

1. MySQL: Base de datos relacional sobre la cual se almacena la información del proyecto.
2. JWT (JSON Web Tokens): Para la autenticación segura de usuarios.
3. Laravel Sail: Una interfaz por línea de comandos ligera para interactuar con el entorno Dockerizado de Laravel.
4. Docker: Para la contenedorización del entorno de desarrollo/producción.

## Estructura del Proyecto

La estructura estándar de Laravel incluye los siguientes directorios principales:

app/: Contiene el código fuente del proyecto (controladores, modelos, etc.)
database/: Contiene migraciones, seeders y factories.
routes/: Contiene los archivos de rutas (web.php, api.php).
config/: Archivos de configuración del framework y servicios.
composer.json y composer.lock: Archivos de dependencias de PHP.
docker-compose.yml: Archivo de configuración de los servicios Docker (app, base de datos, etc.).
sail (script): Para interactuar con el entorno Laravel Sail.

## Puesta en Marcha del Proyecto

1. Configuración de Variables de Entorno Asegúrese de contar con un archivo .env en la raíz del proyecto. Puede copiarlo desde .env.example:

```cmd
cp .env.example .env
Edite el archivo .env para ajustar credenciales de la base de datos, llaves JWT, etc. Por ejemplo, revise que las variables relacionadas a la base de datos coincidan con las del servicio MySQL definido en docker-compose.yml:
```

```cmd
env
Copy code
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=nombre_de_tu_bd
DB_USERNAME=nombre_de_usuario
DB_PASSWORD=contraseña
Nota: Las credenciales deben coincidir con las definidas en el docker-compose.yml.
```

##Además, genere una clave de aplicación para Laravel:

```cmd
Copy code
./vendor/bin/sail artisan key:generate
```

2. Levantar el Entorno con Docker
   El proyecto está configurado para arrancar con Laravel Sail. Para levantar el entorno:

````cmd
Copy code
./vendor/bin/sail up
```cmd

Esto levantará los contenedores definidos en docker-compose.yml:

Un contenedor de aplicación Laravel (PHP-FPM + Nginx)
Un contenedor de MySQL
El sitio web responderá por defecto en el puerto 80. Puede acceder al proyecto a través de http://localhost en su navegador. Si desea cambiar el puerto, puede modificarlo en el archivo docker-compose.yml antes de ejecutar sail up. Por ejemplo, si quiere usar el puerto 8080:

```cmd
yaml
Copy code
services:
  laravel.test:
    ports:
      - '8080:80'
````

Con este cambio, el proyecto estará disponible en http://localhost

Migraciones y Seeds
Una vez que el entorno esté en marcha, ejecute las migraciones para crear las tablas en la base de datos:

```cmd
./vendor/bin/sail artisan migrate
```

Autenticación con JWT

El proyecto implementa JWT para la autenticación. Asegúrese de generar una llave secreta JWT si no la tiene:

```cmd
./vendor/bin/sail artisan jwt:secret
```

Esta clave se escribirá en el archivo .env. Luego de esto, los endpoints protegidos requerirán un token JWT válido.

## Rutas Disponibles

```cmd
POST        api/login           Src\Customer\Infrastructure\Actions\LoginCustomerAction
DELETE      api/logout          Src\Customer\Infrastructure\Actions\LogoutCustomerAction
GET|HEAD    api/me              Src\Customer\Infrastructure\Actions\CustomerAction
POST        api/signup          Src\Customer\Infrastructure\Actions\RegisterCustomerAction
GET|HEAD    api/tasks           tasks.index › Src\Task\Infrastructure\Actions\TaskAction@index
POST        api/tasks           tasks.store › Src\Task\Infrastructure\Actions\TaskAction@store
GET|HEAD    api/tasks/{task}    tasks.show › Src\Task\Infrastructure\Actions\TaskAction@show
PUT|PATCH   api/tasks/{task}    tasks.update › Src\Task\Infrastructure\Actions\TaskAction@update
DELETE      api/tasks/{task}    tasks.destroy › Src\Task\Infrastructure\Actions\TaskAction@destroy
```

El proyecto cuenta con rutas para la gestión de autenticación y tareas (tasks).

Ejemplo de cURL para crear una tarea:

```cmd
curl -X POST \
  http://localhost/api/tasks \
  -H 'Content-Type: application/json' \
  -H 'Authorization: Bearer TU_TOKEN_JWT_AQUI' \
  -d '{
    "title": "Nueva tarea",
    "description": "Descripción de la tarea"
  }'
```

Este comando envía una petición POST para crear una nueva tarea, incluyendo un token JWT para la autorización y los datos de la tarea en formato JSON.

## Notas Adicionales

Todos los contenedores se configuran y manejan desde el archivo docker-compose.yml, donde se puede ajustar el mapeo de puertos, el nombre del servicio de base de datos, entre otros parámetros. Para detener los contenedores, use Ctrl + C en la terminal donde está corriendo sail up, o en otra terminal ejecute:

```cmd
./vendor/bin/sail down
```

Si realiza cambios en las migraciones o seeders, recuerde volver a ejecutar los comandos artisan migrate y artisan db:seed según corresponda.
