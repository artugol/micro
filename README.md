# MicroFramework PHP

Un microframework PHP simple con arquitectura MVC para gestionar artículos y nombres. Diseñado para ser desplegado en Railway con MySQL.

## 🚀 Características

- ✅ Arquitectura MVC limpia
- ✅ Router personalizado
- ✅ CRUD completo para Artículos y Nombres
- ✅ API REST endpoints
- ✅ Diseño responsive
- ✅ Listo para Railway deployment
- ✅ Sin dependencias externas (PHP puro)

## 📋 Requisitos

- PHP >= 7.4
- MySQL/MariaDB
- Apache/Nginx (con mod_rewrite para Apache)

## 🛠️ Instalación Local

### 1. Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/microframework.git
cd microframework
```

### 2. Configurar base de datos

**Opción A - Instalador Automático (Recomendado):**

```bash
php setup.php
```

**Opción B - Manual:**

```bash
mysql -u root -p < database/schema.sql
```

O accede a phpMyAdmin y ejecuta el contenido de `database/schema.sql`

### 3. Configurar variables de entorno

Copia `.env.example` a `.env` y ajusta las credenciales:

```bash
cp .env.example .env
```

Edita `.env` con tus credenciales de base de datos locales:

```env
DB_HOST=localhost
DB_NAME=microframework_db
DB_USER=root
DB_PASSWORD=tu_password
```

### 4. Ejecutar con PHP Built-in Server

```bash
php -S localhost:8000 -t public
```

O con Composer:

```bash
composer start
```

Visita: `http://localhost:8000`

### 5. Usar con XAMPP/WAMP

Coloca el proyecto en `htdocs/microframework` y accede a:
`http://localhost/microframework/public`

## 🚂 Despliegue en Railway

### Paso 1: Preparar el repositorio

1. Sube tu código a GitHub:

```bash
git init
git add .
git commit -m "Initial commit"
git branch -M main
git remote add origin https://github.com/tu-usuario/microframework.git
git push -u origin main
```

### Paso 2: Configurar en Railway

1. Ve a [railway.app](https://railway.app) e inicia sesión
2. Click en "New Project"
3. Selecciona "Deploy from GitHub repo"
4. Elige tu repositorio `microframework`
5. Railway detectará automáticamente que es PHP

### Paso 3: Agregar MySQL

1. En tu proyecto de Railway, click en "New"
2. Selecciona "Database" → "Add MySQL"
3. Railway creará una base de datos MySQL automáticamente

### Paso 4: Configurar Variables de Entorno

En la configuración de tu servicio PHP, agrega estas variables:

```
DB_HOST=${{MySQL.MYSQLHOST}}
DB_NAME=${{MySQL.MYSQLDATABASE}}
DB_USER=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
```

Railway las conectará automáticamente con tu base de datos.

### Paso 5: Importar Schema

1. Conéctate a tu base de datos Railway usando el cliente MySQL:

```bash
mysql -h <RAILWAY_HOST> -u <USER> -p<PASSWORD> <DATABASE> < database/schema.sql
```

O usa un cliente GUI como TablePlus o DBeaver con las credenciales de Railway.

### Paso 6: Deploy

Railway desplegará automáticamente. Visita la URL proporcionada.

## 📁 Estructura del Proyecto

```
microframework/
├── public/              # Punto de entrada público
│   ├── index.php       # Front controller
│   └── .htaccess       # Rewrite rules
├── src/                # Código fuente
│   ├── Controllers/    # Controladores
│   │   ├── ArticulosController.php
│   │   └── NombresController.php
│   ├── Models/         # Modelos
│   │   ├── ArticulosModel.php
│   │   └── NombresModel.php
│   ├── Views/          # Vistas
│   │   ├── articulos/
│   │   └── nombres/
│   └── Router.php      # Sistema de routing
├── config/             # Configuración
│   └── database.php    # Conexión DB
├── database/           # Scripts SQL
│   └── schema.sql      # Schema inicial
├── .env.example        # Variables de entorno
├── .gitignore
├── composer.json
└── README.md
```

## 🔗 Rutas Disponibles

### Web UI

- `GET /` - Página principal (lista de artículos)
- `GET /articulos` - Lista de artículos
- `GET /articulos/crear` - Formulario nuevo artículo
- `POST /articulos/guardar` - Guardar artículo
- `GET /articulos/editar?id=X` - Editar artículo
- `POST /articulos/actualizar` - Actualizar artículo
- `GET /articulos/eliminar?id=X` - Eliminar artículo

- `GET /nombres` - Lista de nombres
- `GET /nombres/crear` - Formulario nuevo nombre
- `POST /nombres/guardar` - Guardar nombre
- `GET /nombres/editar?id=X` - Editar nombre
- `POST /nombres/actualizar` - Actualizar nombre
- `GET /nombres/eliminar?id=X` - Eliminar nombre

### API REST

- `GET /api/articulos` - JSON de todos los artículos
- `GET /api/nombres` - JSON de todos los nombres

## 🎨 Personalización

### Agregar una Nueva Entidad

1. Crea el modelo en `src/Models/TuEntidadModel.php`
2. Crea el controlador en `src/Controllers/TuEntidadController.php`
3. Crea las vistas en `src/Views/tuentidad/`
4. Agrega las rutas en `public/index.php`

## 🐛 Solución de Problemas

### Error de conexión a base de datos

Verifica las variables de entorno en Railway o tu `.env` local.

### Error 404 en todas las rutas

Asegúrate de que `.htaccess` está en `public/` y `mod_rewrite` está activado.

### Las rutas no funcionan en Railway

Railway usa Nginx, el routing se maneja en `public/index.php` directamente.

## 📝 Licencia

MIT License - Libre para usar en proyectos personales y comerciales.

## 👤 Autor

Tu nombre - [GitHub](https://github.com/tu-usuario)

## 🤝 Contribuciones

¡Las contribuciones son bienvenidas! Abre un issue o pull request.
