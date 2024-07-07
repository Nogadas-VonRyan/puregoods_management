let reservationData;
const endpoint = 'api.php';

async function get() {
    const response = await fetch('api.php');
    const data = await response.json();

    reservationData = data;

    if(displayIfEmpty(reservationData)) return;

    displayTable();
}
get();

async function update(reservationId,column,value) {
    value = (value)? 1 : 0;

    const options = {
        method: 'PATCH',
        headers: {
            "Content-type": "application/x-www-form-urlencoded",
        }, 
        body: `column=${column}&\
            ${column}=${value}&\
            reservation_id=${reservationId}`
    };

    const response = await fetch('api.php',options);
    const data = await response.text();
    console.log(data);
}

async function remove(reservationId) {
    const options = {
        method: 'DELETE',
        headers: {
            "Content-type": "application/x-www-form-urlencoded",
        },
        body: `reservation_id=${reservationId}`
    }

    const response = await fetch(endpoint,options);
    const data = await response.text();
    console.log(data);
    get();
}

function displayTable() {
    const table = document.querySelector('#table_body');
    table.innerHTML = '';

    for(const item of reservationData) {
        const row = document.createElement('tr');
        const {claimCell, paidCell, viewCell, removeCell} = createButton(
            item.reservation_id,
            item.is_claimed,
            item.is_paid);

        row.innerHTML = `
            <td>${item.first_name} ${item.last_name}</td>
            <td>${item.date_payment}</td>
            <td>${item.total_price}</td>`;

        row.append(claimCell);
        row.append(paidCell);
        row.append(viewCell);
        row.append(removeCell);
        table.append(row);
    }
}

function createButton(reservationId, isClaimed, isPaid) {
    let claim = document.createElement('button');
    let paid = document.createElement('button');
    let view = document.createElement('button');
    let removeButton = document.createElement('button');

    claim.textContent = (isClaimed)? 'Claimed' : 'Not Claimed';
    paid.textContent = (isPaid)? 'Paid' : 'Not Paid';
    view.textContent = 'View';
    removeButton.textContent = 'Delete';

    let claimValue = isClaimed;
    let paidValue = isPaid;

    claim.addEventListener('click', () => {
        claimValue = !claimValue;
        claim.textContent = (claimValue)? 'Claimed' : 'Not Claimed';
        update(reservationId,'is_claimed',claimValue);
    });
    paid.addEventListener('click', () => {
        paidValue = !paidValue;
        paid.textContent = (paidValue)? 'Paid' : 'Not Paid';
        update(reservationId,'is_paid',paidValue);
    });
    view.addEventListener('click', async () => {
        const formData = new FormData();
        formData.append('reservation_id',reservationId);
        
        const options = {
            method: 'POST',
            body: formData
        };

        const response = await fetch(endpoint, options);
        const data = await response.json();

        displayModalTable(data);
    })
    removeButton.addEventListener('click', remove.bind(null,reservationId));

    claimCell = document.createElement('td');
    paidCell = document.createElement('td');
    viewCell = document.createElement('td');
    removeCell = document.createElement('td');
    
    claimCell.append(claim);
    paidCell.append(paid)
    viewCell.append(view);
    removeCell.append(removeButton);

    return {claimCell, paidCell, viewCell, removeCell};
}

function displayIfEmpty(data) {
    if (data.length != 0) return false;

    const table = document.querySelector('#table_body');
    table.innerHTML = '<tr><td colspan=7>Table is Empty</td></tr>';
    return true;
}