document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
});
document.onkeydown = function(e) {
    if (e.ctrlKey && e.shiftKey && e.key === 'i') {
        return false;
    }
    if (e.ctrlKey && e.shiftKey && e.key === 'j') {
        return false;
    }
    if (e.ctrlKey && e.key === 'u') {
        return false;
    }
}
