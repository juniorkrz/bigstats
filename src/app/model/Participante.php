<?php

namespace App\model;

class Participante
{
    public $id;
    public $nome;
    public $eliminado;
    public $grupo;
    public $instagram;
    public $detalhes;
    public $nome_completo;
    public $profissao;
    public $cidade;
    public $estado;
    public $idade;

    public function __construct(
        $id = null,
        $nome = null,
        $eliminado = null,
        $grupo = null,
        $instagram = null,
        $detalhes = null,
        $nome_completo = null,
        $profissao = null,
        $cidade = null,
        $estado = null,
        $idade = null
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->eliminado = $eliminado;
        $this->grupo = $grupo;
        $this->instagram = $instagram;
        $this->detalhes = $detalhes;
        $this->nome_completo = $nome_completo;
        $this->profissao = $profissao;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->idade = $idade;
    }

    public function getTableName()
    {
        return 'bbb_participante';
    }
}
