let inpUsername   = document.getElementById('input-username');
let inpPassword   = document.getElementById('input-password');
let alertLogin    = document.getElementById('alert-login');

let btnLogin      = document.getElementById('button-login');


/* function validatePassword(password){
    const regex = /^(?=\w*[0-9])(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;
    return regex.test(password);
} */


/* function validateUsername(username){
    const regex = /^(?=\w*[a-z])\S{6,15}$/;
    return regex.test(username);
}
 */

function validateUser(){
    let user = inpUsername.value.trim();
    let pass = inpPassword.value.trim();

    /* if(validateUsername(user) && validatePassword(pass)){
        loginUser(user,pass);
    } */
    if(user != "" && pass != ""){
        loginUser(user,pass);
    }
}


async function loginUser(usuario,password){

    const response = await fetch("../api/usuario/login",{
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
        body: JSON.stringify({user : usuario, pass : password})
    });
    
    const json     = await response.json();

    //console.log(json);

    if(json.state == "correcto"){
        alertLogin.className = "text-success";
        alertLogin.innerHTML = `
            <i class="la la-check"></i>
            Usuario logeado, redireccionando...
        `;
        window.location.href = "../"+json.content.dir;
    }
    else if(json.state == "error"){
        alertLogin.className = "text-danger";
        alertLogin.innerHTML = `
            <i class="la la-info"></i>
            ${json.content.message}
        `;
    }

}


/* inpUsername.addEventListener("keyup",function(){
    if(validateUsername(inpUsername.value.trim()) || inpUsername.value.trim() == ""){
        inpUsername.className = "form-control";
        
    }else{
        inpUsername.className = "form-control border-danger";
    }
},false); */


/* inpPassword.addEventListener("keyup",function(){
    if(validatePassword(inpPassword.value.trim()) || inpPassword.value.trim() == ""){
        inpPassword.className = "form-control";
        
    }else{
        inpPassword.className = "form-control border-danger";
    }
},false); */


btnLogin.addEventListener("click",validateUser,false);