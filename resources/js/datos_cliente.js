let divAtencion   = document.getElementById('datos-atencion');
let divHead       = document.getElementById('dato-turno');
const ss_nro_caja = document.getElementById('session_nro_caja').value;
let intrvBusqueda = "";

let global_nroCaja = 0;

async function setEstado(id,estado,nroturno){
    
    const response = await fetch("../api/estado-consulta",{
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
        body: JSON.stringify({id : id, estado : estado, nroturno : nroturno})
    });
    const json     = await response.json();

    if (json.state == "correcto"){
        obtenerTurnoLibre();
    }

}





async function obtenerTurnoLibre(){
    const response = await fetch("../api/consulta");
    const json     = await response.json();

    if(json.state == "correcto"){
        
        consulta = json.content;
        

        if(consulta.categoria == null){
            consulta.categoria = "";
        }
    
        divHead.innerHTML = `Turno: ${consulta.turno}`;
    
        divAtencion.innerHTML = `
        <div class="form-group">Categoria: ${consulta.categoria}</div>
        <div class="form-group">Descripcion: ${consulta.descripcion}</div>
        <div class="form-group">
            <button id="button-atendido" class="btn btn-primary">Atendido</button>
            <button id="button-ausente"  class="btn btn-danger">Ausente</button>
        </div>
        `;
    
        document.getElementById("button-atendido").addEventListener("click",function(){setEstado(consulta.id,"atendido",consulta.turno)},false);
        document.getElementById("button-ausente").addEventListener("click",function(){setEstado(consulta.id,"ausente",consulta.turno)},false);

        clearInterval(intrvBusqueda);
        intrvBusqueda = "";
    }else{
        divHead.innerHTML = `${json.content.message}`;
        divAtencion.innerHTML = "";
        
        if(intrvBusqueda == ""){
            intrvBusqueda = setInterval(obtenerTurnoLibre, 5000);
        }
        
    }
    
    
}




async function obtenerCajas(){
    const response = await fetch("../api/cajas-libre");
    const json     = await response.json();

    if(json.state == "correcto"){
        let list = "";

        divAtencion.innerHTML = "";
    
        json.content.cajas.forEach(element => {
            list += `<option value="${element.id}">Caja N°${element.id}</option>`;
        });
    
        divAtencion.innerHTML += "<div class='form-group'><select class='form-control' id='select-caja'>"+list+"</select></div>";
    
        divAtencion.innerHTML += "<div class='form-group'><button class='btn btn-primary' id='boton-seleccionar-caja'>Seleccionar</button></div>";
    
        document.getElementById("boton-seleccionar-caja").addEventListener("click",function(){
            
            setCaja();
        },false);
    }else{
        divHead.innerHTML = "No hay cajas disponibles";
        divAtencion.innerHTML = "";
    }
    
}

async function setCaja(){
    global_nroCaja = document.getElementById("select-caja").value;

    const response = await fetch("../api/ocupar-caja",{
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
        body: JSON.stringify({caja : global_nroCaja})
    });
    const json     = await response.json();

    if (json.state == "correcto"){
        obtenerTurnoLibre();
    }

    console.log(json);
}

if(ss_nro_caja == 0){
    obtenerCajas();
}else{
    obtenerTurnoLibre();
}

//obtenerTurnoLibre();
//console.log("b");