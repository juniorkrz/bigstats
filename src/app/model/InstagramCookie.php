<?php

namespace App\model;

class InstagramCookie
{
    public $id;
    public $name;
    public $value;
    public $instagram_account_id;
    public $created_at;
    public $updated_at;

    public function __construct(
        $id = null,
        $name = null,
        $value = null,
        $instagram_account_id = null,
        $created_at = null,
        $updated_at = null,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->instagram_account_id = $instagram_account_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getTableName()
    {
        return 'instagram_cookie';
    }
}
