<?php
$client_id = '1651834448163231'; // ClientID
$client_secret = 'b36a7f20414820008a99c395334ca599'; // ClientSecretKey
$redirect_uri = 'http://localhost/'; // RedirectURIs

$url = 'https://www.facebook.com/dialog/oauth'; //BaseAuthURL

$params = array(
    'client_id' => $client_id, // ClientID
    'redirect_uri' => $redirect_uri, // RedirectURIs
    'response_type' => 'code', //Type_of_response_type
    'scope' => 'email,user_birthday,publish_actions,user_about_me,user_likes,user_hometown,user_status,user_website,user_managed_groups,publish_pages,manage_pages,pages_show_list,pages_manage_instant_articles,user_friends'
    //Permissions
);
?>