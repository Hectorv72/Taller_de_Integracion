let tablaClientes = document.querySelector("#tabla-clientes > tbody");
let numclientes = 0;
let datalist = [];



async function actualizarLista(){
    const consulta = await fetch("../api/consultas");
    const json = await consulta.json();

    if(json.content.clientes.length != numclientes){
        datalist = json.content.clientes;
        numclientes = datalist.length;
        listarClientes();
    }
}

/* function setAusente(id){
    datalist.splice(0, 1);
    listarClientes();
}

function setAtendido(id){
    datalist.splice(0, 1);
    listarClientes();
} */

function listarClientes(){
    let list = "";
    /* let fristid;
    let primero = false; */

    if (datalist.length > 0){

        datalist.forEach(element => {

            let descripcion = "no hay descripcion";
            if(element.descripcion != ""){
                descripcion = element.descripcion;
            }

            list += `<tr>
            <td>${element.turno}</td>
            <td>${descripcion}</td>`;
    
            /* if(primero == false){
                list += `<td>
                <button value="${element.id}" id="btn-cliente-atendido" class="btn btn-outline-primary btn-rounded">Atendido</button>
                <button value="${element.id}" id="btn-cliente-ausente"  class="btn btn-outline-danger btn-rounded" >Ausente</button>
                </td>`;
                primero = true;
                fristid = element.id;
            } */
            list += `</tr>`;
        });
        tablaClientes.innerHTML = list;
    
        /* document.getElementById("btn-cliente-atendido").addEventListener("click",function(){
            setAtendido(fristid);
        },false);
    
        document.getElementById("btn-cliente-ausente").addEventListener("click",function(){
            setAusente(fristid);
        },false); */
    }else{
        tablaClientes.innerHTML = "";
    }
    
}


/* // Crea una nueva conexión.
const socket = new WebSocket('ws://localhost:8080');

// Abre la conexión
socket.addEventListener('open', function (event) {
    socket.send('Hello Server!');
});

// Escucha por mensajes
socket.addEventListener('message', function (event) {
    console.log('Message from server', event.data);
}); */

actualizarLista();

setInterval(actualizarLista,5000);