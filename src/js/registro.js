document.addEventListener("DOMContentLoaded", function () {
  registroUser();
});

function registroUser() {
  let submit = document.querySelector(".submit");

  submit.addEventListener("click", function (e) {
    e.preventDefault();


    let nombre = document.querySelector("#nombre").value;
    let apellido = document.querySelector("#apellido").value;
    let fechaNacimiento = document.querySelector("#fecha").value;
    let password = document.querySelector("#password").value;
    let email = document.querySelector("#email").value;
    let genero = document.querySelector(".genero").value;

    let accion = e.target.value;


    console.log(genero)

    console.log("diste click en submit")



    let datos = {

        nombre,
        apellido,
        fechaNacimiento,
        password,
        email,
        genero

      };


      if(nombre.trim() === ''||
         apellido.trim() === ''||
         fechaNacimiento.trim() === ''||
         password.trim() === ''||
         email.trim() === ''||
         genero.trim() === '' 
      ){


        mensaje("todos los campos son obligatorios", "error");
      }else{

        console.log("pasa validacion")

        let registro = new FormData();
        let fechaActual = new Date();

        registro.append("nombre", nombre);
        registro.append("apellido",apellido);
        registro.append("fecha_nacimiento",fechaNacimiento);
        registro.append("password",password);
        registro.append("correo",email);
        registro.append("genero",genero);
        registro.append("accion",accion);
        registro.append("fecha_creacion", fechaActual.getFullYear() + "-" + "0" + (fechaActual.getMonth() + 1) + "-" + "0" + (fechaActual.getUTCDay() + 1));
       
        

        if(e.target.value == 'registro'){
            //insertar registro usuario BD
            insertarBD(registro);
        }
      }
  });
}


function insertarBD(registro){

 console.log(...registro);


 //crear el objeto 

 let xhttp = new XMLHttpRequest();


 //abrir la conexion
 xhttp.open('POST','models/usuario', true);

 //leer la respuesta

 xhttp.onload = function(){

    if(this.status == 200){



        console.log(xhttp.responseText)

        if(!xhttp.responseText){

            mensaje("Hubo un error: puede ser que el correo ya este registrado", "error");
            return;
        }

        Swal.fire(
            'Registrado!',
            'Te vamos a llevar al login para que inicies sesión',
            'success'
          );

        setTimeout(() => {
        
       window.location.href = '/login';
        }, 3000);
      


      
    }
 }


 //enviar los datos

 xhttp.send(registro);


}

function mensaje(mensaje , tipo){

  let formContacto = document.querySelector(".form-registro");

  if(document.querySelector('.mensaje') == null){

  let divMensaje = document.createElement("div");
  divMensaje.classList.add("mensaje", tipo);

  divMensaje.style.width = '100%'; 
  divMensaje.style.borderRadius = '1rem%'; 
  divMensaje.style.paddin = '.1rem 0'; 
  divMensaje.style.opacity = '1'; 
  divMensaje.style.transition = 'opacity 2s ease%'; 
  divMensaje.style.backgroundColor = 'red'; 
  divMensaje.style.textAlign = 'center'; 
  

  let cuerpoMensaje = document.createElement("div");
  cuerpoMensaje.classList.add("contenido-mensaje");



  cuerpoMensaje.innerHTML = `<p style="color:white">${mensaje}</p>`;

  divMensaje.appendChild(cuerpoMensaje);

  formContacto.appendChild(divMensaje);


  setTimeout(() => {
    divMensaje.remove();
  }, 3000);
  }



}
