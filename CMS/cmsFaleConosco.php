<?php
    session_start();

    require_once("modulo/modulo.php");

    conexaoBanco();


    $rdMasc = "";
    $rdFem = "";

    $nome="";
    $email="";
    $telefone="";
    $celular="";
    $homepage="";
    $linkfacebook="";
    $sexo="";
    $profissao="";
    $sugestoes="";
    $infoprodutos="";
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
                <div id="linhaItensContato">
                    <div class="itensContato">
                        Nome
                    </div>
                    <div class="itensContato">
                        Email
                    </div>
                    <div class="itensContato">
                        Celular
                    </div>
                    <div class="itensContato">
                        Profissão
                    </div>
                    <div class="itensContato">
                        Sexo
                    </div>
                    <div class = "itensContato">
                        Opc
                    </div>
                </div>
                
                <?php
                
                    //selecionar os itens do fale conosoco
                    $sql= "SELECT * FROM tblcontato;";
                    
                    $select = mysqli_query(connectReturn(), $sql);
                
                    //listar os itens do fale conosco
                    while($rsItensContato = mysqli_fetch_array($select)){
                ?>
                        <div class = "linhaConteudoItensContato">
                            <div class = "conteudoItensContato">
                                <?php echo($rsItensContato['nome']) ?>
                            </div>
                            <div class = "conteudoItensContato">
                                <?php echo($rsItensContato['email']) ?>
                            </div>
                            <div class = "conteudoItensContato">
                                <?php echo($rsItensContato['celular']) ?>
                            </div>
                            <div class = "conteudoItensContato">
                                <?php echo($rsItensContato['profissao']) ?>
                            </div>
                            <div class = "conteudoItensContato">
                                <?php echo($rsItensContato['sexo']) ?>
                            </div>
                            <div class = "conteudoItensContato">
                                
                                <a href="cmsFaleConosco.php?modo=verDetalhes&codigo=<?php echo($rsItensContato['idcontato']) ?>">
                                    <img src="Imagens/iconLook24.png" alt="">
                                </a>
                                
                                <a href="cmsFaleConosco.php?modo=apagarContato&codigo=<?php echo($rsItensContato['idcontato']) ?>">
                                    <img src="Imagens/iconDel24.png" alt="">
                                </a>
                                
                            </div>
                        </div>
                <?php
                    }
                ?>
                
                <div id="areaProdutosDestaque">
                    <form name="frmContato" method="post" action="contato.php">
                        <?php
                            if(isset($_GET["modo"])){
                                $modo = $_GET["modo"];//verificando o modo que o usuario selecionou

                                if($modo == "verDetalhes"){

                                    $codigo = $_GET["codigo"];

                                    //listar os itens do fale conosco para ver nos detalhes
                                    $sql = "SELECT * FROM tblcontato WHERE idContato=".$codigo;

                                    $select = mysqli_query(connectReturn(), $sql);

                                    if($rsConsulta = mysqli_fetch_array($select)){
                                        $nome=$rsConsulta['nome'];
                                        $email=$rsConsulta['email'];
                                        $telefone=$rsConsulta['telefone'];
                                        $celular=$rsConsulta['celular'];
                                        $homepage=$rsConsulta['homepage'];
                                        $linkfacebook=$rsConsulta['linkfacebook'];
                                        $sexo=$rsConsulta['sexo'];
                                        $profissao=$rsConsulta['profissao'];
                                        $sugestoes=$rsConsulta['sugestoes'];
                                        $infoprodutos=$rsConsulta['infoprodutos'];

                                        if($sexo=="M"){
                                            $rdMasc = "checked";
                                        }else{
                                            $rdFem = "checked";
                                        }
                                    }
                                ?>
                                    <div id="sctAreaProdutosDesc">
                                        <!-- CAIXAS DE TEXTO -->
                                        <div id="boxContato">
                                            <div class="linhaItensContato">
                                                <div class = "txtNomeEmailContato">
                                                    Nome:*
                                                </div>
                                                <div class = "boxNomeEmailContato">
                                                    <input type="text" name="txtNameContato" class="txtNameEmailContatoEdit" placeholder="Digite seu nome" title="Apenas letras" pattern="[a-z A-Z ã Ã õ Õ é É ô Ô]*" maxlength = "80" required value="<?php echo($nome) ?>">
                                                </div>
                                            </div>

                                            <div class="linhaItensContato">
                                                <div class = "txtNomeEmailContato">
                                                    Email:*
                                                </div>
                                                <div class = "boxNomeEmailContato">
                                                    <input type="text" name="txtEmailContato" class="txtNameEmailContatoEdit" placeholder="Digite seu email" title="Apenas letras" maxlength = "100" required value="<?php echo($email) ?>">
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
                                                    <input type="text" name="txtTelContato" class="txtOutrasCaixasEdit" placeholder="DD XXXX-XXXX" onkeypress="return validarCel_eTel(event)" maxlength="14" id="txtTelefone" value="<?php echo($telefone) ?>">
                                                </div>

                                                <div class = "boxOutrasCaixasDeTexto">
                                                    <input type="text" name="txtCelContato" class="txtOutrasCaixasEdit" placeholder="DD XXXX-XXXX" required onkeypress="return validarCel_eTel(event)" maxlength="15" id="txtCel" value="<?php echo($celular) ?>">
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
                                                    <input type="text" name="txtHomePageContato" class="txtOutrasCaixasEdit" maxlength="200" value="<?php echo($homepage) ?>">
                                                </div>

                                                <div class = "boxOutrasCaixasDeTexto">
                                                    <input type="text" name="txtLinkFaceContato" class="txtOutrasCaixasEdit" maxlength="200" value="<?php echo($linkfacebook) ?>">
                                                </div>
                                            </div>
                                            <div class="linhaItensContato">
                                                <div class = "ladoEsquerdoContato">
                                                    <div id = "txtSexo">
                                                        Sexo:*
                                                    </div>

                                                    <div class = "boxOpcSexo">
                                                        <input type="radio" name="opcSexo" value="M" <?php echo($rdMasc) ?>>Masculino
                                                    </div>
                                                    <div class = "boxOpcSexo">
                                                        <input type="radio" name="opcSexo" value="F" <?php echo($rdFem) ?>>Feminino
                                                    </div>
                                                </div>
                                                <div class = "ladoDireitoContato">
                                                    <div class = "txtOutrasBox">
                                                        Profissão:*
                                                    </div>
                                                    <div class = "boxOutrasCaixasDeTexto">
                                                        <input type="text" name="txtProfContato" class="txtOutrasCaixasEdit" required value="<?php echo($profissao) ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="linhaItensContato">
                                                <div class = "ladoEsquerdoContato">
                                                    <div class = "txtOutrasBox">
                                                        Sugestão/Críticas
                                                    </div>
                                                    <div class = "boxOutrasCaixasDeTexto">
                                                        <textarea name="txtAreaSugestao_criticas" cols="40" rows="5" class="txtArea" placeholder="Digite uma sugestão ou uma crítica" maxlength="255"><?php echo($sugestoes) ?></textarea>
                                                    </div>
                                                </div>
                                                <div class = "ladoDireitoContato">
                                                    <div class = "txtOutrasBox">
                                                        Informações do Produto:
                                                    </div>
                                                    <div class = "boxOutrasCaixasDeTexto">
                                                        <textarea name="txtAreaInfoProdutos" cols="40" rows="5" class="txtArea" placeholder="Digite informações do produto" maxlength="255"><?php echo($infoprodutos) ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="linhaItensContato">
                                                <input type="submit" name="btnEnviar" value="Enviar">
                                            </div>
                                        </div>
                                    </div>
                    
                        <?php
                                }else{

                                    $codigo = $_GET["codigo"];

                                    //script para apagar um certo item do fale conosco do banco de dados
                                    $sql="DELETE FROM tblcontato WHERE idContato=".$codigo;

                                    mysqli_query(connectReturn(), $sql);
                                    
                                    ?>
                                    <script>
                        
                                        alert("Mensagem apagada.");
                                        
                                        window.location='cmsFaleConosco.php';
                                        
                                    </script>
                                    
                                    <?php
                                }
                            }
                        ?>
                    </form>        
                </div>
            </main>
            
            <footer>
                Desenvolvido por : <span>WilliamCorp</span>
            </footer>
        </div>
        
    </body>
</html>