# ✅ Checklist de Despliegue - FleboCenter a iPage

## 📋 Pre-Despliegue (Local)

### Preparación de Archivos:
- [ ] Ejecutar `optimize_for_production.sh` (o comandos manualmente en Windows)
- [ ] Verificar que `.env.production` tiene la configuración correcta
- [ ] Confirmar que `index_ipage.php` está listo
- [ ] Confirmar que `.htaccess_ipage` está listo
- [ ] Exportar base de datos desde phpMyAdmin local

### Verificación Local:
- [ ] El login funciona con `flebocenter.quetgo@gmail.com`
- [ ] Todas las funcionalidades principales funcionan
- [ ] No hay errores en los logs
- [ ] Las rutas funcionan correctamente

## 🌐 Configuración en iPage

### Panel de Control iPage:
- [x] ~~Crear nueva base de datos MySQL~~ (Ya existe)
- [x] ~~Anotar nombre de BD:~~ **dbflebocenternuevo**
- [x] ~~Anotar usuario de BD:~~ **sz**
- [x] ~~Anotar contraseña de BD:~~ **SPP7007aaa@@@**
- [x] ~~Anotar host de BD:~~ **szclinicascom.ipagemysql.com**
- [ ] Configurar correo electrónico `info@flebocenter.com`
- [ ] Anotar contraseña de correo: __________

## 📤 Subida por FTP

### Estructura de Carpetas:
- [ ] Subir TODA la aplicación Laravel directamente a `public_html/`
- [ ] Mantener la carpeta `public/` tal como está (NO mover su contenido)

### Archivos Específicos:
- [ ] Renombrar `.env.production` → `.env` en `public_html/`
- [ ] ❌ ~~NO usar `index_ipage.php`~~ - usar el `index.php` original
- [ ] ❌ ~~NO usar `.htaccess_ipage`~~ - usar el `.htaccess` original
- [ ] Verificar que toda la estructura Laravel está intacta

### Carpetas Importantes Subidas:
- [ ] `app/`
- [ ] `bootstrap/`
- [ ] `config/`
- [ ] `database/`
- [ ] `resources/`
- [ ] `routes/`
- [ ] `storage/`
- [ ] `vendor/`
- [ ] `public/` (completa, incluyendo assets/, dashboardtemplate/, frontendtemplate/)

## ⚙️ Configuración Final

### Archivo .env en servidor:
- [x] ~~Actualizar `DB_DATABASE`~~ **Ya configurado: dbflebocenternuevo**
- [x] ~~Actualizar `DB_USERNAME`~~ **Ya configurado: sz**  
- [x] ~~Actualizar `DB_PASSWORD`~~ **Ya configurado: SPP7007aaa@@@**
- [x] ~~Actualizar `DB_HOST`~~ **Ya configurado: szclinicascom.ipagemysql.com**
- [ ] Actualizar `MAIL_PASSWORD` con contraseña real del correo info@flebocenter.com
- [x] ~~Verificar `APP_URL=https://flebocenter.com`~~ **✓**
- [x] ~~Verificar `APP_ENV=production`~~ **✓**
- [x] ~~Verificar `APP_DEBUG=false`~~ **✓**

### Permisos de Carpetas:
- [ ] `storage/` → 755 o 777
- [ ] `storage/logs/` → 755 o 777
- [ ] `storage/framework/` → 755 o 777
- [ ] `storage/framework/cache/` → 755 o 777
- [ ] `storage/framework/sessions/` → 755 o 777
- [ ] `storage/framework/views/` → 755 o 777
- [ ] `bootstrap/cache/` → 755 o 777

### Base de Datos:
- [ ] Importar archivo .sql en phpMyAdmin de iPage
- [ ] Verificar que todas las tablas se importaron
- [ ] Confirmar que hay datos en tabla `users`
- [ ] Verificar cantidad de registros coincide

## 🧪 Pruebas en Producción

### Funcionalidades Básicas:
- [ ] El sitio carga: https://www.flebocenter.com/
- [ ] Redirección correcta a HTTPS
- [ ] Página de login accesible
- [ ] Login funciona con `flebocenter.quetgo@gmail.com`
- [ ] Dashboard carga después del login
- [ ] CSS y JavaScript se cargan correctamente

### Funcionalidades del Sistema:
- [ ] Crear nuevo paciente
- [ ] Editar paciente existente
- [ ] Crear nueva cita
- [ ] Generar reportes
- [ ] Subir imágenes/documentos
- [ ] Sistema de CSRF funciona (sin error 419)

### Correo Electrónico (si configurado):
- [ ] Enviar correo de prueba
- [ ] Notificaciones automáticas funcionan
- [ ] Recuperación de contraseña funciona

## 🚨 Solución de Problemas

### Si hay Error 500:
- [ ] Revisar logs en `laravel_app/storage/logs/`
- [ ] Verificar permisos de carpetas
- [ ] Confirmar configuración de `.env`

### Si no carga CSS/JS:
- [ ] Verificar que archivos están en `public_html/`
- [ ] Limpiar caché del navegador
- [ ] Verificar permisos de archivos

### Si hay errores de BD:
- [ ] Verificar datos de conexión en `.env`
- [ ] Confirmar que la BD fue importada completamente
- [ ] Verificar permisos del usuario de BD en iPage

## ✅ Despliegue Exitoso

**¡Felicidades! FleboCenter está en línea en https://www.flebocenter.com/**

### Pasos Post-Despliegue:
- [ ] Actualizar marcadores/favoritos
- [ ] Informar a los usuarios sobre la nueva URL
- [ ] Configurar monitoreo/backup si es necesario
- [ ] Documentar credenciales y configuración para futuras referencias