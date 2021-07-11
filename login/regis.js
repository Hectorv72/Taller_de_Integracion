

let formulario = document.getElementById('formulario');
let respuesta=document.getElementById('respuesta');

console.log(formulario);

formulario.addEventListener('submit',(e)=>{
    e.preventDefault();
    console.log('funciona')

    let datos = new FormData(formulario);

    console.log(datos)
    console.log(datos.get('nombre'));

    fetch('register-user',{
        method: 'POST',
        body:datos
    })
        .then(res => res.json())
        .then(data => {
            console.log(data);

            if (data==='campo vacio') {

                respuesta.innerHTML=`

                <div class="alert alert-danger" role="alert" name="alertLogin" id="respuesta">
                
              uno de los campos esta vacio

                </div>
                `
                
            }else if(data==='exisregis'){

              respuesta.innerHTML=`
              <div class="alert alert-danger" role="alert" name="alertLogin" id="respuesta">
              
             error, ya esta registrado
 
               </div>`
             

            }else if(data==='nombre invalido'){

                respuesta.innerHTML=`
                <div class="alert alert-danger" role="alert" name="alertLogin" id="respuesta">
                
               nombre invalido
   
                 </div>`
               
  
              }else if(data==='usuario invalido'){

                respuesta.innerHTML=`
                <div class="alert alert-danger" role="alert" name="alertLogin" id="respuesta">
                
                usuario invalido
   
                 </div>`
               
  
              }else if(data==='correo incorrecto'){

                respuesta.innerHTML=`
                <div class="alert alert-danger" role="alert" name="alertLogin" id="respuesta">
                
                correo invalido
   
                 </div>`
               
  
              }
              else if(data==='contraseña invalido'){

                respuesta.innerHTML=`
                <div class="alert alert-danger" role="alert" name="alertLogin" id="respuesta">
                
                contraseña invalido
   
                 </div>`
               
  
              }

              else{

                respuesta.innerHTML=`

                <div class="alert alert-success" role="alert" name="alertLogin" id="respuesta">
                
               ${data}

                </div>
                `


                
            }


            respuesta.hidden=false;
            setTimeout(function(){
              respuesta.hidden=true;
            }, 3000 );
        })


}) 



