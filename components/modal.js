let modal = document.getElementById("myModal");
let btn = document.getElementById("myBtn");
let message = document.querySelector("#modal_message");

function displayModal(value) {
    modal.style.display = "block";
    message.textContent = value;
}

window.onclick = function (event) {
	if (event.target == modal ) {
		modal.style.display = "none";
	}
};
