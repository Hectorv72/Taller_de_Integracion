let divSecciones = document.getElementById('secciones');
let numActualizador = 0;


async function obtenerTurnos(){
    const response = await fetch("../../api/turnos");
    return response.json();
}

async function actualizarLista(json){
    numActualizador = 0;
    listado = "";
    json.cajas.map(element => {

        listado += `
        <div class="form-group">
            <div id="seccion-1">               
                <strlong>Caja ${element.id}</strlong>
                <h5>Turno: ${element.turno}</h5>
            </div>
        </div>
        `;
        numActualizador += parseInt(element.turno);
    });

    return listado
}

async function actualizarTurnos(){
    
    obtenerTurnos().then((json)=>{
        actualizarLista(json).then((listado)=>{
            divSecciones.innerHTML = listado;
        });
    });

}

async function esperarRespuesta(){
    const response = await fetch("../../api/actualizacion/turnos/"+numActualizador);
    const json     = await response.json();
    //console.log(json);
    if(json.actualizacion == true){
        actualizarTurnos();
    }
}
esperarRespuesta();
setInterval(esperarRespuesta,5000);