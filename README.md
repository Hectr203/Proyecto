# Evaluación Técnica: LumenLab

E-commerce desarrollado con **Laravel 12**, **Livewire 3**, Blade, Alpine.js, Tailwind CSS, MySQL/MariaDB y Redis. El proyecto incluye catálogo, carrito, checkout con Stripe, panel administrativo, reportes, búsqueda con Elasticsearch, tipo de cambio externo y almacenamiento de imágenes en Azure Blob Storage.

## Funcionalidades

### Tienda

- Catálogo de productos activos con búsqueda, categorías y paginación reactiva.
- Detalle de producto con SKU, descripción, imagen, precio MXN/USD y stock.
- Carrito en sesión con agregar, modificar cantidades y eliminar productos.
- Validación de cantidad contra el stock disponible.
- Checkout con correo, subtotal, IVA del 16%, total MXN y conversión USD.
- Stripe Checkout en modo de prueba.

### Administración

- Login y autorización por rol `super_admin`.
- CRUD de productos y categorías con Livewire.
- Búsqueda, paginación y filtro de estado de productos.
- Validación de SKU, precios, stock, categoría e imagen.
- Reportes con filtro de hoy, semana, mes o todo el periodo.
- Gráfica de ingresos y Top 3 de productos vendidos.

### Integraciones

- **Tipo de cambio:** `open.er-api.com`, encapsulado en `ExchangeRateService`, con caché de una hora y tasa de fallback.
- **Pago:** Stripe Checkout; la aplicación no procesa directamente los datos de tarjeta.
- **Imágenes:** Azure Blob Storage mediante un Job asíncrono.
- **Búsqueda:** Elasticsearch fuzzy con fallback SQL si el servicio no está disponible.
- **Correo:** OTP de verificación y confirmación de pedido mediante mailables en cola.

## Requisitos

- PHP 8.2+
- Composer 2+
- Node.js y NPM
- MySQL o MariaDB
- Redis
- Docker, opcional para Elasticsearch

## Instalación

```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
```

Configura `.env` con MySQL, Redis y los servicios que quieras probar:

```env
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tienda_evaluacion
DB_USERNAME=root
DB_PASSWORD=

CACHE_STORE=redis
REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
QUEUE_CONNECTION=database
SESSION_DRIVER=database

ELASTICSEARCH_HOST=http://localhost:9200
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
AZURE_STORAGE_NAME=...
AZURE_STORAGE_KEY=...
AZURE_STORAGE_CONTAINER_NAME=...
AZURE_STORAGE_URL=...
AZURE_STORAGE_CONNECTION_STRING=...
FRONTEND_URL=http://localhost:8000
```

Ejecuta migraciones, seeders y compilación:

```bash
php artisan migrate:fresh --seed
npm run build
```

Para activar Elasticsearch:

```bash
docker compose up -d elasticsearch
```

Para procesar correos y trabajos de Azure:

```bash
php artisan queue:work
```

Inicia la aplicación:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

## Credenciales de prueba

El seeder crea:

- Usuario: `admin@test.com`
- Contraseña: `password`
- Panel: `/admin/products`

Cambia la contraseña fuera del entorno de demostración y nunca subas secretos al repositorio.

## Flujo de checkout

1. El usuario agrega productos al carrito de sesión.
2. Checkout calcula subtotal, IVA y total.
3. Se solicita el correo y se crea una Checkout Session de Stripe.
4. Stripe redirige a `/checkout/success`.
5. La aplicación verifica que el pago esté marcado como `paid`.
6. Una transacción crea el pedido, sus detalles y descuenta stock.
7. Se envía el correo de confirmación y se limpia el carrito.

## Estructura importante

- `app/Livewire/Modules/Client`: catálogo, carrito y checkout.
- `app/Livewire/Modules/Admin`: productos, categorías y reportes.
- `app/Core/Catalog`: modelo Product y servicio de tipo de cambio.
- `app/Core/Checkout`: modelos Order y OrderDetail.
- `app/Core/Auth`: middleware de administración y verificación de correo.
- `database/migrations`: esquema de usuarios, productos, categorías, pedidos y OTP.
- `resources/views`: layouts, páginas Blade, correos y componentes visuales.

## Documentación ampliada

La guía para explicar la arquitectura y revisar el cumplimiento de la evaluación está en:

`../documentacion-explicaciones/00_Maestra/02_Auditoria_Requerimientos_Guia_Entrevista.md`

Ese documento también registra las brechas pendientes: filtros de precio/disponibilidad/vigencia, acción administrativa de activar/inactivar, validación estricta del nombre, configuración del virtual host y endurecimiento de idempotencia del checkout.

## Validación

```bash
php artisan route:list
php artisan view:cache
npm run build
php artisan test
```

Las pruebas requieren una extensión de base de datos disponible. En el entorno de desarrollo usado para esta evaluación, PHPUnit quedó bloqueado por la ausencia de `pdo_sqlite`; con MySQL configurado o habilitando SQLite se debe ejecutar el suite completo.
