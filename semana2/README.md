# Semana 2 - Instalación de Laravel

En esta actividad se realizó la instalación y verificación inicial de un proyecto Laravel.

El objetivo fue comprobar que el entorno de trabajo estuviera correctamente configurado con PHP, Composer y Laravel, además de validar que el proyecto cargara correctamente en el navegador.

## 1. Verificación de PHP y Composer

Se ejecutaron los siguientes comandos en la terminal:

```bash
php -v
composer --version
```

Con estos comandos se comprobó que PHP y Composer están instalados correctamente.

![Captura 1 - PHP y Composer](evidencia_php_composer.png)

## 2. Estructura del proyecto Laravel

Se revisó la estructura del proyecto Laravel ejecutando:

```bash
ls -la
```

Con este comando se verificaron las carpetas y archivos principales del proyecto Laravel.

![Captura 2 - Estructura Laravel](evidencia_estructura_laravel.png)

## 3. Pantalla de bienvenida de Laravel

Se ejecutó el proyecto Laravel y se verificó en el navegador que cargara correctamente la pantalla de bienvenida.

![Captura 3 - Bienvenida Laravel](evidencia_bienvenida_laravel.png)

## 4. Archivos excluidos

El proyecto no debe subir al repositorio la carpeta:

```text
vendor/
```

Tampoco debe subir el archivo:

```text
.env
```

Estos archivos se excluyen mediante `.gitignore`.

La carpeta `vendor/` puede reconstruirse ejecutando:

```bash
composer install
```

## 5. Entregable

El entregable contiene:

- Proyecto Laravel dentro de la carpeta `semana2/`.
- Captura de `php -v` y `composer --version`.
- Captura de `ls -la` mostrando la estructura del proyecto.
- Captura de la pantalla de bienvenida de Laravel.
- Archivo `README.md` documentando la instalación de Laravel.