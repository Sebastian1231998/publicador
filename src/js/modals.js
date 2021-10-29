let instanceCategoria;

document.addEventListener("DOMContentLoaded", function () {
  cambiaFotoPerfil();
  eligeCategoria();
});

function cambiaFotoPerfil() {
  let buttonModal;
  if (document.querySelector(".imagen_perfil")) {
    buttonModal = document.querySelector(".imagen_perfil");
  }
  buttonModal.addEventListener("click", function () {
    var elems = document.querySelectorAll(".modal");
    var instances = M.Modal.init(elems);
  });

  let buttonModalCategoria;
  if (document.querySelector(".categoria-publicador")) {
    buttonModalCategoria = document.querySelector(".categoria-publicador");
  }
  buttonModalCategoria.addEventListener("click", function () {
    var elems = document.querySelectorAll(".modal");
    var instances = M.Modal.init(elems);
  });


 
}

function eligeCategoria() {
  let categorias = document.querySelectorAll(".collection-item");
  let inputCategoria = document.querySelector(".categoria-input");

  let modalCategoria = document.querySelector("#categoriaModal");

  console.log(categorias);

  categorias.forEach((categoria) => {
    categoria.addEventListener("click", function (e) {
      let str = e.target.innerText;
      let value = str.replace("send", " ");

      if (categoria.style.backgroundColor == "") {
        categoria.style.backgroundColor = "blue";

        categoria.ondblclick = function (e) {
          console.log("doble click");

          inputCategoria.value = value.trim();
          console.log("categoria:  " + inputCategoria.value);

          modalCategoria.style.display = "none";

          if (document.querySelector(".modal-overlay")) {
            let modalOverlay = document.querySelector(".modal-overlay");
            modalOverlay.remove();
            let divCategoria = document.querySelector(
              ".categoria-seleccionada"
            );
            divCategoria.textContent = inputCategoria.value;
            divCategoria.style.display = "block";
            categoria.style.backgroundColor = "white";
          }
        };
      }
    });
  });
}
