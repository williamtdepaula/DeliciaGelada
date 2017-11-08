<?php

    function conexaoBanco(){

        $conexao = mysqli_connect('localhost', 'root', 'bcd127', 'dbdeliciagelada');
    }

    function connectReturn(){
        $conexao = mysqli_connect('localhost', 'root', 'bcd127', 'dbdeliciagelada');
        
        return $conexao;
    }
    

?>