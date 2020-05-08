<?php
class Method
{
  var $user_name;
  var $pass;
  var $download_link;

  public function getDownloadLink()
  {
    return $this->download_link;
  }

  public function getUserName()
  {
    return $this->user_name;
  }

  public function getPass()
  {
    return $this->pass;
  }

  public function setUserName($user_name)
  {

    $this->user_name = $user_name;
  }

  public function setPass($pass)
  {

    $this->pass = $pass;
  }

  public function setDwnloadLink($download_link)
  {

    $this->download_link = $download_link;
  }


  public function Creds()
  {
    $url = 'http://nilepromotion.com/pa-test/wp-json/test/v2/creds?username='.$this->getUserName().'&password='.$this->getPass().'';
    $data = file_get_contents($url);
    $auth = json_decode($data, true);
    if ($auth['login'] == 'successful') {
      setcookie("usercookie", 'true', time() + 60 * 3);
      unset($auth['username'], $auth['password']);
      http_response_code(200);
      echo json_encode(
        array("login" => "successful")
      );
    } else {
      http_response_code(404);
      echo json_encode(
        array("login" => "failed")
      );
    }
  }

  public function BeforeLogIn()
  {
    $url = 'https://api.jsonbin.io/b/5eafd4ca47a2266b1472794c';
    $data = file_get_contents($url);
    $playlist = json_decode($data, true);
    $id = 1;
    $tracks = [];
    foreach ($playlist['tracks'] as $track) {
      $track['id'] = $id;
      unset($track['url']);
      array_push($tracks, $track);
      $id++;
    }
    http_response_code(200);
    echo json_encode($tracks);
  }

}
