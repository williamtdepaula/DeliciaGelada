<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Locais</title>
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
                        LOCALIDADE
                    </div>
                    
                    <?php
                    
                        $sql = "select l.logradouro, l.telefone, l.caminhoImagem, c.cidade, e.sigla 
                                from tbl_localidade as l inner join tbl_cidade as c on l.idCidade = c.idCidade
                                Inner join tbl_estado as e on l.idEstado = e.idEstado where l.aparecer = 1;";
                    
                        $select = mysqli_query(connectReturn(), $sql);
                    
                        while($rsLocalEstadoCidade = mysqli_fetch_array($select)){
                    
                    ?>
                    
                            <div class = "boxLugares"><!-- BOX DE TODOS LUGARES -->
                                <div class="boxDetails"><!-- BOX DE DETALHES SOBRE O LUGAR -->
                                    <div class = "lineLocal">
                                        <div class="boxImgLocal">
                                            <img src = "Imagens/iconLocal.png" alt="gps">
                                        </div>
                                        <div class="boxTextoLocal">
                                            <?php echo($rsLocalEstadoCidade['logradouro'].", ".$rsLocalEstadoCidade['cidade']." - ".$rsLocalEstadoCidade['sigla']) ?>
                                        </div>
                                    </div>
                                    <div class = "lineLocal">
                                        <div class="boxImgLocal">
                                            <img src = "Imagens/iconPhone.png" alt="tel">
                                        </div>
                                        <div class="boxTextoLocal">
                                            <?php echo($rsLocalEstadoCidade['telefone']) ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="boxImgDetails"><!-- BOX DA IMAGEM DO LUGAR-->
                                    <img src = "<?php echo("CMS/".$rsLocalEstadoCidade['caminhoImagem']) ?>" alt="lugar">
                                </div>
                            </div>
                    
                    <?php
                        }
                    
                    ?>
                    
                    <!--<div class = "boxLugares">
                        <div class="boxDetails">
                            <div class = "lineLocal">
                                <div class="boxImgLocal">
                                    <img src = "Imagens/iconLocal.png" alt="gps">
                                </div>
                                <div class="boxTextoLocal">
                                    Rua Atanázio Soares, 3430 - Vila Terron, Sorocaba - SP
                                </div>
                            </div>
                            <div class = "lineLocal">
                                <div class="boxImgLocal">
                                    <img src = "Imagens/iconPhone.png" alt="tel">
                                </div>
                                <div class="boxTextoLocal">
                                    (14) - 3879-9508
                                </div>
                            </div>
                        </div>
                        
                        <div class="boxImgDetails">
                            <img src = "Imagens/local2.jpg" alt="lugar">
                        </div>
                    </div>-->
                    
                </div>
            </div>
            
        </main>
        
        
        <footer><!-- AREA DO FOOTER -->
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
                    <div id = "boxLinks">
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
            </div>
        </footer>
    </body>
    
</html>