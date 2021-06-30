<?php

namespace App;

abstract class Model
{

    const TABLE = '';

    public $id;

    public static function findAll()
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE,
            [],
            static::class
        );
    }

    public static function findById($id)
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE id=:id',
            [':id' => $id],
            static::class
        )[0];
    }

    public static function setValueToTable($id, $field, $field_value)
    {
		$sql = '
		UPDATE ' . static::TABLE . ' SET ' . $field . ' = :field_value WHERE id = :id;
        ';
		$values = [':id' => $id, ':field_value' => $field_value];
        $db = Db::instance();
		
		return $db->execute($sql, $values);
    }

    public function insert()
    {
        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            $columns[] = $k;
            $values[':'.$k] = $v;
        }

        $sql = '
		INSERT INTO ' . static::TABLE . '
		(' . implode(',', $columns) . ')
		VALUES
		(' . implode(',', array_keys($values)) . ')
        ';
        $db = Db::instance();
		
		return $db->execute($sql, $values);
    }

    public function delete()
    {
		$sql = '
		DELETE FROM ' . static::TABLE . '
		WHERE ' . static::TABLE . '
		.id = :id
        ';
		$values = [':id' => $this->id];
        $db = Db::instance();
		
		return $db->execute($sql, $values);
    }
}