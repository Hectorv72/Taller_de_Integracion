let divSecciones = document.getElementById('secciones');
let numActualizador = 0;


async function obtenerTurnos(){
    const response = await fetch("../api/turnos");
    return response.json();
}

async function actualizarLista(json){
    numActualizador = 0;
    listado = "";

    json = json.content;
    listado = '<div class="row">';
    json.cajas.map(element => {

        listado += `
        <div class="col-md-3">
            <div class="form-group">
                 <div id="seccion-${element.id}">               
                    <strlong>Caja ${element.id}</strlong>
                    <h5>Turno: ${element.turno}</h5>
               </div>
            </div>
        </div>
        `;
        numActualizador += parseInt(element.turno);

    });
    listado += '</div>';

    return listado
}

async function actualizarTurnos(){
    
    obtenerTurnos().then((json)=>{
        if(json.state == "correcto"){
            actualizarLista(json).then((listado)=>{
                divSecciones.innerHTML = listado;
            });
        }else{
            divSecciones.innerHTML = "<div>No estan atendiendo turnos ahora</div>";
        }
        
    });

}

async function esperarRespuesta(){
    const response = await fetch("../api/actualizacion/turnos",{
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
        body: JSON.stringify({dato : numActualizador})
    });
    const json = await response.json();

    if(json.actualizacion == true){
        actualizarTurnos();
    }
    
}
esperarRespuesta();
setInterval(esperarRespuesta,5000);