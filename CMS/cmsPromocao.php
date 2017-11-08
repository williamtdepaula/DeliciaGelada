<?php 
    require_once("modulo/modulo.php");
    
    conexaoBanco();
    
    $img1 = "";

    $titulo = "";

    $valorPromo = "";

    $valorPromoGetado = "";

    $caminhoImagem = "";

    if(isset($_POST['btnSalvarPromo'])){//verificando se o botão foi apertado
        
        $valorPromo = $_POST["txtPrecoPromo"];
        $idDoProduto = $_GET["idDoProduto"];
        
        $sql = "INSERT INTO tbl_promocao (precoPromo, idProduto) VALUES (".$valorPromo.", ".$idDoProduto.");";//script para adicionar promoção
        
        mysqli_query(connectReturn(), $sql);
        
        header("location:cmsPromocao.php");
    }

    if(isset($_POST['btnEditar'])){//veririficando se foi editado
        
        $sql = "UPDATE tbl_promocao SET precoPromo = ".$_POST['txtEditValuePromo']." WHERE idProduto =".$_GET['idDoProdutoEdit'].";";//script para atualizar a promo
        
        mysqli_query(connectReturn(), $sql);
        
        header("location:cmsPromocao.php");
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
                    Produtos para Promoção
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
                        $sql = "SELECT * FROM tbl_produto;";//selecionando todos os produtos

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
                                        $sql1 = "SELECT * FROM tbl_promocao WHERE idProduto = ".$rsProduto['idProduto'].";";//script para verificar se está na promoção

                                        $select1 = mysqli_query(connectReturn(), $sql1);
                                        
                                        if($rsPromo = mysqli_fetch_array($select1)){//se sim os icones mudão
                                            
                                           echo "<a href='cmsPromocao.php?modo=editar&id=".$rsProduto['idProduto']."''>
                                           
                                                <img src='Imagens/iconLook24.png' alt=''>
                                           
                                                </a>";
                                            
                                           echo "<a href='cmsPromocao.php?modo=apagar&id=".$rsProduto['idProduto']."'> 
                                           
                                                <img src='Imagens/iconNop.png' alt=''> 
                                           
                                                </a>";
                                        }else{//se não fica um icone diferente
                                            echo "<a class='ver'  href='cmsPromocao.php?modo=add&id=".$rsProduto['idProduto']."'>
                                            
                                            <img src='Imagens/icon_add24.png' alt=''>
                                            
                                                </a>";
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                    
                    
                </form>
                
                <?php
                    if(isset($_GET['modo'])){//verificando o que o usuario quer fazer
                        $modo = $_GET['modo'];
                        
                        $id = $_GET['id'];//resgantando id do link
                        
                        if($modo == "add"){//verificando se quer add

                            $sql = "SELECT * FROM tbl_produto WHERE idProduto=".$id.";";
                                
                            $select = mysqli_query(connectReturn(), $sql);

                            if($rsProdutoAddPromo = mysqli_fetch_array($select)){
                                $caminho = $rsProdutoAddPromo['caminhoImagem'];
                                $titulo = $rsProdutoAddPromo['nome'];
                                $precoOriginal= $rsProdutoAddPromo['preco'];
                            }
                        
                        
                ?>
                    <div id = "areaDetails">
                
                    <form name="frmPromo" method="post" action="cmsPromocao.php?idDoProduto=<?php echo($_GET['id']) ?>">
                        <div id = "areaImgPromo">
                            <img src="<?php echo("../".$caminho); ?>">
                        </div>
                        <div id="tituloPromo">
                            <?php echo($titulo) ?>
                        </div>

                        <div id = "precoOriginal">
                            Preço Original:R$ <?php echo($precoOriginal); ?>
                        </div>
                        <div id = "precoOriginal">
                            Preço Promoção: R$ <input type="text" name="txtPrecoPromo" id="txtPromo" maxlength="10">
                        </div>

                        <div class="btnSalvarDados">
                            <input type="submit" name="btnSalvarPromo" value="SALVAR" id="btnSavePromo">
                    </div>
                        
                    </form>
                    
                <?php  
                        }else if($modo == "apagar"){
                            $sql = "DELETE FROM tbl_promocao WHERE idProduto=".$id.";";
                               
                            mysqli_query(connectReturn(), $sql);
                            
                           ?>
                            <script>

                                alert("Produto retirado da promoção.");

                                window.location='cmsPromocao.php';

                            </script>     
                        <?php
                        }else{
                            $sql = "SELECT * FROM tbl_promocao WHERE idProduto =".$id.";";
                            
                            $select = mysqli_query(connectReturn(), $sql);
                            
                            if($rsProdutoEdit = mysqli_fetch_array($select)){
                                $valorPromoGetado = $rsProdutoEdit['precoPromo'];
                            }
                            
                            $sql = "SELECT * FROM tbl_produto WHERE idProduto =".$id.";";
                            
                            $select = mysqli_query(connectReturn(), $sql);
                            
                            if($rsProduto = mysqli_fetch_array($select)){
                                $nomeProdutoPromo = $rsProduto['nome'];
                                $valorPromoOriginal = $rsProduto['preco'];
                            }
                        ?>
                            <div id = "areaDetails">
                
                        <form name="frmPromoEdit" method="post" action="cmsPromocao.php?idDoProdutoEdit=<?php echo($_GET['id']) ?>">
                            <div id = "areaImgPromo">
                                <img src="Imagens/suco.jpg">
                            </div>
                            <div id="tituloPromo">
                                <?php echo($nomeProdutoPromo) ?>
                            </div>

                            <div id = "precoOriginal">
                                Preço Original:R$ <?php echo($valorPromoOriginal); ?>
                            </div>
                            <div id = "precoOriginal">
                                Preço Promoção: R$ <input type="text" name="txtEditValuePromo" value='<?php echo($valorPromoGetado); ?>'>
                            </div>

                            <div class="btnSalvarDados">
                                <input type="submit" name="btnEditar" value="EDITAR" id="btnSavePromo">
                        </div>

                        </form>
                        
                        <?php
                            
                        }
                    }
                ?>
            </main>
            
            <footer>
                Desenvolvido por : <span>WilliamCorp</span>
            </footer>
        </div>
        
    </body>
</html>