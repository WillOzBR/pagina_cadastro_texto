<?php 

$hostname = "localhost"; //nome do host
$database = "cadastro_texto"; //nome do banco de dados
$user = "root"; //usuario
$password = ""; //senha

$conn = new mysqli($hostname, $user, $password, $database); //instanciando um objeto mysqli para utilização da extensão | p/ procedural usa-se mysqli_connect

if($conn->connect_errno) //tratamento de erro
{
    echo "<div class='conexaoOff'> Falha ao conectar! Output:(" . $conn->connect_errno . ") </div>" . $conn->connect_errno;
}else{
    echo "<div class='conexaoOn'>Conexão Efetuada com Sucesso!</div>";
}

?>