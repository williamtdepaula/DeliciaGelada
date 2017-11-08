<?php
    require_once("modulo/modulo.php");
    
    conexaoBanco();
    

    @session_start();
    
    $nome = "";
    $idUsuario = "";

    if(isset($_GET['logout'])){
        session_destroy();
        
        header('location:../home1.php');
    }

    function menuCMS(){ 
        @session_start();
        
?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Administração de Conteúdo</title>
            <meta charset="utf-8">
            <link rel="stylesheet" type="text/css" href="cssCMS/styleCMS.css">
        </head>
        <header>
            <div id = "linhaCima">
                <div id = "txtTltCMS">
                    <span>CMS</span> - Sistema de Gerenciamento do Site
                </div>

                <div id = "imgTltCMS">
                    <img src = "Imagens/Logo.png" alt="">
                </div>
            </div> 

            <nav>
                <a href = "cmsAdmConteudo.php">
                    <div class = "blocoItensMenuCMS">
                        <div class = "imgItemMenuCMS">
                            <img src="Imagens/content128.png" alt="">
                        </div>
                        <div class = "txtItemMenuCMS">
                            Adm. Conteúdo
                        </div>
                    </div>
                </a>

                <a href="cmsFaleConosco.php">
                    <div class = "blocoItensMenuCMS">
                        <div class = "imgItemMenuCMS">
                            <img src="Imagens/contact128.png" alt="">
                        </div>
                        <div class = "txtItemMenuCMS">
                            Adm. Fale Conosco
                        </div>
                    </div>
                </a>

                <div class = "blocoItensMenuCMS">
                    <div class = "imgItemMenuCMS">
                        <img src="Imagens/product128.png" alt="">
                    </div>
                    <div class = "txtItemMenuCMS">
                        Adm. Produtos
                    </div>
                </div>

                <a href="cmsUsuario.php">
                    <div class = "blocoItensMenuCMS">
                        <div class = "imgItemMenuCMS">
                            <img src="Imagens/users128.png" alt="">
                        </div>
                        <div class = "txtItemMenuCMS">
                            Adm. Usuários
                        </div>
                    </div>
                </a>

            </nav>

            <div id = "nomeUsuario">
                <div id = "nomeUsuarioLogado">
                    Bem vindo, <span><?php echo($_SESSION['nomeUser'])?></span>
                </div>
                <div id = "logoutUsuario">
                    <a href="cmsMenu.php?logout=true">
                        Logout
                    </a>
                    
                </div>
            </div>

        </header>
    </html>
<?php
    }
?>