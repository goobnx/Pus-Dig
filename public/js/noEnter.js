$(document).on('keydown', function(e) {
    if (e.key === "Enter" && !$(e.target).is('textarea')) {
        e.preventDefault();
    }
});