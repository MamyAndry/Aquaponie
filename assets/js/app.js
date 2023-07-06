function createXhr(){
	let xhr ;
	try {
		xhr = new ActiveXObject('Msxml2.XMLHTTP');
	} catch(e) {
		try {
			xhr = new ActiveXObject('Microsoft.XMLHTTP');
		} catch(e) {
			try{
				xhr = new XMLHttpRequest();
			}catch(e){
				console.log("Failed to create xhr" + e);
			}
		}
	}
	return xhr;
}


function removeAllDetails(){
	let documents = document.getElementById("details-container");
	while( documents.firstChild ){
		documents.removeChild(documents.firstChild);
	}
}

function addDetails(){
	let details = document.getElementById("details-container");
	
	// Azo ny details rehetra
	// Ampidirina anaty tbody
	
	let formModal = document.getElementById("form-modal");
	let fish = formModal.querySelector('#fish');
	let quantity = formModal.querySelector('#quantity');

	let fish_input = createInput( fish.value, 'fish' );
	let quantity_input = createInput( quantity.value, 'quantity' );

	let row = createRow( fish_input, quantity_input );
	details.appendChild( row );
	resetModalForm();
}

function addDetailsFields(){
	let details = document.getElementById("details-container");

	// Azo ny details rehetra
	// Ampidirina anaty tbody

	let formModal = document.getElementById("form-modal");
	let plantation = formModal.querySelector('#plantation');
	let weight = formModal.querySelector('#plant_weight');
	let density = formModal.querySelector('#density');
	let surface_covered = formModal.querySelector('#surface');
	let date = formModal.querySelector('#date');

	let plantation_input = createInput( plantation.value, 'plantation' );
	let weight_input = createInput( weight.value, 'plant_weight' );
	let density_input = createInput( density.value, 'density' );
	let surface_covered_input = createInput( surface_covered.value, 'surface_covered' );
	let date_input = createInput( date.value, 'date' );

	let row = createRowFields( plantation_input,weight_input, density_input, surface_covered_input, date_input);
	details.appendChild( row );
	resetModalForm();
}

function createInput( text, identification ){
	let element = document.createElement("input");
	element.setAttribute('type', 'text');
	element.classList.add('form-control');
	element.classList.add('border-0');
	element.value = text;
	element.setAttribute('name' , identification + '[]');
	return element;
}

function resetModalForm(){
	let formModal = document.getElementById("form-modal");
	let plantation = formModal.querySelector('#plantation');
	let plant_weight = formModal.querySelector('#plant_weight');
	let density = formModal.querySelector('#density');
	let surface = formModal.querySelector('#surface');
	let date = formModal.querySelector('#date');
	plantation.selectedIndex = 0;
	plant_weight.value = 0;
	density.value = 0;
	surface.value = 0;
}

function createRow( fish, quantity,  ){
	let tr = document.createElement("tr");
	let td1 = document.createElement("td");
	let td2 = document.createElement("td");
	td1.appendChild(fish);
	td2.appendChild(quantity);
	tr.appendChild(td1);
	tr.appendChild(td2);
	// let td3 = document.createElement("td");
	// let close = document.createElement("i");
	// td3.appendChild(close);
	// close.classList.add('fas');
	// close.classList.add('fa-times');
	// tr.appendChild(td3);
	return tr;
}

function createRowFields( plantation, weight, density, surface_covered, date  ){
	let tr = document.createElement("tr");
	let td1 = document.createElement("td");
	let td2 = document.createElement("td");
	let td3 = document.createElement("td");
	let td4 = document.createElement("td");
	let td5 = document.createElement("td");
	td1.appendChild(density);
	td2.appendChild(surface_covered);
	td3.appendChild(plantation)
	td4.appendChild(weight);
	td5.appendChild(date);
	tr.appendChild(td1);
	tr.appendChild(td2);
	tr.appendChild(td3);
	tr.appendChild(td4);
	tr.appendChild(td5);
	return tr;
}


function validate_ponds( url, redirection ){
	let xhr = createXhr();
	let form = document.querySelector('#general-form');
	let datas = new FormData(form);
	xhr.onreadystatechange = function(){
		if( xhr.readyState === 4 ){
			if( xhr.status === 200 ){
				let response = JSON.parse(xhr.responseText);
				let success = response['success'];
				alert(success);
				window.location.href = redirection;
			}else if( xhr.status === 400 ){
				let response = JSON.parse(xhr.responseText);
				let error = response['error'];
				alert(error);
			}
		}
	};

	xhr.open('POST' , url , true);
	xhr.send(datas);
}