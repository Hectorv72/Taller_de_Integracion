const inpNya           = document.getElementById("input-nya");
const inpUser          = document.getElementById("input-user");
const inpEmail         = document.getElementById("input-email");
const inpPassword      = document.getElementById("input-password");
const inpConPassword   = document.getElementById("input-confirm-password");
const btnRegister      = document.getElementById("button-register");
const alertGeneral     = document.getElementById("alert-general");

let arrayinps = [inpNya,inpUser,inpEmail,inpPassword];


function verificarNyA(nya){

    const regex = /^[a-zá-ü\s]{5,50}$/;
    return regex.test(nya);
}



function verificarUsuario(username){
    const regex = /^(?=\w*[A-Za-z0-9])\S{6,15}$/;
    return regex.test(username);
}


function verificarPassword(password){
    const regex = /^(?=\w*[A-Za-z0-9])\S{6,15}$/;
    //const regex = /^(?=\w*[0-9])(?=\w*[A-Z])(?=\w*[a-z])\S{5,16}$/;
    return regex.test(password);
}


function verificarEmail(email){
    let expresion = /^([A-Za-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;

    return(expresion.test(email));
}

function verificarDatos(){
    const nya   = inpNya.value.trim();;
    const user  = inpUser.value.trim();
    const email = inpEmail.value.trim();
    const password = inpPassword.value;
    const conpassword = inpConPassword.value;
    let enviar = true;

    if(!verificarNyA(nya.toLowerCase())){
        enviar = false;
        inpNya.className = "form-control border-danger";

        document.getElementById("alert-nya").innerHTML = `
        <i class="la la-exclamation-circle"></i>
		Este campo no puede contener numeros y debe ser menor a 50 caract.
        `;
    }else{
        document.getElementById("alert-nya").innerHTML = ``;
    }

    if(!verificarUsuario(user)){
        enviar = false;
        inpUser.className = "form-control border-danger";

        document.getElementById("alert-user").innerHTML = `
        <i class="la la-exclamation-circle"></i>
		El usuario debe tener un minimo de 6 caracteres
        `;
    }else{
        document.getElementById("alert-user").innerHTML = ``;
    }

    if(!verificarEmail(email)){
        inpEmail.className = "form-control border-danger";
        enviar = false;
        document.getElementById("alert-email").innerHTML = `
        <i class="la la-exclamation-circle"></i>
		Verifique el formato del correo
        `;
    }else{
        document.getElementById("alert-email").innerHTML = ``;
    }

    if(!verificarPassword(password)){
        inpPassword.className = "form-control border-danger";
        enviar = false;
        document.getElementById("alert-password").innerHTML = `
        <i class="la la-exclamation-circle"></i>
		La contraseña debe contener 1 letra mayuscula, 1 minuscula y 1 numero
        `;
    }else{
        document.getElementById("alert-password").innerHTML = ``;
    }

    if(password != conpassword){
        enviar = false;
    }
    
    if(enviar == true){
        btnRegister.innerHTML = "Registrando...";
        registrarUsuario(nya,user,email,password);
        
    }
}


async function registrarUsuario(nombre_y_apellido,usuario,email,password){
    const response = await fetch("../api/usuario/register",{
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
        body: JSON.stringify({nya : nombre_y_apellido, usuario : usuario, email : email, password : password})
    });
    const json     = await response.json();

    if(json.state == "correcto"){
        alertGeneral.className = "alert alert-success text-center";
        alertGeneral.innerHTML = `
            <i class="la la-check"></i>
            ${json.content.message}
        `;
    }else{
        alertGeneral.className = "alert alert-danger text-center";
        alertGeneral.innerHTML = `
            <i class="la la-exclamation-circle"></i>
            ${json.content.message}
        `;
        
    }
    btnRegister.innerHTML = "Registrarme";
}



//----------------------------------------------------------------------------------------//
btnRegister.addEventListener("click",verificarDatos,false);


[inpPassword,inpConPassword].forEach(input => input.addEventListener("keyup",function(){

    if(input.value != ""){

        if(inpPassword.value != inpConPassword.value){
            inpConPassword.className = "form-control border-danger";
        }else{
            inpConPassword.className = "form-control border-success";
        }
    }else{
        input.className = "form-control";
    }

},false)
);

arrayinps.forEach(input => input.addEventListener("click",function(){input.className = "form-control"},false));


