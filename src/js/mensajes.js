let validador = 0;

let validateLectureMessage = false; 

let val_notify = 1;

let id_usuarioRecibe;
let nombre;
let apellido;
let foto_perfi_recibe;
let foto_perfi_envia;
let valida_message;

let obj_temp =[];
let uCollection = false;

let params = new URLSearchParams(location.search);
let id = params.get("id");

document.addEventListener("DOMContentLoaded", function () {
  eventListenersMessages();
});

function eventListenersMessages() {
  mensajes();
  leeInput();
}

function mensajes() {
  let usersMessage = document.querySelectorAll(".user-message");

  usersMessage.forEach((user) => {
    user.addEventListener("click", function (e) {
      let liElement;

      if (e.target.tagName == "P") {
        liElement = e.target.parentElement.parentElement;
      } else if (e.target.tagName == "DIV") {
        liElement = e.target.parentElement;
      } else {
        liElement = e.target;
      }

      id_usuarioRecibe = user.getAttribute("user-id");
      nombre = user.getAttribute("user-nombre");
      apellido = user.getAttribute("user-apellido");
      foto_perfi_recibe = user.getAttribute("foto-perfil");

      let userContactHref = document.querySelector(".user-contact .avatar a");
      let userContactParrafo = document.querySelector(
        ".user-contact .avatar p"
      );

      userContactHref.setAttribute(
        "href",
        `/user/profile?id=${id_usuarioRecibe}`
      );

      if (foto_perfi_recibe === "") {
        foto_perfi_recibe = "avatar_null.png";
      }

      userContactHref.children[0].setAttribute(
        "src",
        `/imagenes/profile/${foto_perfi_recibe}`
      );

      userContactParrafo.textContent = ` ${nombre} ${apellido} `;

      liElement.style.backgroundColor = "aliceblue";
      liElement.classList.add("aliceblue");

      consultaMessages(foto_perfi_recibe);
      validador++;

      if (validador == 2) {
        usersMessage.forEach((user_template) => {
          if (user_template.classList.contains("aliceblue")) {
            user_template.classList.remove("aliceblue");
            user_template.style.backgroundColor = "white";

            liElement.style.backgroundColor = "aliceblue";
            liElement.classList.add("aliceblue");

            validador = 1;
          }
        });
      }
    });
  });
}

function consultaMessages(foto_perfi_recibe) {
  let xhttpMessages = new XMLHttpRequest();

  //abrir la conexion

  let inputMessage = document.querySelector(".input-message");
  let idUsuarioEnvia = inputMessage.getAttribute("data-userId-send");

  xhttpMessages.open(
    "GET",
    `/models/messages?id=${idUsuarioEnvia}&recieve=${id_usuarioRecibe}`,
    true
  );

  //leer la respuesta

  xhttpMessages.onload = function () {
    if (this.status == 200) {
      let respuesta = JSON.parse(xhttpMessages.responseText).resultado;
      let foto_perfil;
      let foto_perfil_new = JSON.parse(
        xhttpMessages.responseText
      ).usuario_envia_foto;
      let foto_perfil_otra = JSON.parse(
        xhttpMessages.responseText
      ).usuario_recibe_foto;

      let bodyMessageContent = document.querySelector(".body-message-content");
      uCollection = document.querySelector(".message-user-collection");

      if (document.querySelectorAll(".differente") || respuesta.lenght == 0) {
        let liAnteriores = document.querySelectorAll(".differente");

        liAnteriores.forEach((liPreview) => {
          liPreview.remove();
        });
      }

      if (document.querySelector(".differente-li")) {
        document.querySelector(".differente-li").remove();
      }

      let inputMessage = document.querySelector(".input-message");
      let id_profile = inputMessage.getAttribute("data-userId-send");

      let validate = 0;

      respuesta.forEach((eleme) => {
        let li = document.createElement("LI");

        li.classList.add("collection-item", "differente", "avatar");
        validate++;

        if (validate == respuesta.length) {
          li.setAttribute("id", `ultimateMessage`);
        }

        li.style.padding = "0 1rem";
        li.style.height = "auto";
        li.style.marginBottom = "5rem";

        let divAvatar = document.createElement("DIV");
        divAvatar.style.display = "flex";
        divAvatar.classList.add(".avatar");
        divAvatar.style.textAlign = "-webkit-center";
        divAvatar.style.padding = "1rem 1rem";
        divAvatar.style.textAlign = "flex";
        divAvatar.style.alignItems = "center";

        let divMessage = document.createElement("DIV");
        divMessage.style.display = "flex";
        divMessage.style.flexDirection = "column-reverse";
        divMessage.style.gap = "1rem";

        let spanFecha = document.createElement("SPAN");
        spanFecha.style.fontSize = ".9rem";
        spanFecha.textContent = `${eleme.fecha_creacion}`;

        let aHref = document.createElement("A");

        if (id_profile != eleme.idUsuarioEnvia && foto_perfil_otra == "") {
          foto_perfil = "avatar_null.png";
        } else if (id_profile != eleme.idUsuarioEnvia) {
          foto_perfil = foto_perfil_otra;
        } else {
          foto_perfil = foto_perfil_new;
        }

        let imgProfile = document.createElement("IMG");
        imgProfile.setAttribute("src", `/imagenes/profile/${foto_perfil}`);
        imgProfile.style.width = "50px";
        imgProfile.style.borderRadius = "10rem";
        imgProfile.style.height = "50px";

        let p = document.createElement("P");
        p.style.fontSize = "1.6rem";
        p.style.margin = "2rem";

        p.textContent = eleme.contenido;

        aHref.appendChild(imgProfile);

        divMessage.appendChild(spanFecha);

        divMessage.appendChild(aHref);

        divAvatar.appendChild(divMessage);

        divAvatar.appendChild(p);

        li.appendChild(divAvatar);

        uCollection.appendChild(li);

        bodyMessageContent.appendChild(uCollection);
      });
    }

    let liUltimate = document.querySelector("#ultimateMessage");

    liUltimate.scrollIntoView({
      behavior: "smooth",
      block: "nearest",
      inline: "start",
    });
  };

  xhttpMessages.send();


  let mensajesRecibidos = JSON.parse(localStorage.getItem('envios'))

  console.log(mensajesRecibidos)


  mensajesRecibidos.forEach(mensaje => {


    if(mensaje.user_id_recibe == idUsuarioEnvia && mensaje.profile_id == id_usuarioRecibe){

      let indexActual = mensajesRecibidos.indexOf(mensaje)

      console.log(indexActual);

      if( indexActual != -1){

        mensajesRecibidos.splice( indexActual, 1 ); 
        
        localStorage.setItem("envios", JSON.stringify(mensajesRecibidos))



       let data = new FormData();

       data.append('elimina_notificacion', 3);

       deleteNotificationMessage(data)
       
      }

    }
    
  });

}

function deleteNotificationMessage(data){

  //crear form data

  console.log("estoy aqui...")

 //crear objeto

 let xhttpMessages = new XMLHttpRequest();

 //abrir la conexion

 xhttpMessages.open("POST", "/models/messages/updateNotification", true);

 xhttpMessages.onload = function () {
  if (this.status == 200) {
 
    let respuesta = JSON.parse(xhttpMessages.responseText);

     if(respuesta.respuesta == "correcto"){

   
      let textoNotificacion = document.querySelector('.texto-notificacion');
      textoNotificacion.textContent = respuesta.notify;
    }

  }

}
xhttpMessages.send(data);
}

function leeInput() {
  let inputMessage = document.querySelector(".input-message");
  let submitMessage = document.querySelector(".submitMensaje");

  let valueMessage = "";

  inputMessage.addEventListener("input", function (e) {
    valueMessage = e.target.value;
  });

  submitMessage.addEventListener("click", function (e) {
    e.preventDefault();

    if (id_usuarioRecibe == undefined) {
      mensajeMessage("no estas enviando a ningun usuario el mensaje", "error");
    } else {
      if (valueMessage == "") {
        mensajeMessage("el mensaje esta vacio", "error");
      }

      let contenido = valueMessage;

      let idUsuarioEnvia = inputMessage.getAttribute("data-userId-send");
      foto_perfi_envia = inputMessage.getAttribute("foto-perfil-userActive");

      let validate = false;


      let fechaActual = new Date();

      hour = fechaActual.getHours();
      minutes = fechaActual.getMinutes();
      seconds = fechaActual.getSeconds();
      let datos = new FormData();

      let enviosActuales = JSON.parse(localStorage.getItem("envios"));


      if(enviosActuales == null){

        enviosActuales = [];
      }

      if(enviosActuales.length == 0){

        obj_temp = [...enviosActuales, 
          {enviados: val_notify, user_id_recibe: id_usuarioRecibe, profile_id:idUsuarioEnvia}
        ];

        localStorage.setItem("envios", JSON.stringify(obj_temp));


   datos.append("cantidad_enviado", 1);
      }else{

        for(let i = 0; i < enviosActuales.length ; i++){

          console.log(enviosActuales[i].user_id_recibe + "==" + id_usuarioRecibe )
          console.log(enviosActuales[i].profile_id + "==" +  idUsuarioEnvia )
  
  
          if (enviosActuales[i].user_id_recibe == id_usuarioRecibe && enviosActuales[i].profile_id == idUsuarioEnvia ) {
            validate = true;
            break;
          }else{

            validate = false;
          }

        }


         console.log(validate)
               
        if(validate){

          enviosActuales.forEach( (enviados, index) =>{


            if(enviados.user_id_recibe == id_usuarioRecibe && enviados.profile_id == idUsuarioEnvia){

              console.log(enviados.enviados + "con ID" + enviados.user_id_recibe)

              if( enviados.enviados >= 1){

              
                obj_temp = {

                        enviados: 2, 
                        user_id_recibe: id_usuarioRecibe,
                        profile_id:idUsuarioEnvia
                }

               let indexActual = enviosActuales.indexOf(enviados)

               console.log(indexActual);

               if( indexActual != -1){

                enviosActuales.splice( indexActual, 1 , obj_temp );
               }

            

                localStorage.setItem("envios", JSON.stringify(enviosActuales));

                datos.append("cantidad_enviado", 2);
              }
            }
          })
          
        }else{

          other=1;
          obj_temp = [...enviosActuales, 
            {
              enviados: other, 
              user_id_recibe: id_usuarioRecibe,
              profile_id:idUsuarioEnvia

            }
          ]; 

          val_notify=1;
          localStorage.setItem("envios", JSON.stringify(obj_temp));
          datos.append("cantidad_enviado", 1);
        }

        
  
 

      }




      datos.append("contenido", contenido);
      datos.append("idUsuarioRecibe", id_usuarioRecibe);
      datos.append("idUsuarioEnvia", idUsuarioEnvia);
      datos.append(
        "fecha_creacion",
        fechaActual.getFullYear() +
          "-" +
          "0" +
          (fechaActual.getMonth() + 1) +
          "-" +
          "0" +
          (fechaActual.getDate() + 1) +
          " " +
          hour +
          ":" +
          minutes +
          ":" +
          seconds
      );

      inputMessage.value = "";
   

      insertMessage(datos);

      contenido = "";

    }
  });
}

function insertMessage(datos) {
  //crear objeto

  let xhttpMessages = new XMLHttpRequest();

  //abrir la conexion

  xhttpMessages.open("POST", "/models/messages", true);

  //leer la respuesta

  xhttpMessages.onload = function () {
    if (this.status == 200) {
      let respuesta = JSON.parse(xhttpMessages.responseText);

      console.log(xhttpMessages.responseText);

      if (respuesta.respuesta == "correcto") {
        let bodyMessageContent = document.querySelector(
          ".body-message-content"
        );
        let uCollection = document.querySelector(".message-user-collection");

        if (document.querySelector(".differente-body")) {
          document.querySelector(".differente-body").remove();
        }

        if (document.querySelector("#ultimateMessage")) {
          document.querySelector("#ultimateMessage").setAttribute("id", null);
        }

        let li = document.createElement("LI");
        li.setAttribute("id", "ultimateMessage");
        li.classList.add("collection-item", "avatar", "differente-li");
        li.style.padding = "0 1rem";
        li.style.height = "auto";
        li.style.marginBottom = "5rem";

        let divAvatar = document.createElement("DIV");
        divAvatar.style.display = "flex";
        divAvatar.classList.add(".avatar");
        divAvatar.style.textAlign = "-webkit-center";
        divAvatar.style.padding = "1rem 1rem";
        divAvatar.style.textAlign = "flex";
        divAvatar.style.alignItems = "center";

        let divMessage = document.createElement("DIV");
        divMessage.style.display = "flex";
        divMessage.style.flexDirection = "column-reverse";
        divMessage.style.gap = "1rem";

        let spanFecha = document.createElement("SPAN");
        spanFecha.style.fontSize = ".9rem";
        spanFecha.textContent = `${respuesta.fecha_creacion}`;

        let aHref = document.createElement("A");

        if (foto_perfi_envia === "") {
          foto_perfi_envia = "avatar_null.png";
        }
        let imgProfile = document.createElement("IMG");
        imgProfile.setAttribute("src", `/imagenes/profile/${foto_perfi_envia}`);
        imgProfile.style.width = "50px";
        imgProfile.style.borderRadius = "10rem";
        imgProfile.style.height = "50px";

        let p = document.createElement("P");
        p.style.fontSize = "1.6rem";
        p.style.margin = "2rem";

        p.textContent = respuesta.contenido;

        aHref.appendChild(imgProfile);

        divMessage.appendChild(spanFecha);

        divMessage.appendChild(aHref);

        divAvatar.appendChild(divMessage);

        divAvatar.appendChild(p);

        li.appendChild(divAvatar);

        uCollection.appendChild(li);

        bodyMessageContent.appendChild(uCollection);

        let Ultimate = document.querySelector("#ultimateMessage");

        Ultimate.scrollIntoView({
          behavior: "smooth",
          block: "nearest",
          inline: "start",
        });
      }

      let mensajesCreados = document.querySelectorAll(".special-messages");

      let nodoExisitente;
      for (let i = 0; i < mensajesCreados.length; i++) {
        if (
          mensajesCreados[i].getAttribute("user-id") ==
          respuesta.idUsuarioRecibe
        ) {
          valida_message = true;

          nodoExisitente = mensajesCreados[i].childNodes;
          break;
        } else {
          valida_message = false;
        }
      }

      if (valida_message) {
        nodoExisitente[1].childNodes[5].textContent = respuesta.contenido;
      }
    }
  };

  //enviar los datos

  xhttpMessages.send(datos);
}

function mensajeMessage(mensaje, tipo) {
  let formContacto = document.querySelector(".campo-message");

  if (document.querySelector(".mensaje") == null) {
    let divMensaje = document.createElement("div");
    divMensaje.classList.add("mensaje", tipo);

    divMensaje.style.width = "100%";
    divMensaje.style.borderRadius = "1rem%";
    divMensaje.style.paddin = ".1rem 0";
    divMensaje.style.opacity = "1";
    divMensaje.style.transition = "opacity 2s ease%";
    divMensaje.style.backgroundColor = "red";
    divMensaje.style.textAlign = "center";

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
