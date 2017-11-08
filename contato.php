<?php
    require_once("CMS/modulo/modulo.php");

    conexaoBanco();

    $nome = "";
    $email = "";
    $telefone = "";
    $celular = "";
    $homePage = "";
    $linkDoFacebook = "";
    $sexo = "";
    $profissao = "";
    $sugestECritic = "";
    $infProd = "";

    $enviar = false;

    if(isset($_POST["btnEnviar"])){/*VERIFICANDO SE O BOTÃO EXISTE E PEGANDO VALORES*/
        $nome = $_POST["txtNameContato"];
        $email = $_POST["txtEmailContato"];
        $telefone = $_POST["txtTelContato"];
        $celular = $_POST["txtCelContato"];
        $homePage = $_POST["txtHomePageContato"];
        $linkDoFacebook = $_POST["txtLinkFaceContato"];
        $sexo = $_POST["opcSexo"];
        $profissao = $_POST["txtProfContato"];
        $sugestECritic = $_POST["txtAreaSugestao_criticas"];
        $infProd = $_POST["txtAreaInfoProdutos"];
        
        
        /*SCRIPT MYSQL*/
        $sql="INSERT INTO tblcontato(nome, email, telefone, celular, homepage, linkfacebook, sexo, profissao, sugestoes, infoprodutos) VALUES('".$nome."','".$email."','".$telefone."','".$celular."','".$homePage."','".$linkDoFacebook."','".$sexo."','".$profissao."','".$sugestECritic."','".$infProd."');";
        
        
        mysqli_query(connectReturn(), $sql);/*ENVIANDO PARA O BANCO DE DADOS*/
        
        header('location:contato.php');
        
    }



?>



<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Contato</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="CSS/styleHome.css">
        <link rel="shortcut icon" href="Imagens/Logo.png" type="image/x-icon">

        <script>
            
            function mascara(o,f){
                v_obj=o
                v_fun=f
                setTimeout("execmascara()",1)
            }
            function execmascara(){
                v_obj.value=v_fun(v_obj.value)
            }
            function mtel(v){
                v=v.replace(/\D/g,""); //Remove tudo o que não é dígito
                v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
                v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
                return v;
            }
            function mcel(v){
                v=v.replace(/\D/g,"");//Remove tudo o que não é dígito
                v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
                v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
                return v;
            }
            function id( el ){
                return document.getElementById( el );
            }
            window.onload = function(){
                id('txtTelefone').onkeypress = function(){
                    mascara( this, mtel );
                }
                
                id('txtCel').onkeypress = function(){
                    mascara( this, mcel );
                }
            }
            
            function validarCel_eTel(tecla){
                if(window.event){
                    var num = tecla.charCode;
                }else{
                    var num = tecla.which;
                }    
                
                if(!(num >= 48 && num <= 57 || num == 45 || num == 32 || num == 08)){
                    return false;
                }
            }
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
                <form name="frmContato" method="post" action="contato.php">
                    <div id="sctAreaProdutosDesc">
                        <div id="tituloProdutosOutrasPags">
                            CONTATO
                        </div>
                        <!-- CAIXAS DE TEXTO -->
                        <div id="boxContato">
                            <div class="linhaItensContato">
                                <div class = "txtNomeEmailContato">
                                    Nome:*
                                </div>
                                <div class = "boxNomeEmailContato">
                                    <input type="text" name="txtNameContato" class="txtNameEmailContatoEdit" placeholder="Digite seu nome" title="Apenas letras" pattern="[a-z A-Z ã Ã õ Õ é É ô Ô]*" maxlength = "80" required>
                                </div>
                            </div>
                            
                            <div class="linhaItensContato">
                                <div class = "txtNomeEmailContato">
                                    Email:*
                                </div>
                                <div class = "boxNomeEmailContato">
                                    <input type="text" name="txtEmailContato" class="txtNameEmailContatoEdit" placeholder="Digite seu email" title="Apenas letras" maxlength = "100" required>
                                </div>
                            </div>
                            <!-- QUANDO SÃO TODAS CLASSES OS TEXTOS FICAM UM AO LADO DO OUTRO PARA QUE O FLOAT FUNCIONE -->
                            <div class="linhaItensContato">
                                <div class = "txtOutrasBox">
                                    Telefone:
                                </div>
                                <div class = "txtOutrasBox">
                                    Celular:*
                                </div>
                                <div class = "boxOutrasCaixasDeTexto">
                                    <input type="text" name="txtTelContato" class="txtOutrasCaixasEdit" placeholder="DD XXXX-XXXX" onkeypress="return validarCel_eTel(event)" maxlength="14" id="txtTelefone">
                                </div>

                                <div class = "boxOutrasCaixasDeTexto">
                                    <input type="text" name="txtCelContato" class="txtOutrasCaixasEdit" placeholder="DD XXXX-XXXX" required onkeypress="return validarCel_eTel(event)" maxlength="15" id="txtCel">
                                </div>
                            </div>
                            <div class="linhaItensContato">
                                <div class = "txtOutrasBox">
                                    Home Page:
                                </div>
                                <div class = "txtOutrasBox">
                                    Link no Facebook:
                                </div>
                                <div class = "boxOutrasCaixasDeTexto">
                                    <input type="text" name="txtHomePageContato" class="txtOutrasCaixasEdit" maxlength="200">
                                </div>

                                <div class = "boxOutrasCaixasDeTexto">
                                    <input type="text" name="txtLinkFaceContato" class="txtOutrasCaixasEdit" maxlength="200">
                                </div>
                            </div>
                            <div class="linhaItensContato">
                                <div class = "ladoEsquerdoContato">
                                    <div id = "txtSexo">
                                        Sexo:*
                                    </div>

                                    <div class = "boxOpcSexo">
                                        <input type="radio" name="opcSexo" value="M" checked>Masculino
                                    </div>
                                    <div class = "boxOpcSexo">
                                        <input type="radio" name="opcSexo" value="F">Feminino
                                    </div>
                                </div>
                                <div class = "ladoDireitoContato">
                                    <div class = "txtOutrasBox">
                                        Profissão:*
                                    </div>
                                    <div class = "boxOutrasCaixasDeTexto">
                                        <input type="text" name="txtProfContato" class="txtOutrasCaixasEdit" required>
                                    </div>
                                </div>
                            </div>
                            <div class="linhaItensContato">
                                <div class = "ladoEsquerdoContato">
                                    <div class = "txtOutrasBox">
                                        Sugestão/Críticas
                                    </div>
                                    <div class = "boxOutrasCaixasDeTexto">
                                        <textarea name="txtAreaSugestao_criticas" cols="40" rows="5" class="txtArea" placeholder="Digite uma sugestão ou uma crítica" maxlength="255"></textarea>
                                    </div>
                                </div>
                                <div class = "ladoDireitoContato">
                                    <div class = "txtOutrasBox">
                                        Informações do Produto:
                                    </div>
                                    <div class = "boxOutrasCaixasDeTexto">
                                        <textarea name="txtAreaInfoProdutos" cols="40" rows="5" class="txtArea" placeholder="Digite informações do produto" maxlength="255"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="linhaItensContato">
                                <input type="submit" name="btnEnviar" value="Enviar">
                            </div>
                        </div>
                    </div>
                </form>
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