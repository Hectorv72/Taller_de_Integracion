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
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
                <div class="form-group">
                    <div style="padding-top:20px;" class="form-control" id="seccion-${element.id}">  
                        <div class="text-center">
                            <strlong>Caja ${element.id}</strlong>
                        </div>
                        <hr>
                        <div class="form-group text-center">             
                            <h5>Turno: ${element.turno}</h5>
                        </div>
                   </div>
                </div>
            </div>
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

    const response = await fetch("../api/cajas");
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