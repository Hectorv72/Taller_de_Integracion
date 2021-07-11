let formu= document.getElementById('formula');
let respu=document.getElementById('respu');

formu.addEventListener('submit',(e)=>{
    e.preventDefault();
    console.log('funciona')

    let datos = new FormData(formu);

    console.log(datos)
    console.log(datos.get('nombre'));

    fetch('login-user',{
        method: 'POST',
        body:datos
    })
        .then(respu => respu.json())
        .then(dato => {
            //console.log(dato);
            if(dato == 'empleado'){
              window.location.href = "../empleado";
            }
            else if(dato == 'cliente'){
              window.location.href = "../cliente";
            }
            else if (dato==='campo vacio') {

                respu.innerHTML=`

                <div class="alert alert-danger" role="alert" name="alertLogin" id="respuesta">
                
              uno de los campos esta vacio

                </div>
                `
                
            }else if(dato==='usuario invalido'){

                respu.innerHTML=`
                <div class="alert alert-danger" role="alert" name="alertLogin" id="respuesta">
                
                usuario invalido
   
                 </div>`
               
  
              }else if(dato==='correo incorrecto'){

                respu.innerHTML=`
                <div class="alert alert-danger" role="alert" name="alertLogin" id="respuesta">
                
                correo invalido
   
                 </div>`
               
  
              }
              else if(dato==='contraseña invalido'){
                respu.innerHTML=`
                <div class="alert alert-danger" role="alert" name="alertLogin" id="respuesta">
                contraseña invalido
                 </div>`
              } 
              else if(dato==='registro'){
                respu.innerHTML=`
                <div class="alert alert-danger" role="alert" name="alertLogin" id="respuesta">
                debe registrarse
                 </div>`
              }
              else{
                respu.innerHTML=`
                <div class="alert alert-success" role="alert" name="alertLogin" id="respuesta">  
               ${dato}
                </div>
                `  
            }


            respu.hidden=false;
            setTimeout(function(){
              respu.hidden=true;
            }, 3000 );
        })


}) 