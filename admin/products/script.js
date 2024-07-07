const form = document.querySelector("form");
const name = document.querySelector("#product_name");
const category = document.querySelector("#product_category");
const price = document.querySelector("#product_price");

const endpoint = "api.php";
let productData;
let updateId;

async function get() {
	console.log("get");
	const response = await fetch(endpoint);
	const data = await response.json();
	productData = data;

	if (displayIfEmpty(productData)) return;

	displayTable();
}
get();

function displayTable() {
	const table = document.querySelector("#table_body");
	table.innerHTML = "";

	for (const item of productData) {
		const row = document.createElement("tr");
		row.innerHTML = `
            <td>${item.product_name}</td>
            <td>${item.product_category}</td>
            <td>${item.product_price}</td>`;
		const { editCell, removeCell } = createButton(
			item.product_id,
			item
		);
		row.append(editCell);
		row.append(removeCell);
		table.append(row);
	}
}

async function insert() {
	formData = new FormData(form);
	const options = {
		method: "POST",
		body: formData,
	};
	const response = await fetch(endpoint, options);
	const data = response.text();
	get();
}

async function update() {
	const options = {
		method: "PATCH",
		headers: {
			"Content-type": "application/x-www-form-urlencoded",
		},
		body: `product_id=${updateId}&\
            product_name=${name.value}&\
            product_category=${category.value}&\
            product_price=${price.value}`,
	};

	const response = await fetch(endpoint, options);
	const data = await response.text();
	swapSubmitAndEdit(true);
	get();
}

async function remove(productId) {
	const options = {
		method: "DELETE",
		headers: {
			"Content-type": "application/x-www-form-urlencoded",
		},
		body: `product_id=${productId}`,
	};

	const response = await fetch(endpoint, options);
    const data = await response.json();
	get();

	if (data == "active")
		displayModal(`Product is still active on other reservations.
        Please delete all instances to delete this.`);
}

function createButton(productId, product) {
	let editButton = document.createElement("button");
	let removeButton = document.createElement("button");

	editButton.textContent = "Edit";
	removeButton.textContent = "Delete";

	editButton.addEventListener("click", () => {
		const product_input = document.querySelector("#product_name");
		let node = product_input;
		let navheight = 120;

		node.scrollIntoView(true);
		let scrolledY = window.scrollY;

		if (scrolledY) {
			window.scroll(0, 0);
		}

		name.value = product.product_name;
		category.value = product.product_category;
		price.value = product.product_price;

		updateId = productId;
		swapSubmitAndEdit(false);
	});
	removeButton.addEventListener("click", remove.bind(null, productId));

	editCell = document.createElement("td");
	removeCell = document.createElement("td");

	editCell.append(editButton);
	removeCell.append(removeButton);

	return { editCell, removeCell };
}

function displayIfEmpty(data) {
	if (data.length != 0) return false;

	const table = document.querySelector("#table_body");
	table.innerHTML = "<tr><td colspan=6>Table is Empty</td></tr>";
	return true;
}

function swapSubmitAndEdit(value) {
	console.log(value);
	const button = document.querySelector("#insert_button");
	if (value) {
		button.onclick = insert;
		button.textContent = "Add";
	} else {
		button.onclick = update;
		button.textContent = "Edit";
	}
}

function filterCategory() {
    const table = document.querySelector("#table_body");
    const filter = document.querySelector('#filter_category');
	table.innerHTML = "";

    console.log(filter.value)

	for (const item of productData) {
        if(filter.value != 'all' && item.product_category != filter.value) continue;

		const row = document.createElement("tr");
		row.innerHTML = `
            <td>${item.product_name}</td>
            <td>${item.product_category}</td>
            <td>${item.product_price}</td>`;
        const { editCell, removeCell } = createButton(
            item.product_id,
            item
        );
        row.append(editCell);
        row.append(removeCell);
		table.append(row);
	}
}