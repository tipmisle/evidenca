//ELEMENTI
var datumcas = document.getElementById('datumcas');
var gordol = document.getElementById('sedanjost');




//funkcija za trenutni čas in datum
function currentDateTime() {
	var dt = new Date();
	datumcas.innerHTML = dt.toLocaleString();
}


//EVENT LISTENERJI IN TRIGGERJI METOD
window.setInterval(currentDateTime, 1000);