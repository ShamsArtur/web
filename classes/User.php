<?php
require_once('/classes/facebook/facebook.php');




class user
{
    public $id;
    public $name;
    public $birthday;
    public $gender;
    public $groups;
    public $picture;
    public $link;
    public $likes = array();
    public $access_token;
    public $friends = array();

    public function __construct($accessToken)
    {
        $url = 'https://graph.facebook.com/me';
        $params = array(
            "fields" => "id,link,birthday,name,gender,groups{id,name,administrator},likes{access_token,name,id,can_post},friends{name,id}",
            "access_token" => $accessToken
        );
        $data = Facebook::cURL('get', $url, $params);
        if (isset($data['id']))
            $this->id = $data['id'];
        else return;
        $this->name = $data['name'];
        if (isset($data['birthday']))
            $this->birthday = $data['birthday'];
        else
            $this->birthday = null;
        if(!empty($data['groups']))
            $this->groups = $data['groups']['data'];
        else $this->group = null;
        if(!empty($data['likes']))
            $this->likes = $data['likes']['data'];
        else $this->likes = null;
        $this->link = $data['link'];
        $this->access_token = $accessToken;
        $this->friends=$data['friends']['data'];
        $this->gender = $data['gender'];
        //echo '<br><br><br>';
        //print_r($data);
    }
    public function getFriends()
    {
        return $this->friends;
    }
    public function getUserLink()
    {
        return $this->link;
    }

    public function getFullName()
    {
        return $this->name;
    }
    public function getBirthday()
    {
        return $this->birthday;
    }
    public function getGender()
    {
        return $this->gender;
    }
    public function getID()
    {
        return $this->id;
    }

    public function getLikeID()
    {
        return $this->likes['id'];
    }

    public function getLikeAccessToken()
    {
        return $this->likes['access_token'];
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function getLikes()
    {
        return $this->likes;
    }

    public function printPicture()
    {
        if (!is_bool($this->picture))
            echo '<img src="http://graph.facebook.com/' . $this->getID() . '/picture?type=large">';
    }


}
    Class group
    {
        var $id;
        var $name;
        var $is_admin;

        function __construct($data)
        {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->is_admin = $data['is_admin'];
        }
        function is_admin()
        {
            return $this->is_admin;
        }
        function get_name()
        {
            return $this->name;
        }
        function get_id()
        {
            return $this->id;
        }
    }

?>