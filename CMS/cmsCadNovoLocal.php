<?php
    
    require_once("modulo/modulo.php");

    conexaoBanco();

    $aparecer = 0;

    if(isset($_POST['btnSalvar'])){
        $txtLocal = $_POST['txtLocal'];
        $txtTelefone = $_POST['txtTel'];
        $slcCidade = $_POST['slcCidade'];
        $slcEstado = $_POST['slcEstado'];
        
        $upload_dir="arquivos/";
        
        $nome_arq = basename($_FILES['btnNovoLocal']['name']);
        
        if(strstr($nome_arq,'.jpg') || strstr($nome_arq,'.png') || strstr($nome_arq,'.gif'))
        {
            $extensao = substr($nome_arq,strpos($nome_arq,"."),5);
            $prefixo = substr($nome_arq,0,strpos($nome_arq,"."));
            $nome_arq = md5($prefixo).$extensao;
            
            $upload_file = $upload_dir . $nome_arq;
            
            if (move_uploaded_file($_FILES['btnNovoLocal']['tmp_name'], $upload_file))
            {
                
                $sql = "INSERT INTO tbl_localidade (logradouro, telefone, caminhoImagem, aparecer, idCidade, idEstado) VALUES('".$txtLocal."', '".$txtTelefone."', '".$upload_file."', '".$aparecer."', '".$slcCidade."', '".$slcEstado."');";
                
                mysqli_query(connectReturn(), $sql);
        
                header("location:cmsCadNovoLocal.php");
                
            }else{
                echo("O arquivo não pode ser movido para o servidor");
            }
            
        }else{
            ?>
                <script>

                    alert("Extensão ou você não selecionou uma imagem.");

                    window.location='cmsCadNovoLocal.php';

                </script>
                                    
            <?php            
        }
            
    }

    if(isset($_POST['btnEditar'])){
        $txtLocal = $_POST['txtLocal'];
        $txtTelefone = $_POST['txtTel'];
        $slcCidade = $_POST['slcCidade'];
        $slcEstado = $_POST['slcEstado'];
        
        
        $upload_dir="arquivos/";
        
        $nome_arq = basename($_FILES['btnNovoLocal']['name']);
        
        if($nome_arq == ''){
            
                $sql = "UPDATE tbl_localidade set logradouro = '".$txtLocal."', telefone = '".$txtTelefone."', aparecer = 1, idCidade =".$slcCidade.", idEstado =".$slcEstado." where idLocalidade =".$_GET['idDoLocalEdit'].";";
                
                echo($sql);
                mysqli_query(connectReturn(), $sql);
        
                header("location:cmsCadNovoLocal.php");
        }else{
           if(strstr($nome_arq,'.jpg') || strstr($nome_arq,'.png') || strstr($nome_arq,'.gif'))
            {
                $extensao = substr($nome_arq,strpos($nome_arq,"."),5);
                $prefixo = substr($nome_arq,0,strpos($nome_arq,"."));
                $nome_arq = md5($prefixo).$extensao;

                $upload_file = $upload_dir . $nome_arq;

                if (move_uploaded_file($_FILES['btnNovoLocal']['tmp_name'], $upload_file))
                {

                    $sql = "UPDATE tbl_localidade set logradouro = '".$txtLocal."', telefone = '".$txtTelefone."', caminhoImagem='".$upload_file."', aparecer = 1, idCidade =".$slcCidade.", idEstado =".$slcEstado." where idLocalidade =".$_GET['idDoLocalEdit'].";";

                    echo($sql);
                    mysqli_query(connectReturn(), $sql);

                    header("location:cmsCadNovoLocal.php");
                }else{
                    echo("O arquivo não pode ser movido para o servidor");
                }  

            }else{
                ?>
                    <script>

                        alert("Extensão ou você não selecionou uma imagem.");

                        window.location='cmsCadNovoLocal.php';

                    </script>

                <?php      
            } 
        }
    }

    if(isset($_POST['btnExcluir'])){
        $sql = "delete from tbl_localidade where idLocalidade = ".$_GET['idDoLocalEdit'].";";
        
        mysqli_query(connectReturn(), $sql);
        
        ?>
            <script>

                alert("Local apagado.");

                window.location='cmsCadNovoLocal.php';

            </script>

        <?php 
    }

    if(isset($_POST['btnSalvarAparecer'])){
        
        $sql = "UPDATE tbl_localidade SET aparecer = 0;";
        
        mysqli_query(connectReturn(), $sql);
        foreach($_POST['marcar'] as $item){//repetindo itens do array da variavel marcar que é as checkboxs
            
            //script para marcalos para aparecer na tela da home
            $sql = "UPDATE tbl_localidade SET aparecer = 1 WHERE idLocalidade =".$item.";";
            
            mysqli_query(connectReturn(), $sql);
        }
        
       header("location:cmsCadNovoLocal.php");
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
                id('txtTel').onkeypress = function(){
                    mascara( this, mtel );
                }
                
                id('txtTel').onkeypress = function(){
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
        <div id = "areaTotal">
            <header>
                <?php
                    require_once("cmsMenu.php");

                    menuCMS();
                ?>
              
            </header>
            
            <main id="mainNovoLocal">
                <div id="tlt">
                    Localidade
                </div>
                
                <div id = "opcUsuarioCad">
                    <a href='cmsCadNovoLocal.php?modo=novo'>
                        <img src="Imagens/icon_add24.png" alt="">
                    </a>
                    
                </div>
                    
                <div id = "areaTltsLocal">
                    <div class = "tltDestaque">
                        Logradouro
                    </div>
                    <div class = "tltDestaque">
                        Telefone
                    </div>
                    <div class = "tltDestaque">
                        Opcs
                    </div>
                </div>

                <form name="frmProdutosHome" method="post" action="cmsCadNovoLocal.php">
                    <?php
                        $sql = "SELECT * FROM tbl_localidade;";

                        $select = mysqli_query(connectReturn(), $sql);

                        while($rsLocalidade = mysqli_fetch_array($select)){
                    ?>

                            <div class="linhaLocalRepetir">
                                <div class = "itensProdutoDestaque">
                                    <?php echo($rsLocalidade['logradouro']) ?>
                                </div>
                                <div class = "itensProdutoDestaque">
                                    <?php echo($rsLocalidade['telefone']) ?>
                                </div>
                                <div class = "itensProdutoDestaque">
                                    <?php 
                                        if($rsLocalidade['aparecer'] == 0){
                                    ?>
                                            <div class = "boxOpcSexo">
                                                <input type="checkbox" name="marcar[]" value="<?php echo($rsLocalidade['idLocalidade']) ?>">
                                                
                                                <?php
                                                
                                                    echo "<a href='cmsCadNovoLocal.php?modo=apagar&id=".$rsLocalidade['idLocalidade']."''>
                                           
                                                    <div id='txtPerso'>Apagar</div>

                                                    </a>";
                                                ?>
                                            </div>

                                    <?php
                                        }else{
                                    ?>
                                            <div class = "boxOpcSexo">
                                                <input type="checkbox" name="marcar[]" value="<?php echo($rsLocalidade['idLocalidade']) ?>" checked>
                                                
                                                <?php
                                                
                                                    echo "<a href='cmsCadNovoLocal.php?modo=editar&id=".$rsLocalidade['idLocalidade']."''>
                                           
                                                    <div id='txtPerso'>Editar</div>

                                                    </a>";
                                                ?>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                    
                    <div class="areaBtn">
                        <input type="submit" name="btnSalvarAparecer" value="Salvar">
                    </div>
                </form>
                
                <?php
                
                    if(isset($_GET['modo'])){
                            
                    
                            if($_GET['modo'] == 'editar'){
                                $id = $_GET['id'];
                            
                                $sql = "select * from tbl_localidade WHERE idLocalidade=".$id.";";

                                $select = mysqli_query(connectReturn(), $sql);

                                if($rsLocalidade = mysqli_fetch_array($select)){


                            ?>

                                <form name="frmCadNovoLocal" method="post" action="cmsCadNovoLocal.php?idDoLocalEdit=<?php echo($_GET['id']) ?>" enctype="multipart/form-data">

                                    <div id = "roubaespca"></div>

                                    <div id = "btnSubmitNewLocal">
                                        <input type="file" name="btnNovoLocal">
                                    </div>

                                    <div class = "tltPerguntaLocal">
                                        Logradouro:
                                    </div>

                                    <div class = "txtPerguntaLocal">
                                        <input type="text" name="txtLocal" placeholder="Rua, beco, local" required maxlength="40" value="<?php echo($rsLocalidade['logradouro']) ?>">
                                    </div>

                                    <div class = "tltPerguntaLocal">
                                        Telefone:
                                    </div>

                                    <div class = "txtPerguntaLocal">
                                        <input type="text" name="txtTel" placeholder="ex: (XX) XXXX-XXXX" required onkeypress="return validarCel_eTel(event)" id = "txtTel" maxlength="14" value="<?php echo($rsLocalidade['telefone']) ?>">
                                    </div>

                                    <div class = "tltPerguntaLocal">
                                        Cidade:
                                    </div>

                                    <div class = "txtPerguntaLocal">

                                        <select name="slcCidade"> 
                                            <option value="<?php echo $rsLocalidade['idCidade'];?>">
                                                <?php

                                                    $sqlCityNome = "select * from tbl_cidade where idCidade=".$rsLocalidade['idCidade'];
                                                    $select = mysqli_query(connectReturn(), $sqlCityNome);
                                                    if($rsNomeCidade = mysqli_fetch_array($select)){
                                                       echo ($rsNomeCidade['cidade']); 
                                                    }
                                                ?>

                                            </option>

                                            <?php 
                                                $sql1 = "SELECT * FROM tbl_cidade where idCidade !=".$rsLocalidade['idCidade'];

                                                echo($sql1);

                                                $select1 = mysqli_query(connectReturn(), $sql1);

                                                while($rsCidade = mysqli_fetch_array($select1)){

                                            ?>
                                            <option value="<?php echo $rsCidade['idCidade'];?>">
                                                <?php echo $rsCidade['cidade'];?>
                                            </option>

                                            <?php
                                                }
                                            ?>

                                        </select>
                                    </div>

                                    <div class = "tltPerguntaLocal">
                                        Estado:
                                    </div>

                                    <div class = "txtPerguntaLocal">


                                        <select name="slcEstado"> 
                                             <option value="<?php echo $rsLocalidade['idCidade'];?>">
                                                <?php

                                                    $sqlStateNome = "select * from tbl_estado where idEstado=".$rsLocalidade['idEstado'];
                                                    $selectState = mysqli_query(connectReturn(), $sqlStateNome);
                                                    if($rsNomeEstado = mysqli_fetch_array($selectState)){
                                                       echo ($rsNomeEstado['sigla']); 
                                                    }
                                                ?>

                                            </option>

                                            <?php 
                                                $sql = "SELECT * FROM tbl_estado where idEstado!=".$rsLocalidade['idEstado'];

                                                $select = mysqli_query(connectReturn(), $sql);

                                                while($rsEstado = mysqli_fetch_array($select)){

                                            ?>
                                            <option value="<?php echo $rsEstado['idEstado'];?>">
                                                <?php echo $rsEstado['sigla'];?>
                                            </option>

                                            <?php
                                                }
                                            ?>

                                        </select>
                                    </div>

                                    <div id = "btnSubmitNewLocal">
                                        <input name="btnEditar" value="EDITAR" type="submit">
                                        <input name="btnExcluir" value='APAGAR' type="submit">
                                    </div>
                                </form>        
                        <?php
                            }
                                
                        }else if($_GET['modo'] == 'novo'){
                                ?>
                                
                                
                                <form name="frmCadNovoLocal" method="post" action="cmsCadNovoLocal.php" enctype="multipart/form-data">

                                    <div id = "roubaespca"></div>

                                    <div id = "btnSubmitNewLocal">
                                        <input type="file" name="btnNovoLocal">
                                    </div>

                                    <div class = "tltPerguntaLocal">
                                        Logradouro:
                                    </div>

                                    <div class = "txtPerguntaLocal">
                                        <input type="text" name="txtLocal" placeholder="Rua, beco, local" required maxlength="40">
                                    </div>

                                    <div class = "tltPerguntaLocal">
                                        Telefone:
                                    </div>

                                    <div class = "txtPerguntaLocal">
                                        <input type="text" name="txtTel" placeholder="ex: (XX) XXXX-XXXX" required onkeypress="return validarCel_eTel(event)" id = "txtTel" maxlength="14">
                                    </div>

                                    <div class = "tltPerguntaLocal">
                                        Cidade:
                                    </div>

                                    <div class = "txtPerguntaLocal">

                                        <select name="slcCidade"> 
                                            <?php 
                                                $sql = "SELECT * FROM tbl_cidade";

                                                $select = mysqli_query(connectReturn(), $sql);

                                                while($rsCidade = mysqli_fetch_array($select)){

                                            ?>
                                            <option value="<?php echo $rsCidade['idCidade'];?>">
                                                <?php echo $rsCidade['cidade'];?>
                                            </option>

                                            <?php
                                                }
                                            ?>

                                        </select>
                                    </div>

                                    <div class = "tltPerguntaLocal">
                                        Estado:
                                    </div>

                                    <div class = "txtPerguntaLocal">

                                        <select name="slcEstado"> 
                                            <?php 
                                                $sql = "SELECT * FROM tbl_estado";

                                                $select = mysqli_query(connectReturn(), $sql);

                                                while($rsEstado = mysqli_fetch_array($select)){

                                            ?>
                                            <option value="<?php echo $rsEstado['idEstado'];?>">
                                                <?php echo $rsEstado['sigla'];?>
                                            </option>

                                            <?php
                                                }
                                            ?>

                                        </select>
                                    </div>

                                    <div id = "btnSubmitNewLocal">
                                        <input name="btnSalvar" value="ADICIONAR" type="submit">
                                    </div>
                                </form>  
                                <?php
                                
                            }else{
                                $id = $_GET['id'];
                                $sql = "delete from tbl_localidade where idLocalidade = ".$id.";";
                                
        
                                mysqli_query(connectReturn(), $sql);
                                
                                ?>
                                    <script>
                        
                                        alert("Local apagado.");
                                        
                                        window.location='cmsCadNovoLocal.php';
                                        
                                    </script>
                                    
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