<?php

class Pessoa
{
    private string $nome;
    private string $dataNascimento;
    private float $peso;
    private float $altura;
    private bool $fumante;

    public function __construct(
        string $nome,
        string $dataNascimento,
        float $peso,
        float $altura,
        bool $fumante
    ) {
        $this->nome = $nome;
        $this->dataNascimento = $dataNascimento;
        $this->peso = $peso;
        $this->altura = $altura;
        $this->fumante = $fumante;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function isFumante(): bool
    {
        return $this->fumante;
    }

    public function calcularIdade(): int
    {
        $nascimento = new DateTime($this->dataNascimento);
        $hoje = new DateTime();
        return $hoje->diff($nascimento)->y;
    }

    public function calcularIMC(): float
    {
        if ($this->altura <= 0) {
            return 0.0;
        }

        $imc = $this->peso / ($this->altura * $this->altura);
        return round($imc, 2);
    }

    public function classificarIMC(): string
    {
        $imc = $this->calcularIMC();

        if ($imc < 18.5) {
            return "Abaixo do peso";
        } elseif ($imc < 25) {
            return "Peso normal";
        } elseif ($imc < 30) {
            return "Sobrepeso";
        } elseif ($imc < 35) {
            return "Obesidade Grau I";
        } elseif ($imc < 40) {
            return "Obesidade Grau II";
        } else {
            return "Obesidade Grau III";
        }
    }
}
