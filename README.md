# 📚 MiniBiblio

Aplicación web de gestión de biblioteca desarrollada con **Symfony** y **PHP**. Permite administrar el catálogo de libros y los socios de la biblioteca desde una interfaz web sencilla.

## ✨ Funcionalidades

- **Catálogo de libros** — listado de libros con su autor asociado
- **Gestión de socios** — alta y baja de socios de la biblioteca

## 🛠️ Tecnologías

- PHP
- Symfony
- Twig
- Doctrine ORM
- MySQL

## 🚀 Instalación

### Requisitos previos

- PHP 8.1 o superior
- Composer
- MySQL

### Pasos

```bash
# Clonar el repositorio
git clone https://github.com/Jonrn16/MiniBiblio.git
cd MiniBiblio

# Instalar dependencias
composer install

# Configurar la base de datos
cp .env .env.local
# Editar .env.local con tus credenciales de base de datos

# Crear la base de datos y ejecutar migraciones
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

# Iniciar el servidor de desarrollo
symfony serve
```

La aplicación estará disponible en `http://localhost:8000`.

## 📁 Estructura del proyecto

```
MiniBiblio/
├── src/
│   ├── Controller/
│   ├── Entity/
│   └── Repository/
├── templates/
├── migrations/
└── config/
```

## 📄 Licencia

Proyecto académico desarrollado como parte del CFGS en Desarrollo de Aplicaciones Web.
