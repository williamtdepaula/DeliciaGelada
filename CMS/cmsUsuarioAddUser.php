<?php
    
    require_once("modulo/modulo.php");

    conexaoBanco();
    
    $nome = "";
    $login = "";
    $usuario = "";
    $slcNivel = "";
    $logado = 0;

    $existe = false;

    if(isset($_POST["btnEnviar"])){//verificando se apertou no botão enviar
        
        $nome = $_POST["txtNome"];
        $login = $_POST["txtLogin"];
        $senha = $_POST["txtSenha"];
        $slcNivel = $_POST["slcNivel"];
        
        //script para selecionar itens da tablea usuario
        $sql = "SELECT * FROM tbl_usuario;";
        
        $select = mysqli_query(connectReturn(), $sql);
        
        while($slcUsuario = mysqli_fetch_array($select)){
            if($slcUsuario['login'] == $login){//verificando se o login existe
                $existe = true;
                break;
            }
        }
        
        if($existe == false){//se n existir ele cadastra o usuario
            $senha = md5($senha);
            
            $sql = "INSERT INTO tbl_usuario (nome, login, senha, idNivel) 
            VALUES('".$nome."', '".$login."', '".$senha."', '".$slcNivel."')";

            mysqli_query(connectReturn(), $sql);

            header("location:cmsUsuarioAddUser.php");
         
        }else{//se não ele da um alert na sala
            ?>
                <script>
                    alert("Este usuário ja está cadastrado");
                </script>
            <?php
        }
    }

    if(isset($_POST["btnEditar"])){//verificando se o botão editar foi apertado
        
        $codigo = $_GET["codigoUsuario"];
        
        $nome = $_POST["txtNome"];
        $login = $_POST["txtLogin"];
        $senha = $_POST["txtSenha"];
        $slcNivel = $_POST["slcNivel"];
        
        if($senha != ""){//verificando se a senha será mudada ou não
            
            //script de update para banco de dados quando a senha for mudada
            $sql = "UPDATE tbl_usuario SET nome = '".$nome."', login ='".$login."', senha ='".md5($senha)."', idNivel = '".$slcNivel."' WHERE idUsuario =".$codigo;
            
        }else{
            //script de update para banco de dados quando a senha não for mudada
            $sql = "UPDATE tbl_usuario SET nome = '".$nome."', login ='".$login."', idNivel = '".$slcNivel."' WHERE idUsuario =".$codigo;
            
        }
        
        mysqli_query(connectReturn(), $sql);

        header("location:cmsUsuario.php"); 
        
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
                        Detalhe Usuários
                    </div>
                    
                    <?php
                        if(isset($_GET["codigo"])){
                            
                            $codigo = $_GET["codigo"];//resgatando o idUsuario da pagina cmsUsuario
                                
                            //script para selecionar itens sobre o usuario
                            $sql = "SELECT * FROM tbl_usuario WHERE idUsuario =".$codigo;

                            $select = mysqli_query(connectReturn(), $sql);
                            
                            if($slcUsuario = mysqli_fetch_array($select)){

                    ?>
                        <form name="frmUsuarioEditar" method="post" action="cmsUsuarioAddUser.php?codigoUsuario=<?php echo($_GET['codigo'])?>">
                        
                                <div class = "tltItemUsuario">
                                    Nome:
                                </div>

                                <div class = "boxItensNivel">
                                    <input type="text" name="txtNome" class="txtNomeUsuario" maxlength="20" value="<?php echo($slcUsuario["nome"]) ?>">
                                </div>

                                <div class = "tltItemUsuario">
                                    Login:
                                </div>

                                <div class = "boxItensNivel">
                                    <input type="text" name="txtLogin" class="txtNomeUsuario" maxlength="8" value="<?php echo($slcUsuario["login"]) ?>" >
                                </div>

                                <div class = "tltItemUsuario">
                                    Senha:
                                </div>

                                <div class = "boxItensNivel">
                                    <input type="password" name="txtSenha" class="txtNomeUsuario" maxlength="20" value="">
                                </div>

                                <div class = "tltItemUsuario">
                                    Nivel:
                                </div>

                                <div class = "boxItensNivel">
                                    <select name="slcNivel">
                                        <?php
                                        
                                            //script para selecionar o id do Nivel do usuario
                                            $sql = "SELECT idNivel FROM tbl_usuario where idUsuario = ".$codigo;                
                            
                                            $select = mysqli_query(connectReturn(), $sql);
                                        
                                            $rsIdNivel = mysqli_fetch_array($select);
                                            
                                            //script para selecionar o nome do Nivel na tabela NIVEL
                                            $sql = "SELECT nivel FROM tbl_nivel where idNivel =".$rsIdNivel['idNivel'];
                                            
                                            $select = mysqli_query(connectReturn(), $sql);
                                
                                            $rsNomeNivel = mysqli_fetch_array($select);
                                
                                            //deixando uma option padrão no comboBox
                                        ?>
                                            <option value="<?php echo($rsIdNivel['idNivel']) ?>"><?php echo($rsNomeNivel['nivel']) ?></option>
                                        
                                        <?php
                                            //script para selecionar todos os itens menos o do usuario cadastrado
                                            $sql = "SELECT * FROM tbl_nivel WHERE idNivel !=".$rsIdNivel['idNivel'];
                                
                                            $select = mysqli_query(connectReturn(), $sql);
                                            
                                            //listar os niveis, menos o que o usuario já tem
                                            while($rsNiveis = mysqli_fetch_array($select)){

                                        ?>
                                            <option value="<?php echo($rsNiveis['idNivel']) ?>"><?php echo($rsNiveis['nivel']) ?></option>

                                        <?php
                                            }
                                        ?>

                                    </select>
                                </div>
                    
                                <div class = "btnSalvarDados">
                                    <input type="submit" name="btnEditar" value="Editar">
                                </div>
                        </form>
                    <?php
                            }
                        }else{
                    ?>
                            <form name="frmIserirUser" method="post" action="cmsUsuarioAddUser.php">
                    
                                
                                <div class = "tltItemUsuario">
                                    Nome:
                                </div>

                                <div class = "boxItensNivel">
                                    <input type="text" name="txtNome" class="txtNomeUsuario" maxlength="20" required>
                                </div>

                                <div class = "tltItemUsuario">
                                    Login:
                                </div>

                                <div class = "boxItensNivel">
                                    <input type="text" name="txtLogin" class="txtNomeUsuario" maxlength="8" required>
                                </div>

                                <div class = "tltItemUsuario">
                                    Senha:
                                </div>

                                <div class = "boxItensNivel">
                                    <input type="password" name="txtSenha" class="txtNomeUsuario" maxlength="20" required> 
                                </div>

                                <div class = "tltItemUsuario">
                                    Nivel:
                                </div>

                                <div class = "boxItensNivel">
                                    <select name="slcNivel">
                                        <?php
                                            //script para selecionar o nivel quando for cadastrar um novo usuario
                                            $sql = "SELECT * FROM tbl_nivel";

                                            $select = mysqli_query(connectReturn(), $sql);
                                            
                                            //listar niveis
                                            while($rsNiveis = mysqli_fetch_array($select)){

                                        ?>
                                            <option value="<?php echo($rsNiveis['idNivel']) ?>"><?php echo($rsNiveis['nivel']) ?></option>

                                        <?php
                                            }
                                        ?>

                                    </select>
                                </div>
                    
                                <div class = "btnSalvarDados">
                                    <input type="submit" name="btnEnviar" value="Salvar">
                                </div>
                                
                            </form>
                    <?php
                        }
                    ?>
            </main>
            
            <footer>
                Desenvolvido por : <span>WilliamCorp</span>
            </footer>
        </div>
        
    </body>
</html>