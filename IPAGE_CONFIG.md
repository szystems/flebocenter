# 🔐 Configuraciones Específicas para iPage - FleboCenter

## 📊 Base de Datos Local (Para exportar)
- **Nombre**: dbflebocenternuevo
- **Usuario actual**: flebocenter.quetgo@gmail.com
- **Ubicación**: http://localhost/phpmyadmin
- **Servidor MySQL**: 127.0.0.1:3306

## 🌐 Configuraciones de Producción para iPage

### Variables .env configuradas para iPage:
```env
# Datos reales de iPage ya configurados
DB_HOST=szclinicascom.ipagemysql.com
DB_DATABASE=dbflebocenternuevo
DB_USERNAME=sz
DB_PASSWORD=SPP7007aaa@@@

# Solo falta configurar la contraseña del correo
MAIL_PASSWORD=PASSWORD_AQUI  # ← Completar con la contraseña real del correo info@flebocenter.com
```

## 📁 Estructura Final en iPage

### En public_html/ (Estructura completa):
```
public_html/
├── .env (renombrado de .env.production y configurado)
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
├── vendor/
├── public/
│   ├── index.php (original)
│   ├── .htaccess (original)
│   ├── robots.txt
│   ├── favicon.ico
│   ├── assets/
│   ├── dashboardtemplate/
│   └── frontendtemplate/
├── artisan
├── composer.json
└── composer.lock
```

## 📋 Datos de Usuario Actual del Sistema
- **Email**: flebocenter.quetgo@gmail.com
- **Base de datos**: dbflebocenternuevo (48.72 MB)
- **Tablas**: 412 tablas con datos reales
- **Pacientes**: 496 KB de datos
- **Historias**: 400 KB de datos

## 🔧 URLs Importantes

### Desarrollo (Local):
- **Aplicación**: http://127.0.0.1:8000
- **Base de datos**: http://localhost/phpmyadmin

### Producción (flebocenter.com):
- **Aplicación**: https://www.flebocenter.com/
- **Panel iPage**: [URL del panel de control de iPage]
- **FTP**: ftp://flebocenter.com
- **phpMyAdmin**: [Acceso desde panel de iPage]

## ⚡ Comandos Útiles para Después del Despliegue

Si tienes acceso SSH en iPage (poco común), puedes usar:
```bash
# Limpiar cachés si hay problemas
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear

# Regenerar cachés
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🆘 Contactos de Soporte
- **iPage Soporte**: [Número de teléfono/chat de iPage]
- **Desarrollador**: [Tu información de contacto]

## 📝 Notas Importantes
1. **CSRF Sistema**: Tu aplicación usa un sistema CSRF personalizado basado en archivos (VerifyCsrfFile.php) específico para iPage
2. **Sesiones**: Configurado para usar archivos en lugar de base de datos
3. **Logs**: Los errores se guardan en storage/logs/ - revisar en caso de problemas
4. **Seguridad**: En producción APP_DEBUG=false y logs solo muestran errores críticos

## 🔄 Proceso de Actualización Futura
1. Hacer cambios en desarrollo (local)
2. Exportar nueva base de datos si hay cambios
3. Subir archivos modificados por FTP
4. Importar cambios de BD si es necesario
5. Limpiar cachés en producción

---
**¡Tu aplicación FleboCenter está lista para flebocenter.com! 🚀**

## 📋 Resumen de Despliegue Simplificado

1. **Subir TODO**: La aplicación Laravel completa a `public_html/`
2. **Renombrar**: `.env.production` → `.env`  
3. **Configurar**: Contraseña de correo en `.env`
4. **Permisos**: storage/ y bootstrap/cache/ con 755/777
5. **Probar**: https://www.flebocenter.com/

**¡Despliegue directo al dominio principal! 🎉**