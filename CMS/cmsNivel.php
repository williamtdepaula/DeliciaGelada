<?php
    require_once("modulo/modulo.php");

    conexaoBanco();

    $nivel = "";

    $existe = false;

    if(isset($_POST["btnEnviar"])){
        $nivel = $_POST["txtNivel"];
        
        $sql = "SELECT * FROM tbl_nivel;";
        
        $select = mysqli_query(connectReturn(), $sql);
        
        while($slcNivel = mysqli_fetch_array($select)){
            if($slcNivel['nivel'] == $nivel){//verificando se o login existe
                $existe = true;
                break;
            }
        }
        
        if($existe == false){
            $sql = "INSERT INTO tbl_nivel(nivel) values('".$nivel."')";
        
            mysqli_query(connectReturn(), $sql);

            header('location:cmsNivel.php');
        }else{
            ?>
                <script>
                    alert("O Nivel já está cadastro");
                </script>
            <?php
        }
    }

    if(isset($_POST["btnEditar"])){
        $codigoNivel = $_GET["codigoNivel"];
        
        $txtNivel = $_POST["txtNivel"];

        $sql = "UPDATE tbl_nivel SET nivel = '".$txtNivel."' WHERE idNivel =".$codigoNivel.";";

        mysqli_query(connectReturn(), $sql);

        header("location:cmsNivel.php");
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
                <?php
                    if(isset($_GET['codigo'])){
                        $codigo = $_GET['codigo'];

                        $modo = $_GET['modo'];

                        if($modo == 'edicao'){
                            $sql = "SELECT * FROM tbl_nivel WHERE idNivel =".$codigo.";";

                            $select = mysqli_query(connectReturn(), $sql);

                            if($slcNivel = mysqli_fetch_array($select)){
                                $nivel = $slcNivel['nivel'];
                            }

                            
                        ?>
                            <form name="frmEditar" method="post" action="cmsNivel.php?codigoNivel=<?php echo($_GET['codigo']) ?>">
                                <div id = "tlt">
                                    Editar Níveis
                                </div>

                                <div class = "tltItemUsuario">
                                    Nível:
                                </div>

                                <div class = "boxItensNivel">
                                    <input type="text" name="txtNivel" value="<?php echo($nivel) ?>">
                                </div>

                                <div class = "boxItensNivel">
                                    <input type="submit" name="btnEditar" value="Editar">
                                </div>
                            </form>
                        <?php
                        }else{
                            $sql = "DELETE FROM tbl_nivel WHERE idNivel =".$codigo.";";

                            mysqli_query(connectReturn(), $sql);

                            header("location:cmsNivel.php");
                        }
                    }else{
                        
                ?>
                
                    <form name="frmNivel" method="post" action="cmsNivel.php">
                        <div id = "tlt">
                            Editar Níveis
                        </div>

                        <div class = "tltItemUsuario">
                            Nível:
                        </div>

                        <div class = "boxItensNivel">
                            <input type="text" name="txtNivel" value="<?php echo($nivel) ?>">
                        </div>

                        <div class = "boxItensNivel">
                            <input type="submit" name="btnEnviar" value="Salvar">
                        </div>
                    </form>
                <?php
                    }
                ?>
                
                <div id = "linhaNivelTotal">
                    <div id = "tltItensNivel">
                        <div class="tltNivel">
                            Nível
                        </div>
                        <div class="tltNivel">
                            Opc
                        </div>
                    </div>
                    
                    <?php
                        $sql = "SELECT * FROM tbl_nivel;";
                    
                        $select = mysqli_query(connectReturn(), $sql);
                    
                        while($slcItensNivel = mysqli_fetch_array($select)){
                    ?>
                    
                            <div class = "linhaItensRepetir">
                                <div class = "itensLinhaRepitir">
                                    <?php echo($slcItensNivel['nivel']) ?>
                                </div>

                                <div class = "itensLinhaRepitir">
                                    <a href="cmsNivel.php?modo=edicao&codigo=<?php echo($slcItensNivel['idNivel'])?>">
                                        <img src="Imagens/iconLook24.png" alt="">
                                    </a>
                                    
                                    <a href="cmsNivel.php?modo=excluir&codigo=<?php echo($slcItensNivel['idNivel'])?>">
                                        <img src = "Imagens/iconDel24.png" alt="">
                                    </a>
                                    
                                </div>
                            </div>
                    
                    <?php
                       } 
                    ?>
                    
                </div>
                
                
            </main>
            
            
            <footer>
                Desenvolvido por : <span>WilliamCorp</span>
            </footer>
        </div>
        
    </body>
</html>