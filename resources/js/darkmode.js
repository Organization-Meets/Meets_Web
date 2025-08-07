const themeSwitch = document.getElementById('theme-switch');
const body = document.body;

// Carrega o tema salvo
if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('dark-mode');
    themeSwitch.checked = true;
}

themeSwitch.addEventListener('change', () => {
    if (themeSwitch.checked) {
        body.classList.add('dark-mode');
        localStorage.setItem('theme', 'dark');
    } else {
        body.classList.remove('dark-mode');
        localStorage.setItem('theme', 'light');
    }
});