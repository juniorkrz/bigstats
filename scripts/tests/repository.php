<?php

require_once "../../src/app/config.php";
use App\model\Participante;
use App\util\Repository;

// Criando uma instância do repositório para a entidade Participante
$rep_participante = new Repository(Participante::class);

echo "Repository test" . PHP_EOL;
echo "🔜 Iniciando testes..." . PHP_EOL;

$className = (new \ReflectionClass($rep_participante->className))->getShortName();
echo "Class: $className" . PHP_EOL;
echo "Table: $rep_participante->table" . PHP_EOL;
echo "Primary key: $rep_participante->primaryKey" . PHP_EOL;

$findAll = $rep_participante->findAll();
if (is_array($findAll)) {
    echo "✅ findAll: " . count($findAll) . " registros" . PHP_EOL;
} else {
    echo "❌ findAll" . PHP_EOL;
}

$findByQuery = $rep_participante->refindByQuery("SELECT * FROM $rep_participante->table;");
if (is_array($findByQuery)) {
    echo "✅ findByQuery: " . count($findByQuery) . " registros" . PHP_EOL;
} else {
    echo "❌ findByQuery" . PHP_EOL;
}

if (count($findByQuery) === count($findAll)) {
    echo "✅ Quantidade de registros: " . count($findByQuery) . "" . PHP_EOL;
} else {
    echo "❌ Quantidade de registros" . PHP_EOL;
}

// Criando um objeto de teste
$novoParticipante = new Participante();
$novoParticipante->nome = "Teste";
$novoParticipante->eliminado = false;
$novoParticipante->grupo = "Pipoca";
$novoParticipante->instagram = "@teste";
$novoParticipante->detalhes = "Somente um teste.";

// Teste: Salvar um novo participante
$salvou = $rep_participante->save($novoParticipante);
if ($salvou) {
    echo "✅ save" . PHP_EOL;
} else {
    echo "❌ save" . PHP_EOL;
}

// Teste: Buscar todos os registros (deve ter pelo menos 1 agora)
$findAllAfterSave = $rep_participante->refindAll();
if (count($findAll) < count($findAllAfterSave)) {
    echo "✅ findAll (após save): " . count($findAllAfterSave) . " registros" . PHP_EOL;
} else {
    echo "❌ findAll" . PHP_EOL;
}

// Pegando o ultimo resultado para atualizar e testar update
$ultimo = $rep_participante->getLast();
$nomeAntigo = $ultimo->nome;
$ultimo->nome = "Teste atualizado";

// Teste: Atualizar um participante
$atualizou = $rep_participante->update($ultimo);
if ($atualizou) {
    echo "✅ update: $nomeAntigo -> $ultimo->nome" . PHP_EOL;
} else {
    echo "❌ update" . PHP_EOL;
}

// Teste: Buscar participante atualizado
$rep_participante->sample->id = $ultimo->id;

$findBySample = $rep_participante->findBySample();
$encontrado = $rep_participante->get($ultimo->id);

if ($encontrado) {
    echo "✅ get: $encontrado->nome" . PHP_EOL;
} else {
    echo "❌ get" . PHP_EOL;
}

if ($encontrado->nome == "Teste atualizado") {
    $count = count($findBySample);
    echo "✅ findBySample (após update): $count registros" . PHP_EOL;
} else {
    echo "❌ findBySample (após update)" . PHP_EOL;
}

// Teste: Deletar participante
$deletou = $rep_participante->delete($encontrado);
if ($deletou) {
    echo "✅ delete" . PHP_EOL;
} else {
    echo "❌ delete" . PHP_EOL;
}

// Teste: Verificar se a tabela está vazia após a exclusão
$findAllAfterDelete = $rep_participante->refindAll();
if (count($findBySample) > count($findAllAfterDelete)) {
    echo "✅ findAll (após delete): " . count($findAllAfterDelete) . " registros" . PHP_EOL;
} else {
    echo "❌ findAll (após delete)" . PHP_EOL;
}

$first = $rep_participante->getFirst();
if ($first === ($rep_participante->isEmpty() ? null : $rep_participante->objects[array_key_first($rep_participante->objects)])) {
    echo "✅ getFirst: $first->nome" . PHP_EOL;
} else {
    echo "❌ getFirst" . PHP_EOL;
}

$last = $rep_participante->getLast();
if ($last === ($rep_participante->isEmpty() ? null : $rep_participante->objects[array_key_last($rep_participante->objects)])) {
    echo "✅ getLast: $last->nome" . PHP_EOL;
} else {
    echo "❌ getLast" . PHP_EOL;
}

$attr = $rep_participante->primaryKey;
$asArr = $rep_participante->toArray($attr);
if (count($asArr) == $rep_participante->count()) {
    $arrAsStr = implode(", ", $asArr);
    echo "✅ toArray ($attr): $arrAsStr" . PHP_EOL;
} else {
    echo "❌ toArray" . PHP_EOL;
}

$attr = 'nome';
$asArr = $rep_participante->toArray($attr);
if (count($asArr) == $rep_participante->count()) {
    $arrAsStr = implode(", ", $asArr);
    echo "✅ toArray ($attr): $arrAsStr" . PHP_EOL;
} else {
    echo "❌ toArray" . PHP_EOL;
}

$rep_participante->reset();
if ($rep_participante->isEmpty() && $rep_participante->count() === 0) {
    echo "✅ reset" . PHP_EOL;
    echo "✅ count: 0" . PHP_EOL;
    echo "✅ isEmpty" . PHP_EOL;
} else {
    echo "❌ reset" . PHP_EOL;
    echo "❌ count" . PHP_EOL;
    echo "❌ isEmpty" . PHP_EOL;
}

echo "🔚 Testes finalizados." . PHP_EOL;

?>
