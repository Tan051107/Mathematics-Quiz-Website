document.addEventListener('DOMContentLoaded', () => {
    // Select the Save button
    const themeSwitchButton = document.getElementById('theme-switch-button');
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
    themeSwitchButton.addEventListener('click', (event) => {
        event.preventDefault();
        darkmode = localStorage.getItem('darkmode');
        if (darkmode !== 'active') {
            onDarkMode();
        } else {
            offDarkMode();
        }
    });

});
