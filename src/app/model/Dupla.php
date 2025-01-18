<?php

namespace App\model;

class Dupla
{
    public $id;
    public $id_participante_1;
    public $id_participante_2;
    public $detalhes;
    public $grupo;
    public $grau_relacao;

    public function __construct(
        $id = null,
        $id_participante_1 = null,
        $id_participante_2 = null,
        $detalhes = null,
        $grupo = null,
        $grau_relacao = null
    ) {
        $this->id = $id;
        $this->id_participante_1 = $id_participante_1;
        $this->id_participante_2 = $id_participante_2;
        $this->detalhes = $detalhes;
        $this->grupo = $grupo;
        $this->grau_relacao = $grau_relacao;
    }

    public function getTableName()
    {
        return 'bbb_dupla';
    }
}
