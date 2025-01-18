<?php

namespace App\model;

class Participante
{
    public $id;
    public $nome;
    public $grupo;
    public $instagram;
    public $detalhes;

    public function __construct(
        $id = null,
        $nome = null,
        $grupo = null,
        $instagram = null,
        $detalhes = null
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->grupo = $grupo;
        $this->instagram = $instagram;
        $this->detalhes = $detalhes;
    }

    public function getTableName()
    {
        return 'bbb_participante';
    }
}
