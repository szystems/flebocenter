# 🚀 Guía de Despliegue a flebocenter.com - FleboCenter

## 📋 Preparativos Antes del Despliegue

### 1. Configuración de Base de Datos en iPage
- ✅ Base de datos ya configurada: `dbflebocenternuevo`
- ✅ Datos de conexión disponibles:
  - Host: szclinicascom.ipagemysql.com
  - Usuario: sz
  - Contraseña: SPP7007aaa@@@

### 2. Configuración del Archivo .env
- Renombrar `.env.production` a `.env` en el servidor
- Solo falta actualizar: `MAIL_PASSWORD=contraseña_real_del_correo`

## 📁 Estructura de Archivos para FTP

### URL Final: https://www.flebocenter.com/

### Estructura en el servidor flebocenter.com:
```
public_html/
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── database/
    ├── resources/
    ├── routes/
    ├── storage/
    ├── vendor/
    ├── public/ (mantener como está - NO mover contenido)
    │   ├── index.php (original)
    │   ├── .htaccess (original)
    │   ├── assets/
    │   ├── dashboardtemplate/
    │   └── frontendtemplate/
    ├── .env (renombrado de .env.production)
    ├── artisan
    ├── composer.json
    └── composer.lock
```

## 🔧 Modificaciones Necesarias

### ✅ NO se necesitan modificaciones especiales
- El `index.php` original funciona correctamente
- El `.htaccess` original es válido
- La estructura de Laravel se mantiene intacta

## 📤 Pasos de Subida por FTP

1. **Subir TODA la aplicación Laravel** directamente a public_html/
2. **Renombrar .env.production a .env** en public_html/
4. **Completar contraseña de correo** en el .env
5. **Configurar permisos** de las carpetas storage/ y bootstrap/cache/
6. **Importar la base de datos** usando phpMyAdmin (ya existe dbflebocenternuevo)

## 🔑 Permisos Importantes

Las siguientes carpetas necesitan permisos de escritura (755 o 777):
```
laravel_app/storage/
laravel_app/storage/logs/
laravel_app/storage/framework/
laravel_app/storage/framework/cache/
laravel_app/storage/framework/sessions/
laravel_app/storage/framework/views/
laravel_app/bootstrap/cache/
```

## 🗄️ Base de Datos

### Exportar desde Local:
1. Acceder a phpMyAdmin local (http://localhost/phpmyadmin)
2. Seleccionar la base de datos `dbflebocenternuevo`
3. Ir a "Exportar" > "Método personalizado"
4. Seleccionar todas las tablas
5. Formato: SQL
6. Descargar el archivo .sql

### Importar a iPage:
1. Acceder al phpMyAdmin de iPage desde el panel de control
2. Seleccionar la base de datos creada
3. Ir a "Importar"
4. Subir el archivo .sql exportado
5. Ejecutar la importación

## ✅ Verificación Final

Después del despliegue, verificar:
- [ ] El sitio carga correctamente en https://www.flebocenter.com/
- [ ] El login funciona con las credenciales existentes
- [ ] Las imágenes y CSS se cargan correctamente
- [ ] Los formularios funcionan sin errores 419
- [ ] El correo electrónico funciona (si está configurado)
- [ ] Los logs no muestran errores críticos

## 🆘 Solución de Problemas Comunes

### Error 500:
- Verificar permisos de carpetas
- Revisar logs en storage/logs/
- Verificar configuración de .env

### Error de Base de Datos:
- Verificar datos de conexión en .env
- Confirmar que la base de datos está importada
- Verificar permisos del usuario de BD

### Error 419 (CSRF):
- El middleware personalizado VerifyCsrfFile debería manejar esto
- Verificar permisos de escritura en storage/

### Recursos no cargan (CSS/JS/Images):
- Verificar que todos los archivos de public/ están en public_html/
- Verificar permisos de archivos
- Limpiar caché del navegador