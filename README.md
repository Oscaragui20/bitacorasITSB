<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<h2 align="center">Sistema de Bitácoras ITSB</h2>

<p align="center">Registro y administración de bitácoras de cambios en bases de datos.</p>

---

## 📌 Descripción

El **Sistema de Bitácoras ITSB** es una aplicación web desarrollada en Laravel 10. Permite registrar, visualizar y administrar bitácoras relacionadas a cambios realizados en sistemas y bases de datos. Los usuarios pueden exportar la información en formatos **Excel** y **PDF**, así como manejar accesos según **roles de usuario**.

---

## 🚀 Funcionalidades principales

- Autenticación y control de acceso por roles (admin y usuario).
- Registro de bitácoras de cambios.
- Exportación de bitácoras a Excel y PDF.
- Módulo para mantenimiento de usuarios.
- Panel de administración con control basico.
- Migraciones automáticas y sistema adaptable.

---

## 🛠️ Tecnologías utilizadas

- **Laravel 10**
- **PHP 8.1**
- **MySQL** (via XAMPP / phpMyAdmin)
- **Blade** (plantillas)
- **Bootstrap 5** 
- **Maatwebsite Excel** (para exportar a Excel)
- **Barryvdh DomPDF** (para exportar a PDF)
- **Composer** (gestor de dependencias PHP)

---

## 💻 Requisitos del sistema

- Sistema Operativo: Windows 10 o superior
- PHP >= 8.1
- XAMPP con Apache y MySQL activos
- Composer instalado
- Navegador web moderno (Chrome, Firefox, Edge)

---

## 📚 Documentación

Los siguientes documentos están incluidos en la carpeta `/documentacion`:

- 📄 [Manual Técnico](documentacion/Manual_Tecnico_BitacorasITSB.pdf)
- 👥 [Manual de Usuario](documentacion/Manual_Usuario_BitacorasITSB.pdf)
## ⚙️ Instalación del sistema

---

```bash
# Clonar el repositorio
git clone https://github.com/sistemasAuxiliarOscar/bitacorasITSB.git

# Entrar a la carpeta
cd bitacorasITSB

# Instalar dependencias
composer install

# Copiar archivo de entorno
cp .env.example .env

# Configurar base de datos en .env
DB_DATABASE=bitacoras
DB_USERNAME=root
DB_PASSWORD=

# la base de datos esta en al carpeta de /database_backup

# Generar la clave de aplicación
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Iniciar el servidor
php artisan serve



# Paso a paso para crear un nuevo usuario con Tinker:  
php artisan tinker

# Una vez dentro, copia y pega este código (este codigo es para crear un ADMIN):
\App\Models\Usuario::create([
    'nombre' => 'admin2',
    'contraseña' => bcrypt('admin123'),
    'rol' => 'admin'
]);
# Presiona Enter y el usuario ADMIN se creará en tu base de datos.

# PARA CREAR UN USUARIO COMUN

\App\Models\Usuario::create([
    'nombre' => 'maria',
    'contraseña' => bcrypt('maria123'),
    'rol' => 'usuario'
]);

# Presiona Enter y el usuario se creará en tu base de datos.
