<?php
    
    require_once("CMS/modulo/modulo.php");

    conexaoBanco();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Home</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="CSS/styleHome.css">
        <link rel="shortcut icon" href="Imagens/Logo.png" type="image/x-icon">

        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/jquery.nivo.slider.js"></script>

        <script type="text/javascript"> 
            $(window).on('load', function() {
                $('#slider').nivoSlider(); 
            }); 
        </script>
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
        <div id = "roubaEspaco"><!-- TOMA ESPAÇO PARA O MENU FICAR CERTO QUANDO ROLAR O SCROOL -->
        
        </div>
        
        <!-- ITENS DO SLIDE -->
        <div class="slider-wrapper theme-mi-slider">
            <div id="slider" class="nivoSlider"><!-- CAIXA PARA COLOCAR IMAGENS DO SLIDE -->
                <img src="Imagens/imgSlide1.jpg" alt="" title="#htmlcaption1" />  
                <img src="Imagens/imgSlide2.jpg" alt="" title="#htmlcaption2" />    
                <img src="Imagens/imgSlide3.jpg" alt="" title="#htmlcaption3" />     
            </div> 
            <div id="htmlcaption1" class="nivo-html-caption"><!-- TEXTOS DA PRIMEIRA IMAGEM -->     
                <h1>Delícia Gelada</h1>
                <p>Viva o verão de forma hidratada</p>
            </div>
            <div id="htmlcaption2" class="nivo-html-caption"><!-- TEXTOS DA SEGUNDA IMAGEM -->
                <h1>Alimentação Saudável é puro amor</h1>
                <p>Faça com que você e sua família sejam mais saudáveis</p>
            </div>
            <div id="htmlcaption3" class="nivo-html-caption"><!-- TEXTOS DA TERCEIRA IMAGEM -->     
                <h1>Ser saudável é ser feliz</h1>
                <p>Cuide bem do seu amor</p>
            </div>
        </div>
        <main id="main"><!-- CAIXA DO CONTEUDO -->
            
            <div id="redesSocias"><!-- ÁREA REDES SOCIAIS -->
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
            
            
            <div id="areaProdutos_Menu">
                <div id = "menuItens"><!-- MENU LATERAL -->
                    <nav id = "menuItens_ladoProdutos">
                        <div class="itens_ladoProdutos">
                            item 1
                        </div>
                        <div class="itens_ladoProdutos">
                            item 2
                        </div>
                    </nav>
                </div>
                
                <div id="areaProdutos"><!--  -->
                    <div id="tituloProdutos">
                        <h1>PRODUTOS</h1>
                    </div>
                    
                    <div class="linhaProdutos">
                        <?php
                            
                            $sql = "SELECT * FROM tbl_produto WHERE home = 1";
                        
                            $select = mysqli_query(connectReturn(), $sql);
                        
                            while($rsProdutosHome = mysqli_fetch_array($select)){
                                
                        ?>
                        <div class="boxProduto"> <!-- CAIXA PARA CADA IMAGEM E DESCRIÇÃO -->
                            <div class="imgProduto">
                                <img src="<?php echo($rsProdutosHome['caminhoImagem']) ?>" alt="">
                            </div>
                            <div class="txtProdutos">
                                <div class="textosProdutos">
                                    Nome:<span><?php echo($rsProdutosHome['nome']) ?></span>
                                </div>
                                
                                <div class="textosProdutos">
                                    Descrição:<span><?php echo($rsProdutosHome['descricao']) ?></span>
                                </div>
                                
                                <div class="textosProdutos">
                                    Preço:<span>R$ <?php echo($rsProdutosHome['preco']) ?></span>
                                </div>
                                
                                <div class="textosProdutos_detail">
                                    Detalhes
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
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
        <script src="JQuery/jquery.flexslider-min.js"></script>
        <script src="JQuery/jquery.flexslider.js"></script>
    </body>
    
</html>