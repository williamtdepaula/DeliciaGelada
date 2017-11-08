<?php 
    require_once("modulo/modulo.php");
    
    conexaoBanco();

    if(isset($_POST['btnSalvar'])){
        
        $sql = "UPDATE tbl_produto SET destaque = 0;";
        
        mysqli_query(connectReturn(), $sql);
        
        foreach($_POST['marcar'] as $item){//repetindo itens do array da variavel marcar que é as checkboxs
            
            //script para marcalos para aparecer na tela da home
            $sql = "UPDATE tbl_produto SET destaque = 1 WHERE idProduto =".$item.";";
            
            mysqli_query(connectReturn(), $sql);
        }
        
       header("location:cmsDestaque.php");
    }

?>

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
                <div id = "tlt">
                    Produtos para destaque
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
                        DESTAQUE
                    </div>
                </div>
                
                <form name="frmProdutosDestaque" method="post" action="cmsDestaque.php">
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
                                            if($rsProduto['destaque'] == 0){
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
                        <input type="submit" name="btnSalvar" value="Salvar">
                    </div>
                    
                    
                </form>
                
                
            </main>
            
            <footer>
                Desenvolvido por : <span>WilliamCorp</span>
            </footer>
        </div>
        
    </body>
</html>