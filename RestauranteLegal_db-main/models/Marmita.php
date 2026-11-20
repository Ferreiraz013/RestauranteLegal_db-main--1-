<?php
namespace RestauranteLegal\Models;

use Exception;

class Marmita {
    private int $idMarmita;
    private string $pratoMarmita;
    private float $precoMarmita;
    private string $validadeMarmita;
    private string $tabela = "marmita";

    public function __construct(int $idMarmita, string $pratoMarmita, float $precoMarmita, string $validadeMarmita) {
        $this->setIdMarmita($idMarmita);
        $this->setPratoMarmita($pratoMarmita);
        $this->setPrecoMarmita($precoMarmita);
        $this->setValidadeMarmita($validadeMarmita);
    }

    // Setters
    public function setIdMarmita(int $idMarmita): void {
        if ($idMarmita <= 0) {
            throw new Exception("O ID da marmita deve ser maior que zero.");
        }
        $this->idMarmita = $idMarmita;
    }

    public function setPratoMarmita(string $pratoMarmita): void {
        $nomeLimpo = trim($pratoMarmita);
        if ($nomeLimpo === "") {
            throw new Exception("O nome do prato da marmita não pode ser vazio.");
        }
        if (strlen($nomeLimpo) < 3) {
            throw new Exception("O nome do prato da marmita deve ter ao menos 3 caracteres.");
        }
        $this->pratoMarmita = $nomeLimpo;
    }

    public function setPrecoMarmita(float $precoMarmita): void {
        if ($precoMarmita <= 0) {
            throw new Exception("O preço da marmita deve ser maior que zero.");
        }
        $this->precoMarmita = (float) $precoMarmita;
    }

    public function setValidadeMarmita(string $validadeMarmita): void {
        $dataValida = \DateTime::createFromFormat('Y-m-d', $validadeMarmita);
        if (!$dataValida || $dataValida->format('Y-m-d') !== $validadeMarmita) {
            throw new Exception("A validade da marmita deve estar no formato AAAA-MM-DD.");
        }
        $this->validadeMarmita = $validadeMarmita;
    }

    //Método para aplicar desconto em porcentagem
    //O método "aplicarDesconto" recebe um valor de desconto em porcentagem e aplica esse desconto ao preço da marmita. O valor do desconto deve estar entre 0% e 100%. Se o valor estiver fora desse intervalo, uma exceção será lançada. O preço da marmita é atualizado subtraindo o valor do desconto calculado a partir do preço original.
    public function aplicarDesconto(float $valorDesconto): void {
        if ($valorDesconto < 0 || $valorDesconto > 100) {
            throw new Exception("O valor do desconto deve estar entre 0% e 100%.");
        }
        $desconto = ($this->precoMarmita * $valorDesconto) / 100;
        $this->precoMarmita -= $desconto;
    }

    // Getters
    public function getIdMarmita(): int {
        return $this->idMarmita;
    }

    public function getPratoMarmita(): string {
        return $this->pratoMarmita;
    }

    public function getPrecoMarmita(): float {
        return $this->precoMarmita;
    }

    public function getPrecoFormatado(): string {
        return "R$ " . number_format($this->precoMarmita, 2, ',', '.');
    }

    public function getValidadeMarmita(): string {
        return $this->validadeMarmita;
    }

    public function getMarmitaHTML(): string {
        return "====== MARMITA CRIADA COM SUCESSO ====== <br>
                id: " . $this->getIdMarmita() . " <br>
                Prato: " . $this->getPratoMarmita() . " <br>
                Validade: " . $this->getValidadeMarmita() . " <br>
                Preço: " . $this->getPrecoFormatado() . " <br><br>";
    }
}
?>