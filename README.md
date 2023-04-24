## Tecnologías

1. PHP 8
2. Laravel 9
3. Vue 3
3. Quasar
4. MySQL
5. Axios
6. Vite


## Requerimientos

1. Gestor de servidor local (XAMPP, Laragon, etc)
2. Composer
3. NodeJS


## Instalación

Clonar repositorio dentro de la carpeta necesaria de nuestro servidor local

```bash
git clone https://gitlab.com/josueaguilardev/google-keep-clone.git
```

Entramos en la carpeta ./backend y ejecutamos el comando

```bash
composer install
```

Entramos en la carpeta ./frontend y ejecutamos el comando

```bash
npm install
```

## Configuración

1. Entrar en la carpeta ./backend
1. Renombrar el archivo '.env.example' a '.env' y configurar las variables DB_DATABASE, DB_USERNAME, DB_PASSWORD en el .env 
2. Crear una base de datos con el nombre puesto en DB_DATABASE
3. Ejecutar el siguiente comando para las migraciones (estar dentro de ./backend)

```bash
php artisan migrate
```

## Visualizar

Abrir una ventana CMD en la carpeta ./backend y ejecutar el comando para levantar nuestro servidor de desarrollo

```bash
php artisan serve --port=3001
```

Abrir una ventana CMD en la carpeta ./frontend y ejecutar el comando para visualizar nuestra aplicación

```bash
quasar dev
```