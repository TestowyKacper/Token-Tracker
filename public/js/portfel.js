
 function funkcja(a)
 {
     $("#form"+a).toggle();

 }

    function pokaz(id){
          // Get the modal
          var modal = document.getElementById("myModal"+id);

          // Get the image and insert it inside the modal - use its "alt" text as a caption
          var img = document.getElementById("myImg"+id);
          var modalImg = document.getElementById("img"+id);
          var captionText = document.getElementById("Scaption"+id);
         
            modal.style.display = "block";
            modalImg.src = img.src;
            captionText.innerHTML = img.alt;
          
          
          // Get the <span> element that closes the modal
          var span = document.getElementById("Sclose"+id);
          
          // When the user clicks on <span> (x), close the modal
          span.onclick = function() {
            modal.style.display = "none";
          }
        }
