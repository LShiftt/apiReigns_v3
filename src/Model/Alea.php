<?php

declare(strict_types=1);

namespace App\Model;

class Alea extends Model
{
    use TraitInstance;

    protected $tableName = 'carte_aleatoire';

    public function edit(
        int $id,
        array $datas
    ): bool {

        $sql = 'UPDATE `' . $this->tableName . '` SET ';
        foreach (array_keys($datas) as $k) {
            $sql .= " {$k} = :{$k} ,";
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql .= ' WHERE num_carte =:id';
        foreach (array_keys($datas) as $k) {
            $attributes[':' . $k] = $datas[$k];
        }
        $attributes[':id'] = $id;
        $sth = $this->query($sql, $attributes);
        return $sth->rowCount() > 0;
    }

    public function del(
        int $id
    ): bool {
        $sql = "DELETE FROM `{$this->tableName}` WHERE num_carte = :id";
        $sth = $this->query($sql, [':id' => $id]);
        return $sth->rowCount() > 0;
    }
}

