<?php
session_start();

$dbHost     = 'localhost';
$dbUname = 'root';
$dbPass = '';
$dbName     = 'kairos';

$conec=new mysqli($dbHost,$dbUname,$dbPass,$dbName,"3306");

if($conec->connect_error){ // se não for localhost, usa a conexão do banco no site
    $dbHost = 'sql309.epizy.com';
    $dbUname = 'epiz_31926454';
    $dbPass = 'VOjqZcbwH38iVo';
    $dbName = 'epiz_31926454_Banco_Kairos';
    $conec=new mysqli($dbHost,$dbUname,$dbPass,$dbName,"3306");
}

$local='../../cadastro_empresa';
$cnpj=$_POST['cnpj'];

$select=mysqli_query($conec, "SELECT cnpj FROM empresa WHERE cnpj = '$cnpj'")->fetch_assoc();

if(isset($select['cnpj'])){ //cnpj já usado
    $local=$local.'?'.md5('cnpj=false');
    header("Refresh:0; url="."$local");
    exit;
}

$email=$_SESSION['email_padrao'];
$nome_empresa=$_POST['nome_empresa'];
$nome_fantasia=$_POST['nome_fantasia'];
$ramo=$_POST['ramo'];
$cep_empresa=$_POST['cep_empresa'];
$rua_empresa=$_POST['rua_empresa'];
$numero_empresa=$_POST['numero_empresa'];
$bairro_empresa=$_POST['bairro_empresa'];
$cidade_empresa=$_POST['cidade_empresa'];
$estado_empresa=$_POST['estado_empresa'];

$result = mysqli_multi_query($conec,"INSERT INTO empresa(email_usuario,nome,nome_fantasia,cnpj,ramo) VALUES((SELECT email FROM usuario WHERE email = '$email'),'$nome_empresa','$nome_fantasia','$cnpj','$ramo'); INSERT INTO endereco_empresa(cnpj_empresa,cep,rua,numero,bairro,cidade,estado) VALUES((SELECT cnpj FROM empresa WHERE cnpj = '$cnpj'),'$cep_empresa','$rua_empresa','$numero_empresa','$bairro_empresa','$cidade_empresa','$estado_empresa')");

if($result){ // insert feito
    header('Location: ../../../Perfil/PerfilEmpresa/empresa?'.md5('cadastro=true'));
    exit;
}

// insert não feito
header('Location: ../../../Login/login?'.md5('sucesso=false'));
exit;
?>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.12.0/js/md5.min.js'></script>