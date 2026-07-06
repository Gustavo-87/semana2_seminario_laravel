# Diccionario de Datos - Task Manager

## Tabla: users

Tabla propia de Laravel para almacenar los usuarios del sistema.

| Campo | Tipo | Longitud | Nulo | Descripción |
|---|---:|---:|---|---|
| id | BIGINT UNSIGNED | - | No | Identificador único del usuario. |
| name | VARCHAR | 255 | No | Nombre del usuario. |
| email | VARCHAR | 255 | No | Correo electrónico del usuario. |
| email_verified_at | TIMESTAMP | - | Sí | Fecha de verificación del correo. |
| password | VARCHAR | 255 | No | Contraseña cifrada del usuario. |
| remember_token | VARCHAR | 100 | Sí | Token para recordar sesión. |
| created_at | TIMESTAMP | - | Sí | Fecha de creación del registro. |
| updated_at | TIMESTAMP | - | Sí | Fecha de última actualización. |

---

## Tabla: categories

Almacena las categorías usadas para clasificar las tareas.

| Campo | Tipo | Longitud | Nulo | Descripción |
|---|---:|---:|---|---|
| id | BIGINT UNSIGNED | - | No | Identificador único de la categoría. |
| name | VARCHAR | 100 | No | Nombre de la categoría. |
| descripcion | TEXT | - | Sí | Descripción opcional de la categoría. |
| created_at | TIMESTAMP | - | Sí | Fecha de creación del registro. |
| updated_at | TIMESTAMP | - | Sí | Fecha de última actualización. |

---

## Tabla: tasks

Almacena las tareas creadas por los usuarios.

| Campo | Tipo | Longitud | Nulo | Descripción |
|---|---:|---:|---|---|
| id | BIGINT UNSIGNED | - | No | Identificador único de la tarea. |
| titulo | VARCHAR | 150 | No | Título o nombre de la tarea. |
| descripcion | TEXT | - | Sí | Descripción detallada de la tarea. |
| fecha_limite | DATE | - | Sí | Fecha máxima para completar la tarea. |
| estado | ENUM | - | No | Estado de la tarea: pendiente, en_progreso o completada. |
| user_id | BIGINT UNSIGNED | - | No | Llave foránea que relaciona la tarea con un usuario. |
| category_id | BIGINT UNSIGNED | - | No | Llave foránea que relaciona la tarea con una categoría. |
| created_at | TIMESTAMP | - | Sí | Fecha de creación del registro. |
| updated_at | TIMESTAMP | - | Sí | Fecha de última actualización. |

---

## Relaciones

| Relación | Tipo | Descripción |
|---|---|---|
| User -> Task | 1:N | Un usuario puede tener muchas tareas. |
| Category -> Task | 1:N | Una categoría puede tener muchas tareas. |
| Task -> User | N:1 | Una tarea pertenece a un usuario. |
| Task -> Category | N:1 | Una tarea pertenece a una categoría. |

---

## Validaciones principales

| Campo | Validación |
|---|---|
| titulo | Obligatorio, texto, máximo 150 caracteres. |
| descripcion | Opcional, texto. |
| fecha_limite | Opcional, fecha válida. |
| estado | Obligatorio, debe ser pendiente, en_progreso o completada. |
| category_id | Obligatorio, debe existir en la tabla categories. |
| user_id | Asignado automáticamente por el sistema o con valor temporal durante pruebas. |