<?php

namespace Objects;

/**
 * Represents structure of the game object 
 */

class Games extends BaseObject
{
    const STATES = [
        0 => "Inactive",
        1 => "Active"
    ];

    public $id;
    public $name;
    public $state;
    public $picture;
    public $create_time;

    public static function getTable(): string
    {
        return "game";
    }

    public static function getPKColumn(): string
    {
        return "id";
    }

    public function beforeCreate(): void
    {
        $this->create_time = date("Y-m-d H:i:s");
    }

}