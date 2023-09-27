
# Bienvenidos

Los requisitos para correr este proyecto son:
- Composer > 2.6
- PHP > 8.1
- XAMPP > 3.0

## Deployment


- Clona el repositorio
```bash
  https://github.com/Stondark/Suplos-Test.git
```
- Abre XAMPP y activa los módulos
```bash
  Apache
  MySQL
```

- Mueve el proyecto a la carpeta Htdocs de XAMPP
```bash
    C:\xampp\htdocs\Suplos-Test
```
- Abre el archivo src\db\suplos.sql y móntalo en tu gestor de base de datos MySQL

- Abre el archivo src\config\.env y configura las credenciales de la base de datos
```bash
    HOST = localhost
    DB = suplos
    USER = root
    PASSWORD = ejemplo
```

- Abre la terminal de tu sistema y accede a la ruta de donde guardaste el repositorio
```bash
  cd C:\xampp\htdocs\Suplos-Test
```

- Instala las librerías
```bash
    composer install --ignore-platform-req=ext-gd
```

- Ejecuta el comando
```bash
    php -S localhost:3000
```
Ahora prueba las peticiones desde Postman con:
```bash
    https://www.postman.com/supply-engineer-8253701/workspace/public-collections/collection/17795589-21e57f6d-63bc-41e7-88d1-fd3fdaceb2fb?action=share&creator=17795589
```