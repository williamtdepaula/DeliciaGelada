<?php
    
    require_once("modulo/modulo.php");

    conexaoBanco();

    $cidade = null;

    if(isset($_POST["btnEnviar"])){
        $cidade = $_POST["txtCidade"];
        
        $sql = "SELECT * FROM tbl_cidade;";
        
        $select = mysqli_query(connectReturn(), $sql);
        
        while($slcNivel = mysqli_fetch_array($select)){
            if($slcNivel['cidade'] == $cidade){//verificando se o login existe
                $existe = true;
                break;
            }
        }
        
        if($existe == false){
            $sql = "INSERT INTO tbl_cidade(cidade) values('".$cidade."')";
        
            mysqli_query(connectReturn(), $sql);

            header('location:cmsCadNovaCidade.php');
        }else{
            ?>
                <script>
                    alert("A cidade já está cadastra");
                </script>
            <?php
        }
    }

    if(isset($_POST["btnEditar"])){
        $codigoCidade = $_GET["codigoCidade"];
        
        $cidade = $_POST["txtCidade"];

        $sql = "UPDATE tbl_cidade SET cidade = '".$cidade."' WHERE idCidade =".$codigoCidade.";";

        mysqli_query(connectReturn(), $sql);

        header("location:cmsCadNovaCidade.php");
    }

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
                
                <?php
                    if(isset($_GET['codigo'])){
                        $codigo = $_GET['codigo'];

                        $modo = $_GET['modo'];

                        if($modo == 'edicao'){
                            $sql = "SELECT * FROM tbl_cidade WHERE idCidade =".$codigo.";";

                            $select = mysqli_query(connectReturn(), $sql);

                            if($slcCidade = mysqli_fetch_array($select)){
                                $cidade = $slcCidade['cidade'];
                            }

                            
                        ?>
                            <form name="frmEditar" method="post" action="cmsCadNovaCidade.php?codigoCidade=<?php echo($_GET['codigo']) ?>">
                                <div id = "tlt">
                                    Editar Cidade
                                </div>

                                <div class = "tltItemUsuario">
                                    Cidade:
                                </div>

                                <div class = "boxItensNivel">
                                    <input type="text" name="txtCidade" value="<?php echo($cidade) ?>">
                                </div>

                                <div class = "boxItensNivel">
                                    <input type="submit" name="btnEditar" value="Editar">
                                </div>
                            </form>
                        <?php
                        }else{
                            $sql = "DELETE FROM tbl_cidade WHERE idCidade =".$codigo.";";

                            mysqli_query(connectReturn(), $sql);/****ARRRUAMAAAAAAAAAAAAAAAAAr*/

                            ?>
                            <script>

                                alert("Cidade apagada.");

                                window.location='cmsCadNovaCidade.php';

                            </script>

                            <?php
                        }
                    }else{
                        
                ?>
                
                    <form name="frmNivel" method="post" action="cmsCadNovaCidade.php">
                        <div id = "tlt">
                            Editar Cidade
                        </div>

                        <div class = "tltItemUsuario">
                            Cidade:
                        </div>

                        <div class = "boxItensNivel">
                            <input type="text" name="txtCidade" value="<?php echo($cidade) ?>">
                        </div>

                        <div class = "boxItensNivel">
                            <input type="submit" name="btnEnviar" value="Salvar">
                        </div>
                    </form>
                <?php
                    }
                ?>
                
                <div id = "linhaNivelTotal">
                    <div id = "tltItensNivel">
                        <div class="tltNivel">
                            Cidades
                        </div>
                        <div class="tltNivel">
                            Opc
                        </div>
                    </div>
                    
                    <?php
                        $sql = "SELECT * FROM tbl_cidade;";
                    
                        $select = mysqli_query(connectReturn(), $sql);
                    
                        while($slcItensCidade = mysqli_fetch_array($select)){
                    ?>
                    
                            <div class = "linhaItensRepetir">
                                <div class = "itensLinhaRepitir">
                                    <?php echo($slcItensCidade['cidade']) ?>
                                </div>

                                <div class = "itensLinhaRepitir">
                                    <a href="cmsCadNovaCidade.php?modo=edicao&codigo=<?php echo($slcItensCidade['idCidade'])?>">
                                        <img src="Imagens/iconLook24.png" alt="">
                                    </a>
                                    
                                    <a href="cmsCadNovaCidade.php?modo=excluir&codigo=<?php echo($slcItensCidade['idCidade'])?>">
                                        <img src = "Imagens/iconDel24.png" alt="">
                                    </a>
                                    
                                </div>
                            </div>
                    
                    <?php
                       } 
                    ?>
                    
                </div>
                
            </main>
            
            <footer>
                Desenvolvido por : <span>WilliamCorp</span>
            </footer>
        </div>
        
    </body>
</html>