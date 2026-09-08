# TaskFlow

## Sistema de gestión de tareas

TaskFlow es una aplicación web desarrollada con Laravel que permite a los usuarios registrar, organizar, consultar, actualizar y eliminar sus tareas personales.

El proyecto fue desarrollado como proyecto final del curso **Técnico en Programación de Páginas Web (TPPW)**, aplicando los conocimientos adquiridos durante el desarrollo de aplicaciones web con PHP, Laravel, bases de datos, Bootstrap, autenticación y operaciones CRUD.

---

## Descripción del proyecto

TaskFlow permite administrar tareas de manera sencilla y organizada.

Cada usuario puede:

* Crear una cuenta.
* Iniciar y cerrar sesión.
* Consultar un dashboard con información de sus tareas.
* Crear nuevas tareas.
* Editar tareas existentes.
* Marcar tareas como pendientes o completadas.
* Eliminar tareas.
* Buscar tareas.
* Filtrar tareas por estado.
* Filtrar tareas por categoría.
* Filtrar tareas por prioridad.
* Crear categorías personalizadas.
* Editar categorías.
* Eliminar categorías.

Las tareas y categorías están relacionadas con el usuario autenticado, evitando que un usuario pueda administrar registros pertenecientes a otro usuario.

---

## Problema que resuelve

La aplicación busca facilitar la organización y seguimiento de actividades personales, académicas o laborales mediante un sistema centralizado.

En lugar de llevar el control de las tareas de forma manual, TaskFlow permite registrarlas y consultar su estado, prioridad, fecha límite y categoría desde una aplicación web.

---

## Funcionalidades principales

### Autenticación

* Registro de usuarios.
* Inicio de sesión.
* Cierre de sesión.
* Manejo de sesiones.
* Protección de rutas mediante autenticación.
* Contraseñas almacenadas de forma segura.

### Dashboard

El dashboard muestra información relacionada con las tareas del usuario autenticado:

* Total de tareas.
* Tareas pendientes.
* Tareas completadas.
* Tareas eliminadas.
* Últimas tareas registradas.

### Gestión de tareas

TaskFlow implementa operaciones CRUD:

* Crear tareas.
* Consultar tareas.
* Editar tareas.
* Eliminar tareas.

Cada tarea puede contener:

* Título.
* Descripción.
* Estado.
* Fecha límite.
* Prioridad.
* Categoría.

### Estados

Las tareas pueden encontrarse en dos estados:

* Pendiente.
* Completada.

El usuario puede cambiar el estado de una tarea directamente desde la lista de tareas.

Las tareas se muestran organizadas dinámicamente en:

* Tareas pendientes.
* Tareas completadas.

### Búsqueda y filtros

La aplicación permite buscar tareas por:

* Título.
* Descripción.

También permite filtrar por:

* Estado.
* Categoría.
* Prioridad.

### Gestión de categorías

Los usuarios pueden administrar sus propias categorías:

* Crear categoría.
* Editar categoría.
* Eliminar categoría.

Las categorías están relacionadas con las tareas mediante una relación entre las tablas correspondientes.

---

## Tecnologías utilizadas

* **PHP 8.2.12**
* **Laravel 12.69.1**
* **Blade**
* **Eloquent ORM**
* **Laravel Fortify**
* **MySQL/MariaDB**
* **Bootstrap**
* **HTML5**
* **CSS**
* **JavaScript**
* **Git**
* **GitHub**
* **Visual Studio Code**
* **XAMPP**

---

## Requisitos

Para ejecutar el proyecto se necesita:

* PHP 8.2 o superior.
* Composer.
* MySQL o MariaDB.
* XAMPP u otro servidor compatible con PHP y MySQL.
* Git.
* Navegador web.

---

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/jevangelistadeplata-hue/taskflow-app.git
```

Entrar al proyecto:

```bash
cd taskflow-app
```

### 2. Instalar las dependencias

```bash
composer install
```

### 3. Crear el archivo `.env`

Copiar el archivo de configuración de ejemplo:

```bash
cp .env.example .env
```

En Windows también se puede copiar manualmente `.env.example` y cambiarle el nombre a `.env`.

### 4. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 5. Crear la base de datos

Crear una base de datos llamada:

```text
taskflow
```

### 6. Configurar la conexión

En el archivo `.env`, configurar los datos correspondientes al servidor MySQL/MariaDB.

Ejemplo:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=taskflow
DB_USERNAME=root
DB_PASSWORD=
```

El puerto puede variar dependiendo de la configuración de MySQL del equipo donde se instale la aplicación.

### 7. Ejecutar las migraciones

```bash
php artisan migrate
```

Esto creará las tablas necesarias para la aplicación.

### 8. Iniciar el servidor

```bash
php artisan serve
```

La aplicación estará disponible normalmente en:

```text
http://127.0.0.1:8000
```

---

## Estructura principal del proyecto

```text
taskflow-app/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── CategoriaController.php
│   │       ├── DashboardController.php
│   │       ├── HomeController.php
│   │       └── TareaController.php
│   │
│   └── Models/
│       ├── Categoria.php
│       ├── Tarea.php
│       └── User.php
│
├── database/
│   └── migrations/
│
├── resources/
│   └── views/
│       ├── auth/
│       ├── categorias/
│       ├── tareas/
│       └── dashboard.blade.php
│
├── routes/
│   └── web.php
│
├── .env.example
├── artisan
├── composer.json
└── README.md
```

---

## Relaciones principales de la base de datos

La aplicación utiliza relaciones mediante Eloquent ORM.

### Usuario → Tareas

Un usuario puede tener muchas tareas.

```text
users
  │
  └── tareas
```

### Usuario → Categorías

Un usuario puede tener muchas categorías.

```text
users
  │
  └── categorias
```

### Categoría → Tareas

Una categoría puede estar asociada a varias tareas.

```text
categorias
  │
  └── tareas
```

De esta manera, los registros están relacionados y pertenecen al usuario autenticado.

---

## Flujo principal de la aplicación

```text
Registro
   ↓
Inicio de sesión
   ↓
Dashboard
   ↓
Crear tarea
   ↓
Tarea pendiente
   ↓
Editar / completar
   ↓
Tarea completada
   ↓
Buscar / filtrar
   ↓
Editar o eliminar
```

---

## Seguridad y validación

TaskFlow incorpora diferentes mecanismos básicos de seguridad proporcionados por Laravel:

* Autenticación de usuarios.
* Middleware `auth`.
* Protección CSRF en formularios.
* Validación de datos.
* Contraseñas almacenadas mediante hashing.
* Control de propietario de tareas y categorías.
* Protección contra acceso a registros pertenecientes a otros usuarios.
* Uso de Eloquent ORM para interactuar con la base de datos.

---

## Control de versiones

El proyecto utiliza **Git** para el control de versiones y **GitHub** como repositorio remoto.

Los cambios importantes del proyecto se registran mediante commits para mantener un historial del desarrollo.

---

## Repositorio en GitHub

**Código fuente:**  
https://github.com/jevangelistadeplata-hue/taskflow-app

---

## Autor

**José Evangelista**

Proyecto académico desarrollado para el curso:

**Técnico en Programación de Páginas Web (TPPW)**



