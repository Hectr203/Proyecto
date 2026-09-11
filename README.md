* [ ] 

* [ ]

# Evaluación Técnica - Tienda E-Commerce

Este proyecto es una plataforma de comercio electrónico desarrollada en **Laravel 12** con **Livewire 3**, **Alpine.js**, y **Tailwind CSS**. Cumple con todos los requerimientos técnicos de gestión de productos, integración de pagos, reportes y almacenamiento en la nube (Azure Blob Storage).

## Características Implementadas

### Backend & Arquitectura

- **API Externa de Monedas**: Integración con `open.er-api.com` para convertir el precio dinámicamente de MXN a USD, minimizando llamadas innecesarias gracias al almacenamiento en caché con **Redis**.
- **Almacenamiento Azure Blob Storage**: Integración nativa a través del driver `azure` configurando temporalidad (SAS Tokens) para servir las imágenes de manera segura.
- **Gestión de Stock y SoftDeletes**: Asegurando la integridad referencial y que los productos "eliminados" no rompan el historial de ventas.

### Frontend

- Tema de diseño "Vibrant Premium" implementando mejores prácticas de Glassmorphism.
- Catálogo de tienda en tiempo real y buscador.
- Carrito de compras utilizando almacenamiento de sesión.
- Simulación de pago integrando **Stripe Checkout Sessions**.

### Administración

- Panel de control de categorías y productos con carga de imágenes nativa y previews.
- Dashboard de reportes usando **Chart.js** y filtros de periodos de tiempo.
- Resumen de métricas: Ganancias, top de productos más vendidos, y listado de pedidos.

---

## Guía de Configuración Local

### Prerrequisitos

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL / MariaDB
- Servidor Redis instalado y corriendo.

### 1. Clonar e Instalar Dependencias

```bash
git clone <repository-url>
cd Proyecto
composer install
npm install && npm run build
```

### 2. Configuración de Entorno (.env)

Copia el archivo de ejemplo:

```bash
cp .env.example .env
php artisan key:generate
```

Actualiza las siguientes variables clave en `.env`:

#### Base de Datos

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tienda_evaluacion
DB_USERNAME=root
DB_PASSWORD=
```

#### Redis (Para caché de API Monetaria)

```env
CACHE_STORE=redis
REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

#### Azure Blob Storage (Para subida de imágenes)

Asegúrate de contar con tus credenciales del panel de Azure.

```env
AZURE_STORAGE_NAME="alancendocs"
AZURE_STORAGE_KEY="tu_azure_key"
AZURE_STORAGE_CONTAINER="archivos"
```

*(Nota: El sistema intentará crear el contenedor dinámicamente si no existe)*

#### Stripe (Pasarela de Pagos)

Para probar los pagos necesitarás llaves de prueba de Stripe. Consíguelas en [dashboard.stripe.com/test/apikeys](https://dashboard.stripe.com/test/apikeys).

```env
STRIPE_KEY="pk_test_..."
STRIPE_SECRET="sk_test_..."
```

### 3. Migraciones y Seeders

```bash
php artisan migrate --seed
```

*(Si configuraste un seeder para agregar productos o un administrador por defecto).*

### 4. Ejecutar el Servidor

```bash
php artisan serve
```

## Flujo de Pago

El flujo de checkout está configurado para utilizar Stripe en modo prueba.
Para aprobar un pago en la ventana de Stripe, puedes utilizar cualquiera de las [tarjetas de prueba oficiales de Stripe](https://docs.stripe.com/testing).
Tras completar el pago, Stripe redirigirá a la aplicación `/checkout/success` y el backend registrará los detalles de la orden en la base de datos y descontará el stock.
