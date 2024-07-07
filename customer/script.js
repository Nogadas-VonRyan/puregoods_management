const form = document.querySelector('form');
const endpoint = 'api.php';
let productData;
let priceMap = {};

async function get() {
    const response = await fetch(endpoint);
    const data = await response.json();
    productData = data;

    if(displayIfEmpty(productData)) return;

    displayTable();
}
get();

function displayTable() {
    const table = document.querySelector('#table_body');

    for(const item of productData) {
        const row = document.createElement('tr');
        const {inputCell, priceCell} = createDynamicInputPrice(
            item.product_id,
            item.product_name,
            item.product_price);
        
        row.innerHTML = `
            <td>${item.product_name}</td>
            <td>${item.product_category}</td>
            <td>${item.product_price}</td>`;
        row.append(inputCell);
        row.append(priceCell);
        table.append(row);   
    }
}

async function insert() {
    const getInput = (param) => {
        return document.querySelector(param).value;
    }

    let customerData = {
        'first_name': getInput('#first_name'),
        'middle_name': getInput('#middle_name'),
        'last_name': getInput('#last_name'),
        'city': getInput('#city'),
        'street': getInput('#street'),
        'block': getInput('#block'),
        'date': getInput('#reserve_date'),
        'data': {
            'products': priceMap,
            'total': getTotalPrice()
        }
    };
    
    if(!validate(customerData)) {
        return;
    }

    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(customerData)
    };

    const response = await fetch(endpoint,options);
    const data = await response.text();
    console.log(data)
    displayModal('Successfully Reserved!','modal-success')
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
    get();
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
    get();
}

function createDynamicInputPrice(productId,productName,productPrice) {
    const total = document.querySelector('#total_price');

    const input = document.createElement('input');
    const price = document.createElement('div');

    priceMap[productName] = {};
    priceMap[productName].id = productId;
    priceMap[productName].price = 0;
    priceMap[productName].count = 0;

    input.setAttribute('type','number');
    input.setAttribute('min','0');
    input.setAttribute('max','100000');
    price.textContent = '₱0';

    input.addEventListener('input', ()=>{
        if(parseInt(input.value) < 0) input.value = 0;

        const result = parseInt(input.value) * productPrice;

        if(isNaN(result)) {
            price.textContent = '₱0';
            priceMap[productName].price = 0;
            priceMap[productName].count = input.value;
            total.value = '₱' + getTotalPrice();
            return;
        }
        
        price.textContent = '₱' + result;
        priceMap[productName].price = result;
        priceMap[productName].count = input.value;
        total.value = '₱' + getTotalPrice();
    });

    const inputCell = document.createElement('td');
    const priceCell = document.createElement('td');

    inputCell.append(input);
    priceCell.append(price);

    return {inputCell, priceCell};
}

function getTotalPrice() {
    let total = 0;
    for(const product in priceMap) {
        total += parseInt(priceMap[product]?.price ?? 0);
    }
    return total;
}

function validate(data) {
    for(let i in data) {
        if(data[i] == '') {
            i = i.replace(/_/g,' ');
            displayModal(`Missing ${i}. Please try again.`);
            return false;
        }
    }

    if(getTotalPrice() <= 0) {
        displayModal(`Total price bought is 0. Please buy something.`);
        return false;
    }

    return true;
}

function displayIfEmpty(data) {
    if (data.length != 0) return false;

    const table = document.querySelector('#table_body');
    table.innerHTML = '<tr><td colspan=5>Table is Empty</td></tr>';
    return true;
}