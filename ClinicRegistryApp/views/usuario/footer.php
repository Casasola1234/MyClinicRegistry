<?php
?>
<!-- footer section -->
    <footer class='col-lg-12' style="position: bottom 0px;">
        <div class="principal_footer text-center col-lg-12 mt-5">
Muchas gracias por contactarnos!</div>
        
           <div class="social-media col-lg-12"><div>
                <div class="t"><a href="https://twitter.com/SaGilme" target="_blank"><i class="fab fa-twitter-square"></i></a></div>
                <div class="i"><a href="https://www.instagram.com/Gilme_SA/" target="_blank"><i class="fab fa-instagram-square"></i></a></div>
                <div class="f"><a href="https://m.me/GILMECR" target="_blank"><i class="fab fa-facebook-square"></i></a></div>
                <div class="w"><a href="https://wa.me/+50684853636?text=Hola!%20Estoy%20interesado%20en%20tu%20servicio" target="_blank"><i class="fab fa-whatsapp-square"></i></a></div></div></div>
        
                <div class='info_footer row mx-auto'>
            <div class='info_footer-subsection col-lg-4 col-md-12'>
                <div class='info_footer-subsection-menu'>
                    <h3><span class='open_menu' onclick="fn_slide(this,0);">MENU+</span></h3>
                    <ul class='text-left'>  
                        <li><a  href="">Iniciar Sesión</a></li>
                        <li><a href="">Registrarse</a></li>
                        <li><a href="">Carrito compras</a></li>
                    </ul>
                   
                    </div>
            </div>
            <div class='info_footer-subsection col-lg-4 col-md-12'>
                <div class='info_footer-subsection-menu'>
                <h3><span class='open_menu' onclick="fn_slide(this,1);">Contacto+</span></h3>
                <ul class='text-left'>
                        <li><i class='fas fa-map-marker-alt'> Dirección: </i><span>Direccion de la empresa</span></li>
                        <li><i class='fas fa-envelope'> Correo electrónico: </i><span>info@nombreempresa.com</span></li>
                        <li><i class='fas fa-phone'> Teléfono: </i><span>+506 88888888</span></li>
                        
                    </ul>
            </div>
                </div>
            <div class='info_footer-subsection col-lg-4 col-md-12'>
                <div class='info_footer-subsection-menu'>
                <h3><span class='open_menu' onclick="fn_slide(this,2);">OTHERS+</span></h3>
                <ul class='text-left'>
                        <li><a  href="<?=base_url?>termsandconditions.php">Terms and conditions</a></li>
                        <li><a href="<?=base_url?>">Other information</a></li>
                        
                    </ul>
            </div>
                </div>
            
        </div>
        <div class='final_div col-lg-12 mx-auto'>
        <span>Desarrollado por: <a href="Sinergia-Analitics" style="color:#38b6ff">Sinergia-Analitycs</a> | <span class="far fa-copyright"></span> 2021</span><a href="#">  Políticas de privacidad</a>
   </div>
    </footer>

    <script>
    $(document).ready(function(){
        var introSecuenceImage=document.querySelectorAll(".introduction_img-over");
        for(let i=0;i<introSecuenceImage.length;i++){
            introSecuenceImage[i].addEventListener("mouseover",function(event){
                let src=introSecuenceImage[i].nextSibling.src;
                $("#introduction__container-img").attr("src",src);
                 $("#modal_image").attr("src",src);
                //modal_image
            })
        }
        
    });
 
        var ul_slide=[true,true,true];
function fn_slide(data,value){
    if(ul_slide[value]==true){
        let span=data.parentNode.nextSibling.nextSibling;
    span.style.height='300px';
    ul_slide[value]=false;
   } else {
       let span=data.parentNode.nextSibling.nextSibling;
    span.style.height='0px';
    ul_slide[value]=true;
   }
}
    </script>
   
</body>
</html>
