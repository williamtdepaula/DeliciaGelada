<?php
    
    require_once("modulo/modulo.php");

    conexaoBanco();

    $opc = null;

    if(isset($_POST['btnOk'])){//pega a opção selecionada
        $opc = $_POST["opcs"];
    }

    if(isset($_POST['btnSalvarVerao'])){//verificando se apertou no botão
        $opc = $_GET['opc'];//pega a opção selecionada no form
        
        if($opc == "3" || $opc == "4"){//pega o conteúdo escrito na TEXTAREA 
           $txt = $_POST['txtAreaTexto']; 
        }
        
        
        if($opc == "1" || $opc == "2"){
            $upload_dir="arquivos/";
        
            $nome_arq = basename($_FILES['btnNovoLocal']['name']);

            if($nome_arq == ''){
                
            }else{
               if(strstr($nome_arq,'.jpg') || strstr($nome_arq,'.png') || strstr($nome_arq,'.gif'))
                {
                    $extensao = substr($nome_arq,strpos($nome_arq,"."),5);
                    $prefixo = substr($nome_arq,0,strpos($nome_arq,"."));
                    $nome_arq = md5($prefixo).$extensao;

                    $upload_file = $upload_dir . $nome_arq;

                    if (move_uploaded_file($_FILES['btnNovoLocal']['tmp_name'], $upload_file))
                    {
                        if($opc == "1"){ //atualizando dependendo da opc escolhida
                           $sql = "UPDATE tbl_verao set caminhoImg1 ='".$upload_file."' where idVerao = 1";
                        }else if($opc == "2"){
                            $sql = "UPDATE tbl_verao set caminhoImg2 ='".$upload_file."' where idVerao = 1"; 
                        }
                        

                        mysqli_query(connectReturn(), $sql);

                        header("location:cmsVerao.php");
                        
                    }else{
                        echo("O arquivo não pode ser movido para o servidor");
                    }  

                }else{
                    ?>
                        <script>

                            alert("Extensão ou você não selecionou uma imagem.");

                            window.location='cmsVerao.php';

                        </script>

                    <?php      
                } 
            }
        }else if($opc == "3" || $opc == "4"){
            if($opc == "3"){ //atualizando dependendo da opc escolhida
                $sql = "UPDATE tbl_verao set txt1 ='".$txt."' where idVerao = 1"; 
            }else if ($opc == "4"){
                $sql = "UPDATE tbl_verao set txt2 ='".$txt."' where idVerao = 1"; 
            }
            
            mysqli_query(connectReturn(), $sql);

            header("location:cmsVerao.php");
        }
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
                    Configure o Verão
                </div>
                <form name='frmEditarVerao' method="post" action="cmsVerao.php?opc=<?php echo($opc) ?>" enctype="multipart/form-data">
                    <div id="boxOpcs">

                            <select name="opcs">
                                <option value="1">Imagem 1</option>
                                <option value="2">Imagem 2</option>
                                <option value="3">Texto 1</option>
                                <option value="4">Texto 2</option>
                            </select>

                            <input type="submit" value="ok" name="btnOk">
                    </div>
                
                
                    <?php
                        if($opc == '1' || $opc == '2'){
                            $caminhoImg = null;
                            if($opc == '1'){
                                $sql = "select caminhoImg1 from tbl_verao;";
                                
                                $select = mysqli_query(connectReturn(), $sql);
                                
                                if($rsCaminhoImg = mysqli_fetch_array($select)){
                                    $caminhoImg = $rsCaminhoImg['caminhoImg1'];
                                }
                            }else{
                                $sql = "select caminhoImg2 from tbl_verao;";
                                
                                $select = mysqli_query(connectReturn(), $sql);
                                
                                if($rsCaminhoImg = mysqli_fetch_array($select)){
                                    $caminhoImg = $rsCaminhoImg['caminhoImg2'];
                                }
                            }
                    ?>
                        <div id = 'imgVeraoCMS'>
                            <img src="<?php echo($caminhoImg) ?>">;
                        </div>
                        <div id = 'btnSalvarImgVerao'>
                            <input type="file" name="btnNovoLocal">
                        </div>
                    <?php
                        }else if($opc == "3" || $opc == "4"){
                            $txt = null;
                            if($opc == '3'){
                                $sql = "select txt1 from tbl_verao;";
                                
                                $select = mysqli_query(connectReturn(), $sql);
                                
                                if($rsTxtVerao = mysqli_fetch_array($select)){
                                    $txt = $rsTxtVerao['txt1'];
                                }
                            }else{
                                $sql = "select txt2 from tbl_verao;";
                                
                                $select = mysqli_query(connectReturn(), $sql);
                                
                                if($rsTxtVerao = mysqli_fetch_array($select)){
                                    $txt = $rsTxtVerao['txt2'];
                                }
                            }
                    ?>

                        <div class="txt">
                            <textarea name="txtAreaTexto" cols="40" rows="5" id="txtAreaVerao" placeholder="Digite o texto" maxlength="500"><?php echo($txt); ?></textarea>
                        </div>

                    <?php
                        }
                    ?>
                    <div id = "btnSalvarVerao">
                        <input type="submit" name="btnSalvarVerao" value="SALVAR">
                    </div>
                </form>    
                    
            </main>
            
            <footer>
                Desenvolvido por : <span>WilliamCorp</span>
            </footer>
        </div>
        
    </body>
</html>