// Wait for the DOM to fully load
document.addEventListener('DOMContentLoaded', () => {
    // Select the Save button
    const darkModeFont = document.getElementById('dark-mode-font');
    const lightModeFont = document.getElementById('light-mode-font');
    let darkmode = localStorage.getItem('darkmode');

    const onDarkMode = () => {
        document.body.classList.add('darkmode');
        localStorage.setItem('darkmode', 'active');
    };

    const offDarkMode = () => {
        document.body.classList.remove('darkmode');
        localStorage.setItem('darkmode', null);
    };

    if (darkmode === 'active') {
        onDarkMode();
    }

    // Add a click event listener
    darkModeFont.addEventListener('click', (event) => {
        event.preventDefault();
        darkmode = localStorage.getItem('darkmode');
        if (darkmode !== 'active') {
            onDarkMode();
        } else {
            alert("Dark Mode is on");
        }
    });

    lightModeFont.addEventListener('click', (event) => {
        event.preventDefault();
        darkmode = localStorage.getItem('darkmode');
        if (darkmode == 'active') {
            offDarkMode();
        } else {
            alert("Light Mode is on");
        }
    });
});