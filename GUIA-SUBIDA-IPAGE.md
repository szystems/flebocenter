# 📋 GUÍA DE SUBIDA LIMPIA A IPAGE

## ✅ ARCHIVOS CORREGIDOS LOCALMENTE

1. **`.env.production`** - Configurado correctamente:
   - ✅ APP_URL=https://flebocenter.com (sin www)
   - ✅ SESSION_DRIVER=file
   - ✅ SESSION_DOMAIN=null
   - ✅ SESSION_ENCRYPT=false
   - ✅ DB credenciales correctas

2. **`bootstrap/app.php`** - Laravel 12 fix aplicado:
   - ✅ Config repository registrado manualmente
   - ✅ Fallback si no existe cache

3. **`app/Http/Kernel.php`** - Middleware correcto:
   - ✅ VerifyCsrfToken activo
   - ✅ VerifyCsrfFile comentado

4. **`bootstrap/cache/`**:
   - ✅ services.php (correcto)
   - ✅ packages.php (correcto)
   - ❌ NO existe config.php (se regenerará en servidor)

---

## 📤 PASO 1: SUBIR POR FTP

### Archivos a SUBIR (sobrescribir):
```
├── bootstrap/
│   ├── app.php ⭐ IMPORTANTE (fix Laravel 12)
│   └── cache/
│       ├── services.php
│       └── packages.php
├── app/
│   └── Http/
│       └── Kernel.php
├── config/
│   └── (todos los archivos .php)
└── public/
    └── index.php
```

### Archivo a RENOMBRAR en servidor:
```
En el servidor:
.env → .env.old-backup
.env.production → .env
```

### Archivos a NO SUBIR:
```
❌ .env (usar .env.production y renombrarlo)
❌ storage/ (mantener el del servidor)
❌ vendor/ (ya existe en servidor)
❌ node_modules/
❌ public/*.php de debug (eliminarlos del servidor)
```

---

## 🔧 PASO 2: LIMPIAR SERVIDOR

### En File Manager de iPage, eliminar estos archivos de debug:
```
public/captura-bootstrap-error.php
public/captura-con-debug.php
public/captura-error-final.php
public/debug-exhaustivo.php
public/diagnostico-csrf.php
public/eliminar-cache-corrupto.php
public/error-500-login.php
public/fix-urgente-env.php
public/generar-cache-manual.php
public/index-debug.php
public/index-original.php (si existe)
public/limpieza-profunda.php
public/opcion-nuclear.php
public/regenerar-cache.php
public/reparar-500.php
public/reparar-permisos.php
public/reparar-sesiones.php
public/solucion-definitiva-419.php
public/ver-error-500.php
public/ver-logs-laravel.php
```

### Eliminar cache corrupto en servidor:
```
bootstrap/cache/config.php (si existe, eliminarlo)
```

---

## ⚙️ PASO 3: REGENERAR CACHE EN SERVIDOR

### Opción A: Via regenerar-cache-artisan.php (MANTENER ESTE)
1. Sube `public/regenerar-cache-artisan.php` si no existe
2. Ejecuta: https://flebocenter.com/regenerar-cache-artisan.php
3. Verifica que se generen:
   - ✅ bootstrap/cache/config.php (~50KB)
   - ✅ bootstrap/cache/services.php (~23KB)
   - ✅ bootstrap/cache/routes-v7.php (~200KB)

### Opción B: Via SSH (si tienes acceso)
```bash
cd /hermes/bosnacweb08/bosnacweb08ai/b2263/ipg.szclinicascom/szystems/flebonuevo3
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🔄 PASO 4: REINICIAR SERVIDOR

**CRÍTICO:** Reiniciar PHP-FPM para limpiar OPcache

### Método 1: Panel de Control iPage
1. PHP Settings → Versión PHP
2. Cambiar: 8.3 → Guardar
3. Esperar 10 segundos
4. Cambiar: 8.2 → Guardar
5. Esperar 10 segundos
6. Cambiar: 8.3 → Guardar
7. Esperar 2-3 minutos

### Método 2: Contactar Soporte
Mensaje:
```
Hola, necesito reiniciar PHP-FPM para el dominio flebocenter.com
Ubicación: /hermes/bosnacweb08/bosnacweb08ai/b2263/ipg.szclinicascom/szystems/flebonuevo3
```

---

## 🧪 PASO 5: PROBAR

1. **Limpiar navegador:**
   - F12 → Application → Cookies
   - Eliminar TODAS las cookies de flebocenter.com
   - Cerrar TODO el navegador (proceso completo)

2. **Probar en incógnito:**
   - Abrir ventana incógnita/privada
   - Ir a: https://flebocenter.com
   - Verificar que carga la home
   - Ir a: https://flebocenter.com/login
   - Intentar login con credenciales reales

3. **Si funciona:**
   - ✅ Eliminar `public/regenerar-cache-artisan.php`
   - ✅ Confirmar que CRUD funciona
   - ✅ FIN

4. **Si sigue Error 419:**
   - Ejecutar: https://flebocenter.com/regenerar-cache-artisan.php de nuevo
   - Reiniciar servidor de nuevo
   - Probar en otro navegador diferente

---

## 🚨 TROUBLESHOOTING

### Error 500 al cargar cualquier página:
- Verificar que `bootstrap/app.php` se subió correctamente
- Verificar permisos de `storage/` (755)

### Error 419 persiste:
- Verificar que `.env` tiene SESSION_DOMAIN=null
- Ejecutar regenerar-cache-artisan.php
- Reiniciar servidor
- Limpiar cookies COMPLETAMENTE

### Página en blanco:
- Verificar que `public/index.php` es el correcto
- Verificar que `.env` existe y tiene APP_KEY

---

## 📞 CONTACTOS IMPORTANTES

**iPage Soporte:**
- Web: https://www.ipage.com/support
- Teléfono: 1-877-472-4399

**Información del Hosting:**
- Path: /hermes/bosnacweb08/bosnacweb08ai/b2263/ipg.szclinicascom/szystems/flebonuevo3
- PHP: 8.3.12
- MySQL: szclinicascom.ipagemysql.com

---

## ✅ CHECKLIST FINAL

Antes de declarar victoria, verificar:

- [ ] Home (/) carga correctamente
- [ ] /login muestra el formulario
- [ ] Login con credenciales reales funciona
- [ ] Redirección post-login correcta
- [ ] Dashboard carga
- [ ] CRUD básico funciona (crear, leer, editar, eliminar)
- [ ] No hay Error 419
- [ ] No hay Error 500
- [ ] Sessions persisten (no pide login constantemente)

---

**ÚLTIMA ACTUALIZACIÓN:** 2025-11-28

**CAMBIOS CRÍTICOS APLICADOS:**
1. ✅ bootstrap/app.php - Fix Laravel 12 config repository
2. ✅ .env.production - SESSION_DRIVER=file, SESSION_DOMAIN=null
3. ✅ Cache limpio (sin config.php corrupto)
4. ✅ Todos los scripts de debug listos para eliminar
