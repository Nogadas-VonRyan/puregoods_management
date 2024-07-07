let modal = document.getElementById("myModal");
let btn = document.getElementById("myBtn");
let message = document.querySelector("#modal_message");
let content = document.querySelector('.modal-content');

function displayModal(value, type='modal-danger') {
    modal.style.display = "block";
    message.textContent = value;
    content.classList.remove('modal-danger');
    content.classList.remove('modal-success');
    content.classList.add(type)
}

function displayModalTable(json) {
    content.innerHTML = "";

    modal.style.display = "block";
    content.classList.remove('modal-danger');
    content.classList.remove('modal-success');    
    table = document.createElement('table');
    content.innerHTML = '<h2>List of Products</h2>';
    content.append(table);
    table.innerHTML = `
        <tr>
            <th>Product</th>
            <th>Quantity</th>
        </tr>`;
    
    
    for(const item of json) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.product_name}</td>
            <td>${item.product_count}</td>`;
        table.append(row);
    }
}

window.onclick = function (event) {
	if (event.target == modal ) {
		modal.style.display = "none";
	}
};
