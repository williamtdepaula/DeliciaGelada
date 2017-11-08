<?php
    require_once("CMS/modulo/modulo.php");

    conexaoBanco();

    $usuario = "";
    $senha = "";
    $senhaBD = "";

    $idUser = "";
    
    if(isset($_POST["btnLogin"])){
        $usuario = $_POST["txtUser"];
        $senha = $_POST["txtSenha"];
        
        $sql = "SELECT nome, senha FROM tbl_usuario WHERE login = '".$usuario."' AND senha = '".md5($senha)."';";
        
        $select = mysqli_query(connectReturn(), $sql);
        
        if($rsConsulta = mysqli_fetch_array($select)){
            
            session_start();
            
            $_SESSION['nomeUser'] = $rsConsulta['nome'];
            
            header("location:CMS/cmsAdmConteudo.php");
            
        }else{
            ?>
                <script>
                    alert("Usuário ou senha incorreto, tente novamente!");
                    
                    window.location='home1.php';
                </script>
            <?php
            
        }
    }

    function menu(){
?>
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
                <div id="itensHeader">
                    <div id="boxLogo">
                        <a href="home1.php">
                            <img src="Imagens/Logo.png" id="logoJuice" alt="logo">
                        </a>
                    </div>

                    <nav id="itensMenu">
                        <div class = "txtMenu">
                            <a href="home1.php">HOME</a>
                        </div>
                        <div class = "txtMenu">
                            <a href="destaque.php">DESTAQUE</a>
                        </div>
                        <div class = "txtMenu">
                            <a href="promocao.php">PROMOÇÃO</a>
                        </div>
                        <div class = "txtMenu">
                            <a href="verao.php">VERÃO</a>
                        </div>
                        <div class = "txtMenu">
                            <a href="importancia.php">IMPORTÂNCIA</a>
                        </div>

                        <div class = "txtMenu">
                            <a href="localidade.php">LOCALIZAÇÃO</a>
                        </div>
                        <div class = "txtMenu">
                            <a href="contato.php">CONTATO</a>
                        </div>
                    </nav>

                    <div id="login">
                        <form name="frmLogin" method="post" action="menuPHP.php">
                            <div id = "linhaTxt">
                                <div class="txtNomeLogin">
                                    Usuário:
                                </div>
                                <div class="txtNomeLogin">
                                    Senha:
                                </div>
                            </div>
                            <div id="linhaTxtBox_btn">
                                <div class = "txtsBoxLogin">
                                    <input type="text" name="txtUser" class="itemTxtBoxLogin">
                                </div>
                                <div class = "txtsBoxLogin">
                                    <input type="password" name="txtSenha" class="itemTxtBoxLogin">
                                </div>
                                <div id = "btnLogin">
                                    <input type="submit" name="btnLogin" value="Login" id="itemBtnBoxLogin">
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </header>
        </body>
    </html>
<?php
    }
?>