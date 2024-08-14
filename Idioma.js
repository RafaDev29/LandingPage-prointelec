document.addEventListener('DOMContentLoaded', function() {
    var languageLabels = document.querySelectorAll(".language");

    languageLabels.forEach(function(label) {
        label.addEventListener('click', function() {
            var selectedLang = label.getAttribute('data-lang');
            sessionStorage.setItem('idioma', selectedLang);

            // Verificar si ya estamos en la página correcta antes de redirigir
            if ((selectedLang === 'en' && !window.location.href.includes('/en/')) ||
                (selectedLang === 'es' && window.location.href.includes('/en/'))) {
                location.href = selectedLang === 'en' ? "en/index.html" : "../index.html";
            }
        });
    });

    window.onload = function() {
        var idiomaGuardado = sessionStorage.getItem('idioma');
        if (idiomaGuardado === 'en' && !window.location.href.includes('/en/')) {
            location.href = "en/index.html";
        } else if (idiomaGuardado === 'es' && window.location.href.includes('/en/')) {
            location.href = "../index.html";
        }
    };
});
