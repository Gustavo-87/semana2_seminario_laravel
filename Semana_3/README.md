# Task Manager en Laravel

Proyecto desarrollado en Laravel y MySQL para la gestión básica de tareas, categorías y usuarios.

## Objetivo

Implementar una aplicación web que permita registrar, listar y consultar tareas, asociándolas con una categoría, un usuario responsable, un estado y una fecha límite.

## Tecnologías utilizadas

- Laravel
- PHP
- MySQL
- Laravel Sail
- Docker
- Blade
- Git
- GitHub

## Funcionalidades desarrolladas

- Creación del proyecto Laravel.
- Configuración del entorno con Laravel Sail.
- Creación de migraciones para tareas y categorías.
- Relación de tareas con categorías.
- Relación de tareas con usuarios.
- Creación de modelos `Task`, `Category` y `User`.
- Creación de factories y seeders.
- Creación del controlador `TaskController`.
- Creación de vistas Blade para listar y crear tareas.
- Configuración de rutas en `web.php`.
- Validación del guardado de tareas en base de datos.
- Subida del proyecto a GitHub en la rama `task-manager`.

## Estructura principal

```text
app/Models/Task.php
app/Models/Category.php
app/Http/Controllers/TaskController.php
database/migrations/
database/factories/
database/seeders/
resources/views/tareas/
routes/web.php
Comandos utilizados

Ejecutar migraciones:

sail php artisan migrate

Reiniciar la base de datos y ejecutar seeders:

sail php artisan migrate:fresh --seed

Abrir Tinker:

sail php artisan tinker

Consultar tareas desde Tinker:

\App\Models\Task::latest('id')->take(5)->get();
Problema identificado

Durante las pruebas, algunas tareas aparecían en la vista con el texto:

Sin categoría

Se verificó desde Tinker que las tareas sí estaban guardando el campo category_id, por lo cual el problema no estaba en el guardado, sino en la forma de mostrar la relación en la vista.

También se identificó que la columna del título en la tabla tasks se llama titulo, no title.

Gestión con GitHub

El proyecto fue subido al repositorio:

https://github.com/Gustavo-87/semana2_seminario_laravel

En la rama:

task-manager

Para revisar este proyecto, se debe cambiar la rama de main a task-manager.

Estado actual

El sistema permite visualizar un listado de tareas con:

ID
Título
Estado
Categoría
Usuario
Fecha límite
