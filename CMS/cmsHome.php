<?php
    
    require_once("modulo/modulo.php");

    conexaoBanco();

    if(isset($_POST['btnSalvarHome'])){
        
        $sql = "UPDATE tbl_produto SET home = 0;";
        
        mysqli_query(connectReturn(), $sql);
        foreach($_POST['marcar'] as $item){//repetindo itens do array da variavel marcar que é as checkboxs
            
            //script para marcalos para aparecer na tela da home
            $sql = "UPDATE tbl_produto SET home = 1 WHERE idProduto =".$item.";";
            
            mysqli_query(connectReturn(), $sql);
        }
        
       header("location:cmsHome.php");
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Administração do Fale Conosco</title>
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
                    <div id = "tlt">
                        ADICIONE ITENS A HOME
                    </div>
                    
                    <div id = "areaTltsDestaque">
                        <div class = "tltDestaque">
                            NOME
                        </div>
                        <div class = "tltDestaque">
                            DESCRIÇÃO
                        </div>
                        <div class = "tltDestaque">
                            PREÇO
                        </div>
                        <div class = "tltDestaque">
                            ADD HOME
                        </div>
                    </div>
                
                    <form name="frmProdutosHome" method="post" action="cmsHome.php">
                        <?php
                            $sql = "SELECT * FROM tbl_produto;";

                            $select = mysqli_query(connectReturn(), $sql);

                            while($rsProduto = mysqli_fetch_array($select)){
                        ?>

                                <div class="linhaDestaqueRepetir">
                                    <div class = "itensProdutoDestaque">
                                        <?php echo($rsProduto['nome']) ?>
                                    </div>
                                    <div class = "itensProdutoDestaque">
                                        <?php echo($rsProduto['descricao']) ?>
                                    </div>
                                    <div class = "itensProdutoDestaque">
                                        R$<?php echo($rsProduto['preco']) ?>
                                    </div>
                                    <div class = "itensProdutoDestaque">
                                        <?php 
                                            if($rsProduto['home'] == 0){
                                        ?>
                                                <div class = "boxOpcSexo">
                                                    <input type="checkbox" name="marcar[]" value="<?php echo($rsProduto['idProduto']) ?>">
                                                </div>
                                                
                                        <?php
                                            }else{
                                        ?>
                                                <div class = "boxOpcSexo">
                                                    <input type="checkbox" name="marcar[]" value="<?php echo($rsProduto['idProduto']) ?>" checked>
                                                </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                        <?php
                            }
                        ?>
                    
                    <div id="areaBtn">
                        <input type="submit" name="btnSalvarHome" value="Salvar">
                    </div>
                    
                    
                </form>
            </main>
            
            <footer>
                Desenvolvido por : <span>WilliamCorp</span>
            </footer>
        </div>
        
    </body>
</html>