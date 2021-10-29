document.addEventListener('DOMContentLoaded' , function(){

    eventListeners(); 

})


function eventListeners(){
    crearGaleria();

}

function crearGaleria(){

    const galeria = document.querySelector('.galeria-imagenes-profile');
  
    
    
    for(let i = 1; i <= 6; i++){
  
      const li = document.createElement('LI');

      li.style.textAlign = 'center';
      li.style.listStyle = 'none';
  
      const img = document.createElement('IMG');

      img.style.height = '142px';
      img.style.padding = '1rem';

      img.style.cursor = 'pointer';
      img.classList.add('z-depth-3');
  
      img.src = `/build/img/perfil_prueba_${i}.webp`;

      img.dataset.imagenId = i;
  
      li.appendChild(img);
  
      galeria.appendChild(li);

      li.onclick = crearImagen; 





    }
  
  }

  function crearImagen(e){
  

    console.log("diste click en imagen: " + e.target)
    
    const id = parseInt(e.target.dataset.imagenId);



     

 
      const overlayContent = document.createElement('DIV');    
      const overlay = document.createElement('DIV'); 

      overlayContent.style.position = 'fixed';
      overlayContent.style.width = '100%'; 
      overlayContent.style.height = '100vh'; 
      overlayContent.style.top = '0'; 
      overlayContent.style.backgroundColor = 'rgb(41 41 41 / 50%)'; 
      overlayContent.style.zIndex = '1'; 



      overlay.classList.add('overlay');
  //agregar estilos por falla en SASS - eliminar despues
  
  overlay.style.position = 'fixed'; 
  overlay.style.width = '31%'; 
  overlay.style.height = '67%'; 
  overlay.style.top = '25rem'; 
  overlay.style.right = '56rem'; 
  overlay.style.backgroundColor = 'rgba(0,0,0, .5s)'; 
  overlay.style.display = 'grid'; 
  overlay.style.placeItems = 'center'; 
 
  overlay.style.overflow = 'hidden';


  overlayContent.appendChild(overlay);


  //crear la imagen 

  const imgGrande = document.createElement('IMG');
  imgGrande.src = `/build/img/perfil_prueba_${id}.webp`;
  imgGrande.classList.add('imagen-grande'); 


  cantidad = document.querySelectorAll('.overlay').length;

  imgGrande.style.maxWidth = '100%';

  //agregar hijo al overlay que es imagen

  overlay.appendChild(imgGrande);

  //llamar al body html 

  const body = document.querySelector('body')
  body.appendChild(overlayContent);
  body.classList.add('fijar-body'); 


  overlay.onclick = function(){

    overlayContent.remove(); 
    

    console.log(cantidad);


  
    body.classList.remove('fijar-body');
     
  }

  
 
  }
