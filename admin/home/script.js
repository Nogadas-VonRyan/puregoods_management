const form = document.querySelector('form');

async function validation() {
    const formData = new FormData();
    const options = {
        method: 'POST',
        body: formData
    };
    
    const response = await fetch('api.php', options);
    const data = response.json();
    console.log(data)
}