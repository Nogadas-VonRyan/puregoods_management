const form = document.querySelector('form');

async function validation() {
    const formData = new FormData(form);
    const options = {
        method: 'POST',
        body: formData
    };
    
    const response = await fetch('api.php', options);
    const data = await response.json();

    if(Object.keys(data)[0] == 'error') {
        displayModal('Incorrect credentials.');
    }

    if(Object.keys(data)[0] == 'status') {
        window.location.replace('../home');
    }
}