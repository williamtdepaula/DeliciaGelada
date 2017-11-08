<?php

    require_once("CMS/modulo/modulo.php");

    conexaoBanco();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Promoção</title>
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
                        PROMOÇÃO
                    </div>
                    
                    <div class = "boxPromocao"><!-- LINHA QUE COLOCA TRÊS PROMOÇÕES -->
                        <?php
                        
                            $sql = "SELECT precoPromo, idProduto from tbl_promocao";
                        
                            $select = mysqli_query(connectReturn(), $sql);
                        
                            while($rsPromo = mysqli_fetch_array($select)){
                                $sql1 = "SELECT * FROM tbl_produto WHERE idProduto=".$rsPromo['idProduto'].";";
                                
                                $select1 = mysqli_query(connectReturn(), $sql1);
                                
                                if($rsProduto = mysqli_fetch_array($select1)){
                        ?>
                                    <div class="boxImg">
                                        <div class = "imagemPromo">
                                            <img src="<?php echo($rsProduto['caminhoImagem']) ?>" alt="">
                                        </div>

                                        <div class= "TituloPromoSobreImg">
                                            <?php echo($rsProduto['nome']) ?>
                                        </div>
                                        <div class = "boxPrecos">
                                            <div class = "preco">
                                                Preço Original: R$<?php echo($rsProduto['preco']) ?>
                                            </div>
                                            <div class = "preco">
                                                Por Apenas : R$<?php echo($rsPromo['precoPromo']) ?>
                                            </div>
                                        </div>

                                        <div class="areaBtnComprar">
                                            Comprar
                                        </div>

                                    </div>
                        <?php
                                }
                            }
                        ?>
                        
                    </div>
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