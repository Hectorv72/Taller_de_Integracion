let divSecciones = document.getElementById('secciones');
let numActualizador = 0;

function actualizarLista(json){

    numActualizador = 0;
    listado = "";

    json = json.content;

    listado = '<div class="row ">';
    json.cajas.map(element => {

        if(element.turno != 0){

            listado += `
            <div class="col-sm-3 margin-bottom30 text-center">
                <div class="fact-box">                        
                    <h5>Caja ${element.id}</h5>
                    <h4 class="text-success">Turno</h4>
                    <h2>${element.turno}</h2>
                    <span class="border-line"></span>
                </div>
            </div><!--fact cols-->
            `;
            numActualizador += parseInt(element.turno);
        }

    });

    listado += '</div>';

    return listado;
}

async function actualizarTurnos(json){

    const listahtml = await actualizarLista(json);
    divSecciones.innerHTML = listahtml;
}


async function verificarActualizacion(){

    const response = await fetch("./api/cajas");
    const json = await response.json();

    let cantTurnos = 0;

    if(json.state == "correcto"){
        json.content.cajas.forEach(element => cantTurnos += parseInt(element.turno));

        if(cantTurnos != 0){
            if(cantTurnos != numActualizador){
                actualizarTurnos(json);
            }
        }else{
            divSecciones.innerHTML = "<div>No estan atendiendo turnos ahora</div>";
        }
    }else{
        divSecciones.innerHTML = "<div>Error, recargue la pagina</div>";
    }
    
    
}

verificarActualizacion();
setInterval(verificarActualizacion,5000);