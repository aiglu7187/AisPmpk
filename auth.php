<!DOCTYPE html>
<html lang="ru">
<meta charset="utf-8" /> 
<head>
<title></title>


<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="semantic/dist/semantic.min.js"></script>

</head>
<body>

<?php

$realm = 'PMPK';

$users = array('pmpk' => 'pmpkpass19');

if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Digest realm="'.$realm.
           '",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"');

    die('Deny');
}


if (!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) ||
    !isset($users[$data['username']]))
    die('Выход выполнен!');


$A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
$A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);
$valid_response = md5($A1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2);


if ($data['response'] != $valid_response)
    die('Выход выполнен!');


function http_digest_parse($txt)
{
    // защита от отсутствующих данных
    $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
    $data = array();
    $keys = implode('|', array_keys($needed_parts));

    preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

    foreach ($matches as $m) {
        $data[$m[1]] = $m[3] ? $m[3] : $m[4];
        unset($needed_parts[$m[1]]);
    }

    return $needed_parts ? false : $data;
}





?>



<br>



<div class="ui stackable five column grid container">

<div class="row">

<div class="column">
<a class="big ui button fluid" href="lib/tpl/showlist.php?s=1">
  Выезд в ОО
</a>
</div>
<div class="column">
<a class="big ui button fluid" href="lib/tpl/showlist.php?s=2">
  Выезд на дом
</a>
</div>
<div class="column">
<a class="big ui button fluid" href="lib/tpl/showlist.php?s=3">
  Зеленоград
</a>
</div>
<div class="column">
<a class="big ui button fluid" href="lib/tpl/showlist.php?s=4">
  Бехтерева
</a>
</div>
<div class="column">
<a class="big ui button fluid" href="lib/tpl/showlist.php?s=5">
  Шаболовка
</a>
</div>

</div>

</div>


<script>

</script>
</body>
</html>
