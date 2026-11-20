<?php
//Carregamento dos arquivos físicos;
//O "require_once" garante que os arquivos de configuração e models sejam incluídos.
//O uso do "__DIR__" cerve para pegar o caminho absoluto da pasta atual do projeto.
require_once __DIR__ . "/config/Database.php";
require_once __DIR__ . "/models/Prato.php";
require_once __DIR__ . "/models/Bebida.php";
require_once __DIR__ . "/models/Sobremesa.php";
require_once __DIR__ . "/models/Marmita.php";

//Importação dos Namespaces;
// O "use" diz ao PHP quais "namespaces" (caminhos lógicos) nós vamos utilizar neste arquivo.
use RestauranteLegal\Config\Database;
use RestauranteLegal\Models\Prato;
use RestauranteLegal\Models\Bebida;
use RestauranteLegal\Models\Sobremesa;
use RestauranteLegal\Models\Marmita;

//Teste de conexão com o banco de dados;
//Cria um objeto (instância) da classe "Database" configurada para o banco.
$meuBancoDeDados = new Database(); 

//Chama o método "conectar()" para estabelecer a conexão via PDO.
$minhaConexao = $meuBancoDeDados->conectar(); 

//Verifica se o que retornou foi uma string (o que indica uma mensagem de erro).
if (is_string($minhaConexao)) {
    echo $minhaConexao; //Exibe o erro retornado pelo método "conectar()"
} else {
 echo "Conexão com o banco de dados estabelecida com sucesso! <br><br>";
}

//Criação e teste da classe Prato;
// Instancia um novo objeto "Prato" passando os dados de exemplo no construtor.
$meuPrato = new Prato(1, "Feijoada", "Prato tradicional brasileiro", 45.99); 

//Chama o método que formata os dados do prato em HTML e exibe na tela.
echo $meuPrato->getPratoHTML(); 

//Adiciona uma quebra de linha para separar visualmente do próximo item.
echo "<br><br>";

//Criação e teste da classe Bebida;
//Instancia um novo objeto "Bebida" passando ID, nome, volume, indicador alcoólico e preço.
$minhaBebida = new Bebida(1, "Coca-Cola Lata", 350, 0, 6.50);

//Chama o método que formata os dados da bebida em HTML e exibe na tela.
echo $minhaBebida->getBebidaHTML();

echo "<br><br>";

//Criação e teste da classe Sobremesa;
//Instancia um novo objeto "Sobremesa" passando ID, nome, descrição e preço.
$minhaSobremesa = new Sobremesa(1, "Pudim de Leite Condensado", "Tradicional pudim cremoso com calda de caramelo artesanal", 14.90);

//Chama o método que formata os dados da sobremesa em HTML e exibe na tela.
echo $minhaSobremesa->getSobremesaHTML();

echo "<br><br>";

echo "======Segundo Pedido======<br><br>";
try {
$meuSegundoPrato = new Prato(2, "Lasanha", "Delisiosa lasanha de carne",55.90);
echo $meuSegundoPrato->getPratoHTML();
} catch (\Throwable $th) {
    echo $th->getMessage();
}

echo"<br><br>";

try {
    $minhaSegundaBebida = new Bebida(2, "Suco Natural de Laranja", 500, 0, 9.90);
    echo $minhaSegundaBebida->getBebidaHTML();
} catch (\Throwable $th) {
    echo $th->getMessage();
}

echo "<br><br>";

try {
    $minhaSegundaSobremesa = new Sobremesa(2, "Mousse de Maracujá", "Mousse leve e aerado com cobertura de calda de maracujá fresca", 12.00);
    echo $minhaSegundaSobremesa->getSobremesaHTML();
} catch (\Throwable $th) {
    echo $th->getMessage();
}

echo "<br><br>";
echo "======TESTE MARMITA======<br><br>";

//O bloco "try" tenta executar a criação da marmita e a aplicação do desconto.
//Caso algum setter ou o método "aplicarDesconto()" lance uma Exception (erro de regra de negócio), a execução pula direto para o "catch" sem travar o restante da página.
try {
    $minhaMarmita = new Marmita(1, "Frango Grelhado com Arroz, Feijão e Fritas", 23.90, "2026-11-25");
    echo $minhaMarmita->getMarmitaHTML(); //Exibe na tela os dados iniciais da marmita formatados em HTML (incluindo o preço original).

    //Chama o método "aplicarDesconto()" passando 15 (que representa 15%).
    //Basicamente, ele calcula os 15% sobre o preço atual e subtrai desse valor, atualizando o atributo "$precoMarmita".
    $minhaMarmita->aplicarDesconto(15);
    echo "Preço após 15% de desconto: " . $minhaMarmita->getPrecoFormatado() . "<br><br>"; //Exibe o novo preço já atualizado com o desconto, obviamente formatado em reais (R$).
} catch (\Throwable $th) {
    echo "Erro ao criar/aplicar desconto na marmita: " . $th->getMessage() . "<br><br>"; //Captura qualquer exceção ou erro lançado durante a criação ou aplicação do desconto e exibe uma mensagem amigável com o motivo do erro.
}

try {
    $marmitaDescontoInvalido = new Marmita(2, "Strogonoff de Frango com Arroz e Batata Palha", 24.90, "2026-11-26"); //Cria a segunda marmita válida

    echo $marmitaDescontoInvalido->getMarmitaHTML(); //Exibe os dados da segunda marmita antes de testar o desconto inválido

    //Tenta aplicar 120% de desconto (fora do intervalo permitido de 0% a 100%), o que vai disparar a exceção e cair no bloco catch logo abaixo.
    $marmitaDescontoInvalido->aplicarDesconto(120);
} catch (\Throwable $th) {
    echo "Validação de desconto funcionando! Exceção capturada: " . $th->getMessage() . "<br><br>";
}

//Teste de validação do desconto fora do intervalo (0% a 100%)
try {
    $marmitaDescontoInvalido = new Marmita(2, "Bife Acebolado com Purê de Batata e Salada", 25.50, "2026-11-24"); //Cria uma segunda marmita válida para testar uma regra específica do método "aplicarDesconto()".
    $marmitaDescontoInvalido->aplicarDesconto(120); //Tenta aplicar 120% de desconto (fora do intervalo permitido de 0% a 100%). Como esse valor é inválido, o método deve lançar uma "Exception" e interromper esta linha.
} catch (\Throwable $th) {
    echo "Validação de desconto funcionando! Exceção capturada: " . $th->getMessage() . "<br><br>"; //Se tudo der certo (que é o esperado 🙌🙌), o código cai aqui e exibe a mensagem da exceção lançada pela classe "Marmita" (lembrando que o valor do desconto deve estar entre 0% e 100%).
}
?>