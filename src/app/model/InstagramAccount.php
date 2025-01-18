<?php

namespace App\model;

use App\util\Repository;

class InstagramAccount
{
    public $id;
    public $ds_user_id;
    public $uses;
    public $created_at;
    public $updated_at;

    public function __construct(
        $id = null,
        $ds_user_id = null,
        $uses = null,
        $created_at = null,
        $updated_at = null
    ) {
        $this->id = $id;
        $this->ds_user_id = $ds_user_id;
        $this->uses = $uses;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getTableName()
    {
        return 'instagram_account';
    }

    public function getCookies()
    {
        $rep_cookie = new Repository(InstagramCookie::class);
        $rep_cookie->sample->instagram_account_id = $this->id;
        $cookies = $rep_cookie->findAll();

        $cookie_str = '';
        foreach ($cookies as $cookie) {
            $cookie_str .= $cookie->name.'='.$cookie->value.';';
        }

        return $cookie_str;
    }
}
