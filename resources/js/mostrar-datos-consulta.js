const divDatosConsultaHead = document.getElementById("datos-consulta-head");
const divDatosConsultaBody = document.getElementById("datos-consulta-body");
const id_user              = document.getElementById("usuario-id").value;
let globalInterval;
/* let fecha                = new Date(Date.now()); */


async function verificarTurno(idconsulta,nroturno){
    const response = await fetch("../api/actualizacion/cliente",{
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
        body: JSON.stringify({idconsulta : idconsulta})
    });
    const json = await response.json();

    if(json.actualizacion == true){
        getDatosConsulta();
    }else{
        updateLastConsulta(nroturno);
    }
}



async function pedirConsulta(){

    let desc = document.getElementById("textarea-descripcion").value;

    const response = await fetch("../api/pedir-consulta",{
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
        body: JSON.stringify({descripcion : desc})
    });
    const json     = await response.json();

    if(json.state == "correcto"){
        getDatosConsulta()
    }
}


function verificarPedido(){
    Swal.fire({
        title: '¿Quieres pedir un turno?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText:  'No',
    })
    .then((result) => {
    if (result.isConfirmed) {
        pedirConsulta();
    }
    })
}

function setFormularioConsulta(){
    divDatosConsultaHead.innerHTML = `<div class="text-center">Pide un turno</div>`;
    divDatosConsultaBody.innerHTML = `
        <div class="form-group row text-center">
            <div class="form-group text-center col-lg-12">
                <textarea class="form-control text-center" cols="20" rows="5" id="textarea-descripcion" placeholder="añade una descripcion del inconveniente(opcional)"></textarea>
            </div>
            <div class="form-group col-md-12">
                <button class="btn btn-outline-primary" id="boton-pedir-consulta">Pedir consulta</button>
            </div>
            
        </div>
    `;

    document.getElementById("boton-pedir-consulta").addEventListener("click",verificarPedido,false);
    clearInterval(globalInterval);
}


async function updateLastConsulta(id){
    
    const data = await fetch("../api/consultas-anteriores/"+id);
    const res  = await data.json();

    const divText = document.getElementById("turnos-antes");

    if(res.content.turnos > 0){
        divText.innerHTML = `Turnos antes: ${res.content.turnos}`;
        divText.className = "h5";
    }else{
        divText.innerHTML = `Tu turno es ahora`;
        divText.className = "h5 text-success";
    }
}

async function getDatosConsulta(){
    const response = await fetch("../api/detalle-consulta/"+id_user);
    const json     = await response.json();



    if(json.state == "correcto"){


        let textfecha = json.content.fecha;

        if(json.content.isnow){
            textfecha = "Hoy";
        }

        divDatosConsultaHead.innerHTML = `<div class="text-center">Fecha del turno: ${textfecha}</div>`;
        divDatosConsultaBody.innerHTML = `
            <div class="form-group text-center">
                <div>
                    <div id="turnos-antes"></div>

                    <div class="form-group">

                        <div class="h4">NRO TURNO</div>
                        <div class="h1">${json.content.turno}</div>

                    </div>
                    
                    <div class="h4">Hora: ${json.content.hora}</div>

                </div>
                
                <div class="form-group">
                    <button class="btn btn-outline-danger" id="boton-cancelar">Cancelar turno</button>
                </div>
                
            </div>
        `;

        document.getElementById("boton-cancelar").addEventListener("click",function(){
            showAlert(json.content.id);
        },false)

        if(json.content.isnow){
            clearInterval(globalInterval);
            updateLastConsulta(json.content.turno);
            globalInterval = setInterval(function(){
                
                verificarTurno(json.content.id,json.content.turno)
            }, 5000);
            
        }
    }else{
        setFormularioConsulta();
    }
}

getDatosConsulta();


function showAlert(id){
    Swal.fire({
        title: '¿Estas seguro?',
        text: "Tu turno se cancelara",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'confirmar',
        cancelButtonText:  'cancelar',
    })
    .then((result) => {
    if (result.isConfirmed) {
        cancelarConsulta(id)
    }
    })
}

async function cancelarConsulta(id){

    const response = await fetch("../api/cancelar-consulta",{
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
        body: JSON.stringify({consulta : id})
    });

    const json = await response.json();

    if(json.state == "correcto"){
        clearInterval(globalInterval); 
        getDatosConsulta();

        Swal.fire(
        'Excelente',
        'Tu turno se cancelo',
        'success'
        );
    }
    
}
