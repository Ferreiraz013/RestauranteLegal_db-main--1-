<?php
namespace RestauranteLegal\Models;

use Exception;

class Bebida { // Propriedades da classe Bebida
    private int $idBebida;
    private string $nomeBebida;
    private int $volume;
    private int $alcoolico;
    private float $preco;
    private string $tabela = "bebidas"; // Nome da tabela no banco de dados

    public function __construct(int $idBebida, string $nomeBebida, int $volume, int $alcoolico, float $preco) {
        //$this->idBebida = $idBebida;
        $this->setIdBebida($idBebida);
        //$this->nomeBebida = $nomeBebida;
        $this->setNomeBebida($nomeBebida);
        //$this->volume = $volume;
        $this->setVolume($volume);
        //$this->alcoolico = $alcoolico;
        $this->setAlcoolico($alcoolico);
        //$this->preco = $preco;
        $this->setPreco($preco);
    }

    //Setters
    public function setIdBebida(int $idBebida): void {
        $this->idBebida = $idBebida;
    }

    public function setNomeBebida(string $nomeBebida): void {
        //Não pode ser vazia, então vamos validar antes de atribuir o valor à propriedade.
        //Ao menos 3 caractere deve ser fornecido para o nome da bebida.
        if ($nomeBebida == ""){
            throw new Exception("O nome da bebida não pode ser vazio. Por favor, forneça um nome válido.");
        } else if (strlen($nomeBebida) < 3) {
            throw new Exception("O nome da bebida deve ter pelo menos 3 caracteres. Por favor, forneça um nome mais longo.");
        }
        $this->nomeBebida = $nomeBebida;
    }

    public function setVolume(int $volume): void {
        //O volume da bebida deve ser um valor maior do que 200
        if ($volume <= 200) {
            throw new Exception("O volume da bebida deve ser maior do que 200 ml.");
        }
        $this->volume = $volume;
    }

    public function setAlcoolico(int $alcoolico): void {
        //O valor de alcoólico deve ser apenas 1 ou 0
        if ($alcoolico !== 1 && $alcoolico !== 0) {
            throw new Exception("O valor de alcoólico deve ser 1 (sim) ou 0 (não). Por favor, forneça um valor válido.");
        }
        $this->alcoolico = $alcoolico;
    }

    public function setPreco(float $preco): void {
        //Não pode ser negativo, nem zero, então vamos validar antes de atribuir o valor à propriedade.
        //Ao menos 3 caractere deve ser fornecido para o nome da bebida.
        //O valor de preço deve ser maior do que zero
        // if ($preco <= 0) {
        //     throw new Exception("O valor de preço deve ser maior que zero. Por favor, forneça um valor válido.");
        // }
        $this->preco = $preco;
    }

    //Getters
    public function getIdBebida(): int {
        return $this->idBebida;
    }

    public function getNomeBebida(): string {
        return $this->nomeBebida;
    }

    public function getVolume(): int {
        return $this->volume;
    }

    public function getAlcoolico(): bool {
        return $this->alcoolico;
    }

    public function getPrecoFormatado(): string {
        return "R$ " . number_format($this->preco, 2);
    }

    public function getBebidaHTML(): string {
        $statusAlcoolico = $this->alcoolico ? "Sim" : "Não";
        return "======BEBIDA CRIADA COM SUCESSO====== <br>
                id: " . $this->getIdBebida() . " <br>
                Nome da Bebida: " . $this->getNomeBebida() . " <br>
                Volume: " . $this->getVolume() . " ML <br>
                Alcoólico: " . $statusAlcoolico . " <br>
                Preço: " . $this->getPrecoFormatado() . " <br><br>";
    }
}