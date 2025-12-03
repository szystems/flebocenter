javascript:(function(){
    const info = {
        'Console Errors': [],
        'DOM Content': document.body ? document.body.innerHTML.substring(0, 1000) : 'No body',
        'Scripts': Array.from(document.querySelectorAll('script[src]')).map(s => s.src),
        'Main Divs': Array.from(document.querySelectorAll('.content, .main-content, #content, main')).map(d => d.className + ' - ' + d.innerHTML.length + ' chars'),
        'Body Classes': document.body ? document.body.className : 'No body',
        'Title': document.title
    };
    
    // Capturar errores de consola
    const originalError = console.error;
    console.error = function(...args) {
        info['Console Errors'].push(args.join(' '));
        originalError.apply(console, args);
    };
    
    setTimeout(() => {
        const json = JSON.stringify(info, null, 2);
        const blob = new Blob([json], {type: 'application/json'});
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'dashboard-debug.json';
        a.click();
    }, 3000);
    
    alert('Esperando 3 segundos para capturar info del dashboard...');
})();