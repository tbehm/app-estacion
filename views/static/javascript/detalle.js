// Evento que se ejecuta cuando se carga completamente la página
document.addEventListener("DOMContentLoaded", () => {

	const params = new URLSearchParams(document.location.search);
	const id = params.get('chipid');
	loadEstacion().then( data => {

		// recorremos el listado de estaciones
		data.forEach(function(element, index){
			if(element.chipid == id){
				addEstacion(element)
				return;
			}
		})
	})
	
})

// Petición asincrona de la lista de estaciones
async function loadEstacion(){
	const headers = {'Content-Type':'application/json',
                    'Access-Control-Allow-Origin':'*',
                    'Access-Control-Allow-Methods':'POST,PATCH,OPTIONS'}
	const response = await fetch("https://mattprofe.com.ar/proyectos/app-estacion/datos.php?mode=list-stations",{
		headers:{
			mode:'no-cors'

		}
	})
	const data = await response.json()
	return data
}

// Crea un nuevo botón con los datos de info
function addEstacion(info){

	let tpl = document.querySelector("#tpl-btn-estacion")
	let clon = tpl.content.cloneNode(true)

	// cargamos los datos del botón clonado

	clon.querySelector(".estacion-ubicacion").innerHTML= '<i class="fas fa-map-marker-alt color-ubicacion"></i>&nbsp'+info.ubicacion
	clon.querySelector(".estacion-nombre").innerHTML = info.apodo
	clon.querySelector(".estacion").addEventListener('click',e=>{
		window.location.href= "./"
	})
	// Agrega un nuevo botón de estación
	document.querySelector("#estaciones").appendChild(clon)
}
