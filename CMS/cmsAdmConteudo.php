<!DOCTYPE html>
<html>
    <head>
        <title>Administração de Conteúdo</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="cssCMS/styleCMS.css">
    </head>
    <body>
        <div id = "areaTotal">
            <header>
                <?php
                    require_once("cmsMenu.php");

                    menuCMS();
                ?>
              
            </header>
            
            <main>
                <div id = "boxLinhaItens">
                    <div class = "boxPages">
                        <a href="cmsHome.php">
                            <div class = "imgPages">
                                <img src="Imagens/imgHomePage.png" alt="">
                            </div>

                            <div class = "txtImgPages">
                                Home Page
                            </div>
                        </a>
                        
                    </div>
                    
                    <div class = "boxPages">
                        <a href="cmsDestaque.php">
                        
                            <div class = "imgPages">
                                
                                <img src="Imagens/imgDestaquesPage.png" alt="">
                                
                            </div>

                            <div class = "txtImgPages">
                                Destaque
                            </div>
                        
                        </a>
                        
                    </div>
                    
                    <div class = "boxPages">
                        <a href="cmsPromocao.php">
                            <div class = "imgPages">
                                <img src="Imagens/imgPromoPage.png" alt="">
                            </div>

                            <div class = "txtImgPages">
                                Promoção
                            </div>
                        
                        </a>
                        
                    </div>
                </div>
                
                
                <div id = "boxLinhaItens">
                    <div class = "boxPages">
                        <a href="cmsVerao.php">
                            <div class = "imgPages">
                                <img src="Imagens/imgVeraoPage.png" alt="">
                            </div>

                            <div class = "txtImgPages">
                                Verão
                            </div>
                
                        </a>
                        
                    </div>
                    
                    <div class = "boxPages">
                        <a href="cmsImportancia.php">
                            <div class = "imgPages">
                                <img src="Imagens/imgImportanciaPage.png" alt="">
                            </div>

                            <div class = "txtImgPages">
                                Importancia
                            </div>
                        </a>
                        
                    </div>
                    
                    <div class = "boxPages">
                        <a href="cmsLocalidade.php">
                            <div class = "imgPages">
                                <img src="Imagens/imgLocalPage.png" alt="">
                            </div>

                            <div class = "txtImgPages">
                                Local
                            </div>
                        
                        </a>
                        
                    </div>
                </div>
            </main>
            
            <footer>
                Desenvolvido por : <span>WilliamCorp</span>
            </footer>
        </div>
        
    </body>
</html>