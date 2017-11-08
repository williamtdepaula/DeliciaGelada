<?php
require_once("modulo/modulo.php");

    conexaoBanco();

    $opc = null;

    if(isset($_POST['btnOk'])){//pega a opção selecionada
        $opc = $_POST["opcs"];
    }

    if(isset($_POST['btnEditarVerao'])){//verificando se apertou no botão
        $txtTLT = null;
        $txtArea = null;
        
        $opc = $_GET['opc'];//pega a opção selecionada no form
        
        if($opc == "1"){//verifica a opção selecionada
            $upload_dir="arquivos/";
        
            $nome_arq = basename($_FILES['btnImgImportancia']['name']);
            
            //verificando a extensão do arquivo
            if(strstr($nome_arq,'.jpg') || strstr($nome_arq,'.png') || strstr($nome_arq,'.gif'))
                {
                    $extensao = substr($nome_arq,strpos($nome_arq,"."),5);
                    $prefixo = substr($nome_arq,0,strpos($nome_arq,"."));
                    $nome_arq = md5($prefixo).$extensao;

                    $upload_file = $upload_dir . $nome_arq;

                    if (move_uploaded_file($_FILES['btnImgImportancia']['tmp_name'], $upload_file))
                    {
                        //script para atualizar a img no banco de dados
                        $sql = "UPDATE tbl_importancia set caminhoImgPrincipal ='".$upload_file."' where idImportancia = 1"; 
                        
                        mysqli_query(connectReturn(), $sql);//enviando para o banco de dados

                        header("location:cmsImportancia.php");
                        
                    }else{
                        echo("O arquivo não pode ser movido para o servidor");
                    }  

                }else{
                    ?>
                        <script>

                            alert("Extensão ou você não selecionou uma imagem.");

                            window.location='cmsImportancia.php';

                        </script>

                    <?php      
                } 
        }else {
            $txtTLT = $_POST['txtTLT'];
            $txtArea = $_POST['txtAreaTexto'];
            
            if($opc == "2"){//atualizando o titulo e o conteudo dependendo da opção
               $sql = "UPDATE tbl_importancia set tlt1 ='".$txtTLT."', txt1 = '".$txtArea."' where idImportancia = 1";  
            }else if($opc == "3"){
                $sql = "UPDATE tbl_importancia set tlt2 ='".$txtTLT."', txt2 = '".$txtArea."' where idImportancia = 1"; 
            }else if($opc == "4"){
                $sql = "UPDATE tbl_importancia set tlt3 ='".$txtTLT."', txt3 = '".$txtArea."' where idImportancia = 1"; 
            }
            
            mysqli_query(connectReturn(), $sql);

            header("location:cmsImportancia.php");
            
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Administração de Conteúdo</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="cssCMS/styleCMS.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script>
            
            $(document).ready(function() {

              $(".ver").click(function() {
                $(".modalContainer").fadeIn(0500);
                //slideToggle
                //toggle
                //FadeIn
              });
            });

            function Modal(){
                $.ajax({
                    type: "POST",
                    url: "modal.php"
                });
            }
            
            $(document).ready(function() {

              $(".fechar").click(function() {
                //$(".modalContainer").fadeOut();
                $(".modalContainer").fadeOut(0500);
              });
            });
	
            
        </script>
    </head>
    <body>
        <div class="modalContainer">
            <div class="modal">
                <a href = "#" class="fechar">
                    <div id = "btnFechar">
                        X
                    </div>
                 </a> 

                <div id="tltCmsUsuario">
                    Detalhes dos Usuários
                </div>

                <div id = "tltItensUsuarios">
                    <div class = "itensTLTUsuario">
                        Nome
                    </div>
                    <div class = "itensTLTUsuario">
                        login
                    </div>
                    <div class = "itensTLTUsuario">
                        Nível
                    </div>
                    <div class = "itensTLTUsuario">
                        OPC
                    </div>
                </div>


                <?php 

                    //SELECT para pegar itens de duas tabelas, e relacionalas
                    $sql = "SELECT * from tbl_importancia";

                    $select = mysqli_query(connectReturn(), $sql);

                    //while para listar itens
                    while($rsImportancia = mysqli_fetch_array($select)){

                ?>
                    <div class = "linhaItensUsuario">
                        <div class = "itensUsuario">
                            <?php  echo($rsImportancia["txt1"])?>
                        </div>
                        <div class = "itensUsuario">
                            <?php  echo($rsImportancia["txt2"])?>
                        </div>
                        <div class = "itensUsuario">
                            <?php  echo($rsImportancia["txt3"])?>
                        </div>
                        <div class = "itensUsuario">

                            <a href="cmsUsuarioAddUser.php?codigo=<?php echo($rsItensUsuarios['idUsuario']);?>">
                                <img src="Imagens/iconLook24.png" alt="">
                            </a>

                            <a href="cmsUsuario.php?modo=apagarUser&codigo=<?php echo($rsItensUsuarios['idUsuario']);?> " onload="Modal();">
                                <img src="Imagens/iconDel24.png" alt="">
                            </a>

                        </div>
                    </div>
                <?php
                    }
                ?>

            </div>
        </div>	
        <div id = "areaTotal">
            <header>
                <?php
                    require_once("cmsMenu.php");

                    menuCMS();
                ?>
              
            </header>
            
            <main>
                
                
                <div id = "tlt">
                    Importancia do suco natural
                </div>
                
                <form name="frmImportancia" method="post" action="cmsImportancia.php?opc=<?php echo($opc) ?>" enctype="multipart/form-data">
                    <div id="boxOpcs">

                        <select name="opcs">
                            <option value="1">Imagem Principal</option>
                            <option value="2">Titulo e Texto 1</option>
                            <option value="3">Titulo e Texto 2</option>
                            <option value="4">Titulo e Texto 3</option>
                        </select>

                        <input type="submit" value="ok" name="btnOk">
                    </div>
                    
                    <?php
                        $sql = "select * from tbl_importancia";
                    
                        $select = mysqli_query(connectReturn(), $sql);
                    
                        while($rsImportancia = mysqli_fetch_array($select)){
                            
                            if($opc == "1"){//if para preencher os campos dependendo da opção selecionada
                                ?>
                                    <div id = 'imgVeraoCMS'>
                                        <img src="<?php echo($rsImportancia['caminhoImgPrincipal']) ?>">;
                                    </div>
                                    <div id = 'btnSalvarImgVerao'>
                                        <input type="file" name="btnImgImportancia">
                                    </div>

                                <?php
                            }else if($opc == "2"){//preenche o texto e o titulo apartir do conteudo já existente no banco de dados
                                ?>
                                    <div class = "txtTlt" >
                                        <input type="text" name="txtTLT" value="<?php echo($rsImportancia['tlt1'])?>" class = 'txtTltPerson'>
                                    </div>
                    
                                    <div class="txt">
                                        <textarea name="txtAreaTexto" cols="40" rows="5" id="txtAreaVerao" placeholder="Digite o texto" maxlength="500"><?php echo($rsImportancia['txt1']); ?></textarea>
                                    </div>
                                <?php
                            }else if($opc == "3"){//preenche o texto e o titulo apartir do conteudo já existente no banco de dados
                                ?>
                                    <div class = "txtTlt" >
                                        <input type="text" name="txtTLT" value="<?php echo($rsImportancia['tlt2'])?>" class = 'txtTltPerson'>
                                    </div>
                    
                                    <div class="txt">
                                        <textarea name="txtAreaTexto" cols="40" rows="5" id="txtAreaVerao" placeholder="Digite o texto" maxlength="500"><?php echo($rsImportancia['txt2']); ?></textarea>
                                    </div>
                                <?php
                            }else if($opc == "4"){//preenche o texto e o titulo apartir do conteudo já existente no banco de dados
                                ?>
                                    <div class = "txtTlt" >
                                        <input type="text" name="txtTLT" value="<?php echo($rsImportancia['tlt3'])?>" class = 'txtTltPerson'>
                                    </div>
                    
                                    <div class="txt">
                                        <textarea name="txtAreaTexto" cols="40" rows="5" id="txtAreaVerao" placeholder="Digite o texto" maxlength="500"><?php echo($rsImportancia['txt3']); ?></textarea>
                                    </div>
                                <?php
                            }
                            
                        }
                    ?>
                    <div id = "btnSalvarVerao">
                        <input type="submit" name="btnEditarVerao" value="SALVAR">
                    </div>
                </form>
                
            </main>
            
            <footer>
                Desenvolvido por : <span>WilliamCorp</span>
            </footer>
        </div>
        
    </body>
</html>