<!DOCTYPE html>
<html>
<head>
    <title>Capturar Errores JavaScript</title>
    <style>
        body { font-family: monospace; padding: 20px; background: #1e1e1e; color: #fff; }
        #errors { background: #2d2d2d; padding: 15px; border-radius: 5px; margin-top: 20px; }
        .error-item { border-left: 3px solid #f44336; padding: 10px; margin: 10px 0; background: #3d2d2d; }
        .warning-item { border-left: 3px solid #ff9800; padding: 10px; margin: 10px 0; background: #3d3d2d; }
        .info-item { border-left: 3px solid #2196f3; padding: 10px; margin: 10px 0; background: #2d3d3d; }
        h2 { color: #4caf50; }
    </style>
</head>
<body>

<h2>🔍 Monitor de Errores JavaScript</h2>
<p>Este script capturará TODOS los errores JavaScript de la página dashboard.</p>

<div id="status">
    <p>⏳ Cargando dashboard en iframe...</p>
</div>

<div id="errors"></div>

<iframe id="dashboard" src="/dashboard" style="width: 100%; height: 500px; border: 2px solid #4caf50; margin-top: 20px;"></iframe>

<script>
let errorCount = 0;
let warningCount = 0;
const errorsDiv = document.getElementById('errors');
const statusDiv = document.getElementById('status');

// Capturar errores de la ventana principal
window.addEventListener('error', function(event) {
    logError('ERROR', event.message, event.filename, event.lineno, event.colno, event.error);
});

// Capturar errores de promesas no capturadas
window.addEventListener('unhandledrejection', function(event) {
    logError('PROMISE REJECTION', event.reason, '', '', '', null);
});

// Capturar errores del iframe
const iframe = document.getElementById('dashboard');
iframe.addEventListener('load', function() {
    statusDiv.innerHTML = '<p class="info-item">✅ Dashboard cargado</p>';
    
    try {
        const iframeWindow = iframe.contentWindow;
        const iframeDocument = iframe.contentDocument;
        
        // Interceptar console.error en el iframe
        iframeWindow.console.error = function(...args) {
            logError('CONSOLE.ERROR', args.join(' '), '', '', '', null);
            // Llamar al console.error original
            Function.prototype.apply.call(console.error, console, args);
        };
        
        // Interceptar console.warn
        iframeWindow.console.warn = function(...args) {
            logWarning('CONSOLE.WARN', args.join(' '));
            Function.prototype.apply.call(console.warn, console, args);
        };
        
        // Capturar errores del iframe
        iframeWindow.addEventListener('error', function(event) {
            logError('IFRAME ERROR', event.message, event.filename, event.lineno, event.colno, event.error);
        });
        
        // Verificar si jQuery existe
        setTimeout(() => {
            if (typeof iframeWindow.$ === 'undefined') {
                logError('CRITICAL', 'jQuery NO está cargado en el dashboard', '', '', '', null);
            } else {
                logInfo('jQuery versión: ' + iframeWindow.$.fn.jquery);
            }
            
            // Verificar si modernizr existe
            if (typeof iframeWindow.Modernizr !== 'undefined') {
                logWarning('MODERNIZR', 'Modernizr TODAVÍA está cargado (debe estar deshabilitado)');
            } else {
                logInfo('Modernizr NO está cargado (correcto)');
            }
            
            // Verificar elemento loading-wrapper
            const loadingWrapper = iframeDocument.getElementById('loading-wrapper');
            if (loadingWrapper) {
                logWarning('LOADING-WRAPPER', 'El elemento #loading-wrapper EXISTE en el DOM');
            } else {
                logInfo('El elemento #loading-wrapper NO existe (esperado)');
            }
            
            // Verificar contenido visible
            const contentWrapper = iframeDocument.querySelector('.content-wrapper');
            if (contentWrapper) {
                const styles = iframeWindow.getComputedStyle(contentWrapper);
                logInfo('Content wrapper - display: ' + styles.display + ', opacity: ' + styles.opacity + ', visibility: ' + styles.visibility);
            }
        }, 1000);
        
    } catch (e) {
        logError('IFRAME ACCESS', 'No se puede acceder al contenido del iframe: ' + e.message, '', '', '', e);
    }
});

function logError(type, message, filename, lineno, colno, error) {
    errorCount++;
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-item';
    errorDiv.innerHTML = `
        <strong>❌ ${type}</strong><br>
        <strong>Mensaje:</strong> ${message}<br>
        ${filename ? `<strong>Archivo:</strong> ${filename}<br>` : ''}
        ${lineno ? `<strong>Línea:</strong> ${lineno}:${colno}<br>` : ''}
        ${error && error.stack ? `<strong>Stack:</strong><br><pre>${error.stack}</pre>` : ''}
        <strong>Hora:</strong> ${new Date().toLocaleTimeString()}
    `;
    errorsDiv.appendChild(errorDiv);
    
    // Actualizar contador
    statusDiv.innerHTML = `<p class="error-item">❌ ${errorCount} errores encontrados | ⚠️ ${warningCount} advertencias</p>`;
}

function logWarning(type, message) {
    warningCount++;
    const warningDiv = document.createElement('div');
    warningDiv.className = 'warning-item';
    warningDiv.innerHTML = `
        <strong>⚠️ ${type}</strong><br>
        <strong>Mensaje:</strong> ${message}<br>
        <strong>Hora:</strong> ${new Date().toLocaleTimeString()}
    `;
    errorsDiv.appendChild(warningDiv);
    
    statusDiv.innerHTML = `<p>❌ ${errorCount} errores | ⚠️ ${warningCount} advertencias</p>`;
}

function logInfo(message) {
    const infoDiv = document.createElement('div');
    infoDiv.className = 'info-item';
    infoDiv.innerHTML = `
        <strong>ℹ️ INFO:</strong> ${message}<br>
        <strong>Hora:</strong> ${new Date().toLocaleTimeString()}
    `;
    errorsDiv.appendChild(infoDiv);
}

// Verificar después de 5 segundos
setTimeout(() => {
    if (errorCount === 0 && warningCount === 0) {
        statusDiv.innerHTML = '<p class="info-item">✅ NO se detectaron errores ni advertencias</p>';
    }
}, 5000);
</script>

</body>
</html>
