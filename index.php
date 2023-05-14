<?php 
    include_once("conexao.php"); //adiciona a conexao (conexao.php) dentro da tag php local
    session_start();

    $texto = $_POST['texto']; //variável $texto recebe o valor digitado no campo texto através do metodo post

    if(isset($_POST['salvar'])){ //verifica se a variável foi definida. Se verdadeiro, continua
        if($texto != NULL){ //caso a variável texto não for nula, permite a inserção de dados
            $criaTexto = "INSERT INTO cadastro (texto, data_criacao) VALUES('$texto', NOW())";   //query para inserção de registros na tabela
            $criaTextoQ = mysqli_query($conn, $criaTexto);
        }
    }

    if (isset($_POST['deletar']) && isset($_POST['checkbox'])) { //verifica se as variáveis foram definidas. Se verdadeiro, continua
        $selecionado = $_POST['checkbox'];
        foreach($selecionado as $id){   //para cada checkbox, executa a query abaixo
            mysqli_query($conn, "DELETE FROM cadastro WHERE id_cadastro=".$id);  //query para exclusão de dados na tabela
            //echo "deletado";
        }
    }

    if(isset($_POST['limpar'])){ //verifica se a variável foi definida. Se verdadeiro, continua
        $limpa = "DELETE FROM cadastro";  //query para deletar todos os registros da tabela
        $limpaQ = mysqli_query($conn, $limpa); 
        $resetaId = " ALTER TABLE cadastro AUTO_INCREMENT = 1"; //query para reiniciar a contagem do campo ID
        $resetaIdq = mysqli_query($conn, $resetaId); 
    }
    
    $consulta = "SELECT * FROM cadastro ORDER BY id_cadastro DESC"; //query para consultar todos os registros da tabela cadastro
    $consultaQ = mysqli_query($conn, $consulta); 
    
    print_r($consultaQ); //verificar funcionamento da query

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Cadastro de Texto</title>
</head>
<body>
    <div class="titulo">
        <h1 id="nome">Apresentação de Conhecimentos</h1>
        <h1 id="autor">William Cellegin</h1>
    </div>
    <div class="container1"></div>    
        <div class="container2">    
            <div class="formulario">
                <form method="post" action="index.php">
                    <input type="text" id="texto" name="texto" placeholder="Digite um Texto">
                        <input type="submit" id="salvar" name="salvar" value="Salvar">
                        <input type="submit" id="deletar" name="deletar" value="Deletar">
                        <input type="submit" id="limpar" name="limpar" value="Limpar">
                </div>
            <div class="resultado">
                    <div>
                        <table class = "tabela">
                            <thead>
                                <tr>
                                    <th id="thCheckbox" scope="col"> </th>
                                    <th id="thId" scope="col">ID</th>
                                    <th id="thTexto" scope="col">Texto</th>
                                    <th id="thData" scope="col">Data de Cadastro</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    while($user_data = mysqli_fetch_assoc($consultaQ)) //variavel $user_data recebe os dados | fetch_assoc cria uma matriz associativa | enquanto a iteração for verdadeira criam-se linhas com os respectivos campos na tabela
                                        {
                                        //foreach($consultaQ as $user_data){
                                            echo "<tr>";
                                            echo "<td><input type='checkbox' id='checkbox' name='checkbox[]' value ='".$user_data['id_cadastro']."'></td>";
                                            echo "<td>".$user_data['id_cadastro']."</td>";
                                            echo "<td>".$user_data['texto']."</td>";
                                            echo "<td>".$user_data['data_criacao']."</td>";
                                            echo "</tr>";
                                        //}
                                        }
                                ?>
                                </form>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div> 
</body>
</html>


