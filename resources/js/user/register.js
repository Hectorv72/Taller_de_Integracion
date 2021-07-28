const inpUser          = document.getElementById("input-user");
const inpEmail         = document.getElementById("input-email");
const inpPassword      = document.getElementById("input-password");
const inpConPassword   = document.getElementById("input-confirm-password");
const btnRegister      = document.getElementById("button-register");

function verificarUsuario(username){
    const regex = /^(?=\w*[a-z])\S{6,15}$/;
    return regex.test(username);
}


function verificarPassword(password){
    const regex = /^(?=\w*[0-9])(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;
    return regex.test(password);
}


function verificarEmail(email){
    const regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    return regex.test(email);
}

function confirmarPassword(pass,passcon){
    const user  = inpUser.value;
    const email = inpEmail.value;
    const pasword = inpPassword.value;
    const conpassword = inpConPassword.value;

    if(verificarUsuario())
    if(pass == passcon){
        return true;
    }
    
}