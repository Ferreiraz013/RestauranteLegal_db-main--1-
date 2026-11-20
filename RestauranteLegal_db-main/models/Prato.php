<?php
namespace RestauranteLegal\Models;

use Exception;

class Prato { // Propriedades da classe Prato
    private int $idPrato;
    private string $nomePrato;
    private string $descricao;
    private float $preco;
    private string $tabela = "pratos"; // Nome da tabela no banco de dados

    public function __construct(int $id, string $nomePrato, string $descricao, float $preco) {
        //$this->idPrato = $id;
        $this->setIdPrato($id);
        //$this->nomePrato = $nomePrato;
        $this->setNomePrato($nomePrato);
        //$this->descricao = $descricao;
        $this->setDescricao($descricao);
        //$this->preco = $preco;
        $this->setPreco($preco);
    }

    //Setters
    public function setIdPrato(int $pId): void {
        $this->idPrato = $pId;
    }

    public function setNomePrato(string $pNomePrato): void {
        //Não pode ser vazia, então vamos validar antes de atribuir o valor à propriedade.
        //Ao menos 3 caractere deve ser fornecido para o nome do prato.
        if ($pNomePrato == ""){
            throw new Exception("O nome do prato não pode ser vazio. Por favor, forneça um nome válido.");
        } else if (strlen($pNomePrato)<3) {
            throw new Exception("O nome do prato deve ter no máximo 3 caracteres. Por favor, forneça um nome mais curto.");
        }

        $this->nomePrato = $pNomePrato;
    }

    public function setDescricao(string $pDescricao): void
    {
        $this->descricao = $pDescricao;
    }

    public function setPreco(float $pPreco): void {
        //Não pode ser negativo, nem zero, então vamos validar antes de atribuir o valor à propriedade.
        if ($pPreco <=0) {
            throw new Exception("O valor de preço deve ser maior que zero. Por favor, forneça um valor válido.");
        }
        $this->preco = $pPreco;
    }

    //Getters
    public function getNomePrato(): string {
        return $this->nomePrato;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }

    public function getPrecoFormatado(): string {
        return "R$" . number_format($this->preco,2);
    }
    public function getIdPrato(): string {
        return $this->idPrato;
    }
    public function getPratoHTML() : string {
        return "======PRATO CRIADO COM SUCESSO====== <br>
        id: " . $this->getIdPrato() . "<br>
        Nome do Prato: " . $this->getNomePrato() . "<br>
        Descrição: " . $this->getDescricao() . "<br>
        Preço: " . $this->getPrecoFormatado(); 
}

}
