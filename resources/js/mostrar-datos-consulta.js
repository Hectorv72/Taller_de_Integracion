const divDatosConsultaHead = document.getElementById("datos-consulta-head");
const divDatosConsultaBody = document.getElementById("datos-consulta-body");
const id_user              = document.getElementById("usuario-id").value;

async function getDatosConsulta(){
    const response = await fetch("../api/detalle-consulta/"+id_user);
    const json     = await response.json();

    console.log(json);
    if(json.state = "correcto"){
        divDatosConsultaHead.innerHTML = `<div class="text-center">Feecha del turno: ${json.content.fecha}</div>`;
        divDatosConsultaBody.innerHTML = `
            <div class="form-group text-center">
                <div><h5>Turnos antes de este: 4</h5></div><br>
                <div><h5>NRO TURNO</h5></div>
                <div><h1>${json.content.turno}</h1></div>
                <div class="form-group">
                    <button class="btn btn-outline-danger">Cancelar turno</button>
                </div>
                
            </div>
        `;
    }
}

getDatosConsulta();