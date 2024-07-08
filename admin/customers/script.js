const endpoint = 'api.php';
let customerData;

async function get() {
    const response = await fetch(endpoint);
    const data = await response.json();
    customerData = data;

    if(displayIfEmpty(customerData)) return;

    displayTable();
}
get();

async function remove(customerId) {
    const options = {
		method: "DELETE",
		headers: {
			"Content-type": "application/x-www-form-urlencoded",
		},
		body: `customer_id=${customerId}`,
	};

	const response = await fetch(endpoint, options);
    const data = await response.json();
	get();

	if (data?.error == "active")
		displayModal(`Customer is still active on other reservations.
        Please delete all instances to delete this.`);
}

function displayTable() {
    const table = document.querySelector('#table_body');
    table.innerHTML = '';

    for(const item of customerData) {
        const row = document.createElement('tr');
        const {removeCell} = createButton(item.customer_id);
        
        row.innerHTML = `
            <td>${item.first_name} ${item.middle_name} ${item.last_name}</td>
            <td>${item.city} ${item.street} ${item.block}</td>
            <td>₱${item['sum(total_price)']}</td>`;
        row.append(removeCell);
        table.append(row);   
    }
}

function createButton(customerId) {
    const removeButton = document.createElement('button');
    removeButton.textContent = 'Delete';
    removeButton.addEventListener('click', remove.bind(null,customerId));
    const removeCell = document.createElement('td');
    removeCell.append(removeButton);

    return {removeCell};
}

function displayIfEmpty(data) {
	if (data.length != 0) return false;

	const table = document.querySelector("#table_body");
	table.innerHTML = "<tr><td colspan=6>Table is Empty</td></tr>";
	return true;
}