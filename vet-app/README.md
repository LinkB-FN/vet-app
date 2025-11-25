# Sistema de Gestión Veterinaria

Sistema completo de gestión para clínicas veterinarias desarrollado con Laravel 11, Livewire y Flux UI.

## 📋 Características

### Autenticación y Autorización
- ✅ Registro y login de usuarios (Laravel Fortify)
- ✅ Sistema de roles (Admin, Staff, Client)
- ✅ Middleware de autorización basado en roles
- ✅ Logout y gestión de sesiones
- ✅ Dashboard personalizado según rol

### Gestión de Roles

#### Admin
- Gestión completa de usuarios
- Acceso a todas las funcionalidades del sistema
- Panel de administración dedicado

#### Staff (Empleados)
- Gestión de dueños de mascotas
- Gestión de mascotas
- Gestión de citas veterinarias
- Visualización de estadísticas

#### Client (Clientes)
- Visualización de dashboard
- Acceso a información personal

### Módulos Principales

#### 1. Gestión de Dueños
- CRUD completo de dueños
- Información de contacto (nombre, teléfono, email, dirección)
- Visualización de mascotas asociadas
- Historial de citas

#### 2. Gestión de Mascotas
- CRUD completo de mascotas
- Información detallada (nombre, especie, raza, fecha de nacimiento)
- Relación con dueño
- Historial de citas veterinarias
- Notas adicionales

#### 3. Gestión de Citas
- CRUD completo de citas
- Asignación de veterinario
- Estados de cita (pendiente, confirmada, completada, cancelada)
- Fecha y hora de la cita
- Motivo y notas
- Visualización de información completa de mascota y dueño

#### 4. Panel de Administración
- Gestión de usuarios del sistema
- Asignación de roles
- Creación y edición de usuarios
- Visualización de estadísticas de usuarios

## 🛠️ Tecnologías Utilizadas

- **Laravel 11**: Framework PHP
- **Laravel Fortify**: Autenticación
- **Livewire**: Componentes reactivos
- **Flux UI**: Componentes de interfaz
- **Tailwind CSS**: Estilos
- **MySQL/SQLite**: Base de datos

## 📦 Instalación

1. Clonar el repositorio
```bash
git clone <repository-url>
cd vet-app
```

2. Instalar dependencias de PHP
```bash
composer install
```

3. Instalar dependencias de Node.js
```bash
npm install
```

4. Configurar el archivo .env
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurar la base de datos en .env
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=veterinaria
DB_USERNAME=root
DB_PASSWORD=
```

6. Ejecutar migraciones y seeders
```bash
php artisan migrate
php artisan db:seed
```

7. Compilar assets
```bash
npm run dev
```

8. Iniciar el servidor
```bash
php artisan serve
```

## 👥 Usuarios de Prueba

El sistema viene con usuarios de prueba pre-configurados:

| Rol | Email | Contraseña |
|-----|-------|------------|
| Admin | admin@veterinaria.com | password |
| Staff | staff1@veterinaria.com | password |
| Staff | staff2@veterinaria.com | password |
| Client | client@veterinaria.com | password |

## 📁 Estructura del Proyecto

```
vet-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   └── UserController.php
│   │   │   ├── OwnerController.php
│   │   │   ├── PetController.php
│   │   │   └── AppointmentController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Owner.php
│       ├── Pet.php
│       └── Appointment.php
├── database/
│   ├── migrations/
│   │   ├── 2025_01_09_000001_add_role_to_users_table.php
│   │   ├── 2025_01_09_000002_create_owners_table.php
│   │   ├── 2025_01_09_000003_create_pets_table.php
│   │   └── 2025_01_09_000004_create_appointments_table.php
│   ├── factories/
│   │   ├── UserFactory.php
│   │   ├── OwnerFactory.php
│   │   ├── PetFactory.php
│   │   └── AppointmentFactory.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── dashboard.blade.php
│       ├── owners/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── pets/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── appointments/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       └── admin/
│           └── users/
│               ├── index.blade.php
│               ├── create.blade.php
│               └── edit.blade.php
└── routes/
    └── web.php
```

## 🔐 Sistema de Roles y Permisos

### Middleware de Roles
El sistema utiliza un middleware personalizado `RoleMiddleware` que verifica los roles de usuario:

```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Rutas solo para administradores
});

Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    // Rutas para administradores y staff
});
```

### Métodos de Verificación de Roles
El modelo User incluye métodos helper:

```php
$user->hasRole('admin'); // Verifica un rol específico
$user->hasAnyRole(['admin', 'staff']); // Verifica múltiples roles
```

## 🗄️ Modelos y Relaciones

### User
- `hasMany` appointments (como veterinario)
- Atributos: name, email, password, role

### Owner
- `hasMany` pets
- Atributos: name, phone, email, address

### Pet
- `belongsTo` owner
- `hasMany` appointments
- Atributos: name, species, breed, birth_date, notes

### Appointment
- `belongsTo` pet
- `belongsTo` user (veterinario)
- Atributos: appointment_date, reason, status, notes

## 🎨 Interfaz de Usuario

- Dashboard con estadísticas en tiempo real
- Navegación lateral con menús basados en roles
- Tablas responsivas con paginación
- Formularios con validación
- Badges de estado para citas
- Diseño moderno con Tailwind CSS y Flux UI

## 📝 Rutas Principales

### Públicas
- `/` - Página de inicio
- `/login` - Inicio de sesión
- `/register` - Registro

### Autenticadas
- `/dashboard` - Dashboard principal
- `/owners` - Gestión de dueños
- `/pets` - Gestión de mascotas
- `/appointments` - Gestión de citas

### Admin (Solo Admin)
- `/admin/users` - Gestión de usuarios

## 🚀 Próximas Mejoras

- [ ] Sistema de notificaciones
- [ ] Recordatorios de citas por email
- [ ] Historial médico detallado
- [ ] Reportes y estadísticas avanzadas
- [ ] Sistema de facturación
- [ ] Gestión de inventario de medicamentos
- [ ] API REST para integración con otras aplicaciones

## 📄 Licencia

Este proyecto es de código abierto y está disponible bajo la licencia MIT.

## 👨‍💻 Desarrollo

Desarrollado como proyecto educativo para demostrar:
- Arquitectura MVC en Laravel
- Sistema de autenticación y autorización
- CRUD completo con relaciones
- Uso de migraciones y seeders
- Implementación de middleware personalizado
- Diseño de interfaces con componentes modernos
