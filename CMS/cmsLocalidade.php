<?php
    
    require_once("modulo/modulo.php");

    conexaoBanco();

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Administração de Conteúdo</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="cssCMS/styleCMS.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script>
            
            $(document).ready(function() {

              $(".ver").click(function() {
                $(".modalContainer").fadeIn(0500);
                //slideToggle
                //toggle
                //FadeIn
              });
            });

            function Modal(){
                $.ajax({
                    type: "POST",
                    url: "modal.php"
                });
            }
            
            $(document).ready(function() {

              $(".fechar").click(function() {
                //$(".modalContainer").fadeOut();
                $(".modalContainer").fadeOut(0500);
              });
            });
	
            function mascara(o,f){
                v_obj=o
                v_fun=f
                setTimeout("execmascara()",1)
            }
            function execmascara(){
                v_obj.value=v_fun(v_obj.value)
            }
            function mtel(v){
                v=v.replace(/\D/g,""); //Remove tudo o que não é dígito
                v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
                v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
                return v;
            }
            function mcel(v){
                v=v.replace(/\D/g,"");//Remove tudo o que não é dígito
                v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
                v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
                return v;
            }
            function id( el ){
                return document.getElementById( el );
            }
            window.onload = function(){
                id('txtTel').onkeypress = function(){
                    mascara( this, mtel );
                }
                
                id('txtTel').onkeypress = function(){
                    mascara( this, mcel );
                }
            }
            
            function validarCel_eTel(tecla){
                if(window.event){
                    var num = tecla.charCode;
                }else{
                    var num = tecla.which;
                }    
                
                if(!(num >= 48 && num <= 57 || num == 45 || num == 32 || num == 08)){
                    return false;
                }
            }
            
        </script>
        
    </head>
    <body>
        <div class="modalContainer">
            <div class="modal">
                <a href = "#" class="fechar">
                    <div id = "btnFechar">
                        X
                    </div>
                 </a> 
                
                <div id="tltCmsUsuario">
                    Adicionar novo local
                </div>
                
                <div id = "imgModalLocal">
                
                </div>
                
                <div id = "btnSubmitNewLocal">
                    <input name="btnNovoLocal" value="ESCOLHER" type="submit">
                </div>
                
                <div class = "tltPerguntaLocal">
                    Local:
                </div>
                
                <div class = "txtPerguntaLocal">
                    <input type="text" name="txtLocal" placeholder="Rua, beco, local" required maxlength="40">
                </div>
                
                <div class = "tltPerguntaLocal">
                    Telefone:
                </div>
                
                <div class = "txtPerguntaLocal">
                    <input type="text" name="txtTel" placeholder="ex: (XX) XXXX-XXXX" required onkeypress="return validarCel_eTel(event)" id = "txtTel" maxlength="14">
                </div>
                
                <div id = "btnSubmitNewLocal">
                    <input name="btnSalvar" value="ADICIONAR" type="submit">
                </div>
                
                
                

            </div>
        </div>	
        
        <div id = "areaTotal">
            <header>
                <?php
                    require_once("cmsMenu.php");

                    menuCMS();
                ?>
              
            </header>
            
            <main>
                <div id = "tlt">
                    Edição de Locais
                </div>
                
                <div id = "linhaOpcsUser">
                    
                    <a href="cmsCadNovoLocal.php">
                        <div class="itemOpc">
                            <div class = "imgOpcUser">
                                <img src = "Imagens/iconLocation64.png" alt="">
                            </div>


                            <div class="txtOpcUser">
                                Locais
                            </div>
                        </div>
                    </a>
                    
                    <a href="cmsCadNovaCidade.php">
                        <div class="itemOpc">
                            <div class = "imgOpcUser">
                                <img src = "Imagens/iconCity64.png" alt="">
                            </div>

                            <div class="txtOpcUser">
                                Cidades
                            </div>
                        </div>
                    </a>
                </div>
            </main>
            
            <footer>
                Desenvolvido por : <span>WilliamCorp</span>
            </footer>
        </div>
        
    </body>
</html>