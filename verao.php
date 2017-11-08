<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Verão</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="CSS/styleHome.css">
        <link rel="shortcut icon" href="Imagens/Logo.png" type="image/x-icon">

    </head>
    <body>
        
        <!-- COMEÇO HEADER -->
        <header>
            <?php
                require_once("menuPHP.php");
            
                menu();
            ?>
        </header>
        <!-- FIM HEADER -->
        <div id = "roubaEspaco">
        
        </div>
        
        <main id="mainOutrasPags">
            
            <!-- ÁREA REDES SOCIAIS -->
            <div id="redesSociasOutrasPags">
                <div class="boxRedesSociais">
                    <img src = "Imagens/iconFacebook.png" alt="iconeFace">
                </div>
                <div class="boxRedesSociais">
                    <img src = "Imagens/iconTwitter.png" alt="iconeTwitter">
                </div>
                <div class="boxRedesSociais">
                    <img src = "Imagens/iconYoutube.png" alt="iconeYoutube">
                </div>
            </div>
            
            
            <div id="areaProdutosDestaque">
                
                <div id="sctAreaProdutosDesc">
                    <div id="tituloProdutosOutrasPags">
                        VERÃO
                    </div>
                    
                    <?php 
                        $sql = "select * from tbl_verao";
                    
                        $select = mysqli_query(connectReturn(), $sql);
                    
                        while($rsVerao = mysqli_fetch_array($select)){
                            
                        
                    ?>
                    
                    <div class="linhaIMGeTexto_Promocao">
                        <div class="imgModaVerao"><!-- IMAGEM SOBRE CADA CURIOSIDADE -->
                            <img src="CMS/<?php echo($rsVerao['caminhoImg1']) ?>" alt="imgCuriosidade">
                        </div>

                        <div class= "textoCuriosidade"><!-- TEXTO SOBRE CADA CURIOSIDADE -->
                            <p><?php echo($rsVerao['txt1']) ?></p>
                        </div>
                    </div>
                
                    <div class="linhaIMGeTexto_Promocao">
                            <div class="imgModaVerao"><!-- IMAGEM SOBRE CADA CURIOSIDADE -->
                                <img src="CMS/<?php echo($rsVerao['caminhoImg2']) ?>" alt="imgCuriosidade">
                            </div>

                            <div class= "textoCuriosidade"><!-- TEXTO SOBRE CADA CURIOSIDADE -->
                                <p><?php echo($rsVerao['txt2']) ?></p>
                            </div>
                    </div>
                    <?php
                        }
                    ?>
                    
                </div>
            </div>
            
        </main>
        
        
        <footer>
            <div id="boxFooter">
                <div id = "tituloBoxFooter">
                    <h1><a href = "contato.php">FAÇA SEU CONTATO CONOSCO</a></h1>
                </div>
                <div id="subTitulo">
                    ESTAMOS SEMPRE PRONTOS PARA ATENDE-LOS
                </div>
                <div id = "mapaLinks">
                    <div id = "boxTltMapaLink">
                        <div class = "tltMapLink">
                            Ajuda
                        </div>
                        <div class = "tltMapLink">
                            Site
                        </div>
                        <div class = "tltMapLink">
                            Feedback
                        </div>
                    </div>
                    <div class = "boxItensLinks">
                            <ul>
                                <li><a href = "home1.php">Sucos</a></li>
                                <li><a href = "home1.php">Compra</a></li>
                                <li><a href = "contato.php">Por que?</a></li>
                            </ul>
                        </div>
                        
                        <div class = "boxItensLinks">
                            <ul>
                                <li>Login</li>
                                <li>Logout</li>
                                <li><a href="localidade.php">Localidade</a></li>
                            </ul>
                        </div>
                        
                        <div class = "boxItensLinks">
                            <ul>
                                <li>Facebook</li>
                                <li>Twitter</li>
                                <li>Youtube</li>
                                <li>Contato</li>
                            </ul>
                        </div>
                    
                </div>
            </div>
        </footer>
        
    </body>
    
</html>