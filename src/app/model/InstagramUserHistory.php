<?php

namespace App\model;


class InstagramUserHistory
{
    public $id;
    public $instagram_id;
    public $username;
    public $full_name;
    public $biography;
    public $followers_count;
    public $created_at;

    public function __construct(
        $id = null,
        $instagram_id = null,
        $username = null,
        $full_name = null,
        $biography = null,
        $followers_count = null,
        $created_at = null
    ) {

        if ($created_at == null) {
            $created_at = date('Y-m-d H:i:s');
        }

        $this->id = $id;
        $this->instagram_id = $instagram_id;
        $this->username = $username;
        $this->full_name = $full_name;
        $this->biography = $biography;
        $this->followers_count = $followers_count;
        $this->created_at = $created_at;
    }

    public function getTableName()
    {
        return 'instagram_user_history';
    }

    public function fromInstagramUser(InstagramUser $instagramUser)
    {
        $this->instagram_id = $instagramUser->instagram_id;
        $this->username = $instagramUser->username;
        $this->full_name = $instagramUser->full_name;
        $this->biography = $instagramUser->biography;
        $this->followers_count = $instagramUser->followers_count;

        return $this;
    }
}
