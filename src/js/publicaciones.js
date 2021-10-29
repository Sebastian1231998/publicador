let idUsuarioComment;
let idPublicacionComment;
let validate = false;

document.addEventListener("DOMContentLoaded", function () {
  likeUser();
  modalLikeUser();
  crearComments();
  consultaComments();
});
function modalLikeUser() {
  let buttons = document.querySelectorAll(".you-like-href");

  buttons.forEach((button) => {
    button.addEventListener("click", function () {
      var elems = document.querySelectorAll(".modal");
      var instances = M.Modal.init(elems);
    });
  });
}

function likeUser() {
  let likes = document.querySelectorAll(".like-publicador");

  likes.forEach((like) => {
    like.addEventListener("click", function (e) {
      let idUsuario = parseInt(like.getAttribute("user-id"), 10);
      let idPublicaciones = parseInt(like.getAttribute("id-publicaciones"), 10);
      let idLocal = parseInt(like.getAttribute("validate-data"), 10);
      let cantidadLike = parseInt(like.getAttribute("data-like"), 10);
      let value = like.getAttribute("validate-id");

      console.log(
        "publicacion:" +
          idPublicaciones +
          "esta es su cantidad de likes:" +
          cantidadLike
      );

      console.log(idUsuario);
      console.log(idPublicaciones);
      console.log(idLocal);

      let datos = new FormData();

      datos.append("likes", cantidadLike);
      datos.append("usuarioId", idUsuario);
      datos.append("id_publicaciones", idPublicaciones);
      datos.append("local_like", idLocal);

      let xhttp = new XMLHttpRequest();

      xhttp.open("POST", "/homepage", true);

      xhttp.onload = function () {
        if (this.status == 200) {
          let respuesta = JSON.parse(xhttp.responseText);

          if (respuesta.local_like == 0) {
            console.log(respuesta);

            like.style.backgroundColor = "white";

            let icons = document.querySelectorAll(".like-publicador");

            icons.forEach((icon) => {
              console.log(icon.id_publicaciones + "==" + idPublicaciones);

              if (icon.getAttribute("id-publicaciones") == idPublicaciones) {
                icon.parentElement.childNodes[3].innerText = `a ${respuesta.count_likes} les gusta esta publicacion`;
              }
            });

            like.setAttribute("validate-data", respuesta.local_like);
            like.setAttribute("data-like", respuesta.count_likes);

            let modalContent = document.querySelector(
              `#likesModal${value} .modal-content`
            );

            modalContent.childNodes.forEach((hijo) => {
              if (hijo.outerText == undefined || hijo.outerText == "") {
                console.log("estan vacias:" + hijo.outerText);
              } else {
                let str = hijo.outerText;
                let nuevaCadena = str.replace("Ver perfil", " ");

                let nombreCompleto = `${respuesta.nombre} ${respuesta.apellido}`;

                console.log(nuevaCadena.trim());

                if (nuevaCadena.trim() == nombreCompleto.trim()) {
                  console.log("Estoy aqui");

                  hijo.remove();
                }
              }
            });
          } else if (respuesta.local_like == 1) {
            console.log("estas en 0");

            console.log(respuesta);

            if (respuesta.like) {
              like.style.backgroundColor = "red";

              let icons = document.querySelectorAll(".like-publicador");

              icons.forEach((icon) => {
                console.log(icon.id_publicaciones + "==" + idPublicaciones);

                if (icon.getAttribute("id-publicaciones") == idPublicaciones) {
                  if (respuesta.count_likes - 1 == 0) {
                    icon.parentElement.childNodes[3].innerText = `a ti te gusta`;
                  } else {
                    icon.parentElement.childNodes[3].innerText = `a ti te gusta y a ${
                      respuesta.count_likes - 1
                    } personas mas les gusta esta publicacion`;
                  }
                }
              });

              like.setAttribute("validate-data", respuesta.local_like);
              like.setAttribute("data-like", respuesta.count_likes);

              let validadorLike = true;

              if (validadorLike) {
                let modalContent = document.querySelector(
                  `#likesModal${value} .modal-content`
                );

                let li = document.createElement("LI");
                li.style.padding = "1rem 1rem";
                li.style.height = "8rem";
                li.style.listStyle = "none";
                li.classList.add("collection-item", "avatar");

                let div = document.createElement("DIV");
                div.style.textAlign = "center";
                div.style.padding = "1rem 1rem";
                div.style.display = "flex";
                div.style.alignItems = "center";
                div.style.justifyContent = "space-between";
                div.classList.add("collection-item", "avatar");

                let divFlex = document.createElement("DIV");
                divFlex.style.textAlign = "center";
                divFlex.style.padding = "1rem 1rem";
                divFlex.style.display = "flex";
                divFlex.style.alignItems = "center";
                divFlex.style.justifyContent = "space-between";

                let aHref = document.createElement("a");
                aHref.setAttribute("href", `/user/profile/?id=${respuesta.id}`);

                let imgProfile = document.createElement("IMG");
                imgProfile.setAttribute(
                  "src",
                  `/imagenes/profile/${respuesta.foto_perfil}`
                );
                imgProfile.style.width = "50px";
                imgProfile.style.height = "50px";
                imgProfile.style.borderRadius = "10rem";

                aHref.appendChild(imgProfile);

                let p = document.createElement("P");
                p.style.fontSize = "1.3rem";
                p.style.width = "26rem";

                p.textContent = `${respuesta.nombre} ${respuesta.apellido}`;

                divFlex.appendChild(aHref);
                divFlex.appendChild(p);

                let aHrefProfile = document.createElement("a");
                aHrefProfile.setAttribute(
                  "href",
                  `/user/profile/?id=${respuesta.id}`
                );
                aHrefProfile.style.padding = "1rem 2rem";
                aHrefProfile.style.color = "white";
                aHrefProfile.style.borderRadius = "1rem";
                aHrefProfile.style.backgroundColor = "#4c77ff";

                aHrefProfile.textContent = "Ver perfil";

                div.appendChild(divFlex);
                div.appendChild(aHrefProfile);

                li.appendChild(div);

                modalContent.appendChild(li);

                validadorLike = false;
              }
            }
          }
        }
      };

      xhttp.send(datos);
    });
  });
}

function crearComments() {


  let comentarios = document.querySelectorAll("#comentario");
  let valueComments;

  comentarios.forEach((comentario) => {
    comentario.addEventListener("input", function (e) {
      valueComments = e.target.value;
    });

    comentario.addEventListener("keydown", function (e) {
      if (e.keyCode === 13) {
        idUsuarioComment = comentario.getAttribute("user-id");
        idPublicacionComment = comentario.getAttribute("id-publicaciones");

        let comentarioForm = new FormData();
        comentarioForm.append("descripcion_comentario", valueComments);
        comentarioForm.append("idUsuario", idUsuarioComment);
        comentarioForm.append("idPublicacion", idPublicacionComment);
        comentarioForm.append("accion", "crearComentario");

        insertComments(comentarioForm,comentario);
      }
    });
  });
}

function insertComments(comment,inpuComment) {
  console.log("comunicando");

  let xhttpComment = new XMLHttpRequest();

  xhttpComment.open("POST", "/models/comments", true);

  xhttpComment.onload = function () {
    if (this.status == 200) {


      let respuesta = JSON.parse(xhttpComment.responseText)


          
      
          let divCampoPublicador = document.createElement("DIV");
          divCampoPublicador.classList.add("campo-publicador","unique-create-comment");
          divCampoPublicador.style.backgroundColor = "#dedcd8";
          divCampoPublicador.style.width = "auto";
          divCampoPublicador.height = "auto";
          divCampoPublicador.style.borderRadius = "5px";
          divCampoPublicador.style.marginLeft = '2rem';
          divCampoPublicador.style.border = "1px solid #dac5c5";
          divCampoPublicador.style, (margin = "0px 2rem");

          let Pcomment = document.createElement("P");
          Pcomment.style.fontSize = "1.2rem";
          Pcomment.style.padding = ".5rem";
          Pcomment.textContent = respuesta.descripcionComentario;

          divCampoPublicador.appendChild(Pcomment);

           let clone = inpuComment.parentElement.parentElement.parentElement.cloneNode(true);


           clone.children[1].children[1].children[0].value = ''
      
           inpuComment.parentElement.parentElement.appendChild(divCampoPublicador)

       

           inpuComment.parentElement.parentElement.parentElement.parentElement.appendChild(clone)


          inpuComment.parentElement.remove();
          inpuComment.remove();

          crearComments()

          validate = true; 




    }
  };

  xhttpComment.send(comment);
}

function consultaComments() {
  let consultaComment = document.querySelectorAll(".consultaComment");

  consultaComment.forEach((consulta) => {
    consulta.addEventListener("click", function () {
      let validador = false;
      idUsuarioComment = consulta.getAttribute("user-id");
      idPublicacionComment = consulta.getAttribute("id-publicaciones");

      console.log("ID usuari" + idUsuarioComment);
      console.log("ID publicacion" + idPublicacionComment);

      let bodyComments = document.querySelectorAll(".body-comments");

      bodyComments.forEach((bodyComment) => {
        if (
          bodyComment.getAttribute("body-publicaciones") == idPublicacionComment
        ) {
          if (bodyComment.style.display == "block") {
            bodyComment.classList.add("animate__animated", "animate__fadeOut");

            setTimeout(() => {
              bodyComment.style.display = "none";
            }, 500);

            validador = false;

            queryComments(bodyComment, validador);
          } else {
            validador = true;
            queryComments(bodyComment, validador);

            bodyComment.style.display = "block";
            bodyComment.classList.add("animate__animated", "animate__fadeIn");

            if (bodyComment.classList.contains("animate__fadeOut")) {
              bodyComment.classList.remove("animate__fadeOut");
            }
          }
        }
      });
    });
  });
}

function queryComments(bodyComment, validador) {
  let xhttpComment = new XMLHttpRequest();

  xhttpComment.open(
    "GET",
    `/models/comments?id_publicacion=${idPublicacionComment}`,
    true
  );

  xhttpComment.onload = function () {
    if (this.status == 200) {
      let respuesta = JSON.parse(xhttpComment.responseText);

      if (validador) {
        respuesta.forEach((elem) => {


          let li = document.createElement("LI");
          li.style.listStyle = "none";
          li.classList.add("commentsPublication");

          let span = document.createElement("SPAN");
          span.style.fontSize = "1rem";
          span.style.padding = "1rem";

          span.textContent = `${elem.nombre} ${elem.apellido}`;

          let divAvatar = document.createElement("DIV");
          divAvatar.style.textAlign = "-webkit-center";
          divAvatar.style.padding = "1rem";
          divAvatar.style.display = "flex";
          divAvatar.classList.add("avatar");

          let rutaFoto;
          if (elem.foto_perfil == "") {
            rutaFoto = "/build/img/avatar_null.png";
          } else {
            rutaFoto = `/imagenes/profile/${elem.foto_perfil}`;
          }

          let img = document.createElement("IMG");
          img.setAttribute("src", rutaFoto);
          img.style.width = "70px";
          img.style.borderRadius = "10rem";
          img.style.height = "70px";
          img.style.marginRight = "2rem";

          let divCampoPublicador = document.createElement("DIV");
          divCampoPublicador.classList.add("campo-publicador");
          divCampoPublicador.style.backgroundColor = "#dedcd8";
          divCampoPublicador.style.width = "auto";
          divCampoPublicador.height = "auto";
          divCampoPublicador.style.borderRadius = "5px";
          divCampoPublicador.style.border = "1px solid #dac5c5";
          divCampoPublicador.style, (margin = "0px 2rem");

          let Pcomment = document.createElement("P");
          Pcomment.style.fontSize = "1.2rem";
          Pcomment.style.padding = ".5rem";
          Pcomment.textContent = elem.descripcion_comentario;

          divCampoPublicador.appendChild(Pcomment);

          divAvatar.appendChild(img);
          divAvatar.appendChild(divCampoPublicador);

          li.appendChild(span);
          li.appendChild(divAvatar);

         

          bodyComment.insertBefore(li, bodyComment.children[0]);

        });
      } else {
        let commentsPublication = document.querySelectorAll(
          ".commentsPublication"
        );

        let val = bodyComment.children.length - 2

        
        if(validate){

          bodyComment.children[ val ].remove();
          validate = false;
        }


        commentsPublication.forEach((comment) => {

        
            

      
          comment.remove();

          if(document.querySelector('.unique-create-comment')){

            document.querySelector('.unique-create-comment').parentElement.remove();
          }
        });
      }
    }
  };

  xhttpComment.send();
}
