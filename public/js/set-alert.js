// Alert Success
setTimeout(function() {
    let alertElement = document.getElementById('success-alert');
    if (alertElement) {
        alertElement.style.transition = "opacity 0.5s ease";
        alertElement.style.opacity = 0;
        setTimeout(function(){
            alertElement.remove();
        }, 600);
    }
}, 3000);

// Alert Info
setTimeout(function() {
    let alertElement = document.getElementById('info-alert');
    if (alertElement) {
        alertElement.style.transition = "opacity 0.5s ease";
        alertElement.style.opacity = 0;
        setTimeout(function(){
            alertElement.remove();
        }, 600);
    }
}, 3000);

// Alert Warning
setTimeout(function() {
    let alertElement = document.getElementById('warning-alert');
    if (alertElement) {
        alertElement.style.transition = "opacity 0.5s ease";
        alertElement.style.opacity = 0;
        setTimeout(function(){
            alertElement.remove();
        }, 600);
    }
}, 3000);

// Alert Error
setTimeout(function() {
    let alertElement = document.getElementById('error-alert');
    if (alertElement) {
        alertElement.style.transition = "opacity 0.5s ease";
        alertElement.style.opacity = 0;
        setTimeout(function(){
            alertElement.remove();
        }, 600);
    }
}, 5000);