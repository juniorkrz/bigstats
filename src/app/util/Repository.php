<?php

namespace App\util;

use App\util\Database;
use Exception;
use PDO;
use ReflectionClass;
use ReflectionProperty;

class Repository
{
    private $pdo;
    public $className;
    public $table;
    public $sample;
    public $objects;

    public function __construct($className)
    {
        $this->pdo = Database::getConnection();
        $this->className = $className;
        $this->sample = new $className();
        $this->table = $this->sample->getTableName();
        $this->objects = [];
    }

    public function isEmpty()
    {
        return empty($this->objects);
    }

    public function count()
    {
        return count($this->objects);
    }

    public function getFirst()
    {
        return $this->objects[0];
    }

    public function getLast()
    {
        return $this->objects[array_key_last($this->objects)];
    }

    public function resetSample()
    {
        $this->sample = new $this->className();
    }

    public function resetObjects()
    {
        $this->objects = [];
    }

    public function reset()
    {
        $this->resetSample();
        $this->resetObjects();
    }

    // Método para salvar o objeto
    public function save($object)
    {
        $reflection = new ReflectionClass($object);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        $columns = [];
        $placeholders = [];
        $params = [];

        // Obter os tipos das colunas diretamente do banco
        $columnTypes = $this->getColumnTypes();

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $value = $object->$propertyName;

            // Verificando o tipo de dado da coluna e tratando nulls
            if (array_key_exists($propertyName, $columnTypes)) {
                $columnType = $columnTypes[$propertyName];

                // Caso o valor seja null, ele pode ser aceito se a coluna permitir NULL
                if ($value === null && strpos($columnType, 'null') === false) {
                    continue; // Não inclui as colunas com valores nulos que não aceitam null
                }
            }

            // Adicionando a coluna, placeholder e o valor para os parâmetros
            $columns[] = $propertyName;
            $placeholders[] = ":$propertyName";
            $params[":$propertyName"] = $value;
        }

        // Verificando se existem colunas a serem inseridas
        if (empty($columns)) {
            throw new Exception("Não há dados para salvar.");
        }

        $columnsList = implode(', ', $columns);
        $placeholdersList = implode(', ', $placeholders);

        // Montando o SQL de inserção
        $sql = "INSERT INTO {$this->table} ($columnsList) VALUES ($placeholdersList)";
        $stmt = $this->pdo->prepare($sql);

        // Vinculando os parâmetros
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        // Executando a consulta
        return $stmt->execute();
    }


    // Método para atualizar o objeto
    public function update($object)
    {
        $reflection = new ReflectionClass($object);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        $sets = [];
        $params = [];

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $value = $object->$propertyName;

            // Ignorar valores nulos
            if ($value !== null) {
                $sets[] = "$propertyName = :$propertyName";
                $params[":$propertyName"] = $value;
            }
        }

        // Determinar a chave primária
        if (method_exists($object, 'getPk')) {
            $pk = $object->getPk();
        } else {
            $pk = 'id'; // Padrão para "id"
        }

        // Adicionar a chave primária aos parâmetros
        /* $params[':' . $pk] = $object->$pk; */

        // Se não houver colunas para atualizar, lançar exceção
        if (empty($sets)) {
            throw new Exception("Nenhum campo válido para atualizar.");
        }

        $setsList = implode(', ', $sets);
        $sql = "UPDATE {$this->table} SET $setsList WHERE $pk = :{$pk}";

        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        return $stmt->execute();
    }


    // Método para deletar o objeto
    public function delete($object)
    {
        // Determinar a chave primária
        if (method_exists($object, 'getPk')) {
            $pk = $object->getPk();
        } else {
            $pk = 'id'; // Padrão para "id"
        }

        $sql = "DELETE FROM {$this->table} WHERE $pk = :$pk";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':' . $pk, $object->$pk);
        return $stmt->execute();
    }

    // Método para buscar todos os registros
    public function findAll($options = null)
    {
        $sql = "SELECT * FROM {$this->table}";

        if ($options !== null) {
            $sql .= ' ' . $options;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->objects = array_merge($this->objects, $this->mapToObjects($results));

        return $this->objects;
    }

    public function findOne($options = null)
    {
        $sql = "LIMIT 1";

        if ($options !== null) {
            $sql = $options . ' ' . $sql;
        }

        return $this->findAll($sql);
    }

    // Método para buscar registros com uma consulta personalizada
    public function findByQuery(string $query, array $params = [])
    {
        $stmt = $this->pdo->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->objects = array_merge($this->objects, $this->mapToObjects($results));

        return $this->objects;
    }

    public function findBySample(object $sample = null)
    {
        if ($sample === null) {
            $sample = $this->sample;
        }

        $fields = get_object_vars($sample); // Obtendo as propriedades do objeto

        // Filtrando as propriedades que são diferentes de null
        $conditions = [];
        $params = [];
        foreach ($fields as $field => $value) {
            if ($value !== null) {
                // Usando o nome da coluna (assumindo que o nome da propriedade seja igual ao nome da coluna)
                $conditions[] = "$field = :$field";
                $params[":$field"] = $value;
            }
        }

        // Se houver condições, montamos a parte WHERE da consulta
        $where = '';
        if (count($conditions) > 0) {
            $where = 'WHERE ' . implode(' AND ', $conditions);
        }

        // Construindo a consulta SQL
        $sql = "SELECT * FROM $this->table $where";

        // Preparando e executando a consulta
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        // Obtendo o resultado como um array associativo
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Mapeando os resultados para instâncias da classe
        $objects = [];
        foreach ($rows as $row) {
            $object = new $this->className();
            foreach ($row as $column => $value) {
                // Atribuindo os valores das colunas para as propriedades do objeto
                if (property_exists($object, $column)) {
                    $object->$column = $value;
                }
            }
            $objects[] = $object;
        }

        // Retornando os objetos mapeados
        $this->objects = array_merge($this->objects, $this->mapToObjects($objects));
        return $this->objects;
    }

    public function refindAll()
    {
        $this->resetObjects();
        return $this->findAll();
    }

    public function refindByQuery(string $query, array $params = [])
    {
        $this->resetObjects();
        return $this->findByQuery($query, $params);
    }

    public function refindBySample(object $sample = null)
    {
        $this->resetObjects();
        return $this->findBySample($sample);
    }

    private function mapToObjects(array $data)
    {
        $className = $this->className;
        $objects = [];

        // Obter os tipos das colunas diretamente do banco
        $columnTypes = $this->getColumnTypes();

        foreach ($data as $row) {
            $object = new $className();

            foreach ($row as $column => $value) {
                // Verificar se a coluna tem um tipo definido
                if (array_key_exists($column, $columnTypes)) {
                    // Obter o tipo da coluna
                    $columnType = $columnTypes[$column];

                    // Converter o valor de acordo com o tipo
                    switch ($columnType) {
                        case 'int':
                        case 'integer':
                        case 'bigint':
                            $value = (int) $value; // Converter para inteiro
                            break;
                        case 'float':
                        case 'double':
                            $value = (float) $value; // Converter para float
                            break;
                        case 'varchar':
                        case 'text':
                            $value = (string) $value; // Garantir que seja uma string
                            break;
                        /* case 'datetime':
                        case 'timestamp':
                            $value = new \DateTime($value); // Converter para DateTime, se necessário
                            break; */
                        case 'boolean':
                            $value = (bool) $value; // Converter para booleano
                            break;
                        default:
                            // Caso o tipo não seja tratado, mantemos o valor original
                            break;
                    }
                }

                // Atribuir o valor convertido à propriedade do objeto
                $object->$column = $value;
            }

            $objects[] = $object;
        }

        return $objects;
    }

    // Método para obter os tipos das colunas de uma tabela no banco de dados
    private function getColumnTypes(): array
    {
        // Consultar os tipos de colunas diretamente no banco
        $sql = "DESCRIBE " . $this->table;
        $statement = $this->pdo->query($sql);
        $columns = $statement->fetchAll(PDO::FETCH_ASSOC);

        $columnTypes = [];
        foreach ($columns as $column) {
            $columnTypes[$column['Field']] = $column['Type'];
        }

        return $columnTypes;
    }
}
