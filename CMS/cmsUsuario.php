<?php

    require_once("modulo/modulo.php");

    conexaoBanco();

    if(isset($_GET["modo"])){
        $modo = $_GET["modo"];
        
        //verificando qual o modo
        if($modo == "apagarUser"){
            
            $codigo = $_GET["codigo"];
            
            //script para apagar o usuário selecionado
            $sql = "DELETE FROM tbl_usuario WHERE idUsuario=".$codigo;
            
            mysqli_query(connectReturn(), $sql);
            
            header('location:cmsUsuario.php');
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Administração do Fale Conosco</title>
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
                    Detalhes dos Usuários
                </div>
                
                <div id = "tltItensUsuarios">
                    <div class = "itensTLTUsuario">
                        Nome
                    </div>
                    <div class = "itensTLTUsuario">
                        login
                    </div>
                    <div class = "itensTLTUsuario">
                        Nível
                    </div>
                    <div class = "itensTLTUsuario">
                        OPC
                    </div>
                </div>
                
                
                <?php 
                
                    //SELECT para pegar itens de duas tabelas, e relacionalas
                    $sql = "SELECT u.idUsuario, u.nome, u.login, n.nivel FROM        tbl_usuario as u,
                            tbl_nivel as n WHERE u.idNivel = n.idNivel order by idUsuario desc";
                
                    $select = mysqli_query(connectReturn(), $sql);
                
                    //while para listar itens
                    while($rsItensUsuarios = mysqli_fetch_array($select)){
                      
                ?>
                    <div class = "linhaItensUsuario">
                        <div class = "itensUsuario">
                            <?php  echo($rsItensUsuarios["nome"])?>
                        </div>
                        <div class = "itensUsuario">
                            <?php  echo($rsItensUsuarios["login"])?>
                        </div>
                        <div class = "itensUsuario">
                            <?php  echo($rsItensUsuarios["nivel"])?>
                        </div>
                        <div class = "itensUsuario">
                            
                            <a href="cmsUsuarioAddUser.php?codigo=<?php echo($rsItensUsuarios['idUsuario']);?>">
                                <img src="Imagens/iconLook24.png" alt="">
                            </a>
                            
                            <a href="cmsUsuario.php?modo=apagarUser&codigo=<?php echo($rsItensUsuarios['idUsuario']);?> " onload="Modal();">
                                <img src="Imagens/iconDel24.png" alt="">
                            </a>
                            
                        </div>
                    </div>
                <?php
                    }
                ?>
               
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
                    Cadastro Usuários
                </div>
                
                <div id = "linhaOpcsUser">
                    
                    <a href="cmsUsuarioAddUser.php">
                        <div class="itemOpc">
                            <div class = "imgOpcUser">
                                <img src = "Imagens/user64.png" alt="">
                            </div>


                            <div class="txtOpcUser">
                                Usuários
                            </div>
                        </div>
                    </a>
                    
                    <a href="cmsNivel.php">
                        <div class="itemOpc">
                            <div class = "imgOpcUser">
                                <img src = "Imagens/levelUser64.png" alt="">
                            </div>

                            <div class="txtOpcUser">
                                Nível
                            </div>
                        </div>
                    </a>
                </div>
                
                <div id = "opcUsuarioCad">
                    <a class="ver" href="#" onclick="Modal()">
                        Usuários cadastrados
                    </a>
                    
                </div>
                
            </main>
            
            <footer>
                Desenvolvido por : <span>WilliamCorp</span>
            </footer>
        </div>
        
    </body>
</html>