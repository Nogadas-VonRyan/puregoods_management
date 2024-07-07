const form = document.querySelector('form');
const endpoint = 'api.php';
let productData;

async function get() {
    const response = await fetch(endpoint);
    const data = await response.json();
    productData = data;
    displayTable();
}
get();

function displayTable() {
    const table = document.querySelector('#table_body');
    table.innerHTML = '';

    for(const item of productData) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.product_name}</td>
            <td>${item.product_category}</td>
            <td>${item.product_price}</td>`;
        table.append(row);   
    }
}

async function insert() {
    formData = new FormData(form);
    const options = {
        method: 'POST',
        body: formData
    };
    const response = await fetch(endpoint,options);
    const data = response.text();
    console.log(data);
    get();
}

async function update() {
    const options = {
        method: 'PATCH',
        headers: {
            "Content-type": "application/x-www-form-urlencoded",
        },
        body: `product_id=${productId}`
    }

    const response = await fetch(endpoint,options);
    const data = await response.text();
    console.log(data)
    displayTable();
}

async function remove(productId) {
    const options = {
        method: 'DELETE',
        headers: {
            "Content-type": "application/x-www-form-urlencoded",
        },
        body: `product_id=${productId}`
    }

    const response = await fetch(endpoint,options);
    const data = await response.text();
    console.log(data,productId)
    get();
}

function createButton(productId) {
    let editButton = document.createElement('button');
    let removeButton = document.createElement('button');

    editButton.textContent = 'Edit';
    removeButton.textContent = 'Delete';

    editButton.addEventListener('click', ()=>{

    });
    removeButton.addEventListener('click', remove.bind(null,productId));

    editCell = document.createElement('td');
    removeCell = document.createElement('td');
    
    editCell.append(editButton);
    removeCell.append(removeButton)

    return {editCell, removeCell};
}