<?php if (!defined('BASEPATH')) exit('No direct script acess allowed');

function encode_crip ($string) {
  return hashPassword($string);
}

function decode_crip ($string) {
  return base64_decode($string);
}

function hashPassword ($password) {
  $options = ['cost' => 12];
  return password_hash($password, PASSWORD_BCRYPT, $options);
}

function compareHash ($password, $hash) {
  return password_verify($password, $hash);
}

function setFileName (string $fileName) {
  $fileInfo = pathinfo($fileName);
  $extension = $fileInfo['extension'];
  $fileName = $fileInfo['filename'];
  
  return slugify($fileName). '-' . date('d-m-Y') . ".$extension";
}

function normalize ($string) {
  $table = [
    'Š' => 'S', 'š' => 's', 'Đ' => 'Dj', 'đ' => 'dj', 'Ž' => 'Z', 'ž' => 'z', 'Č' => 'C', 'č' => 'c', 'Ć' => 'C', 'ć' => 'c',
    'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
    'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O',
    'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss',
    'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
    'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o',
    'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b',
    'ÿ' => 'y', 'Ŕ' => 'R', 'ŕ' => 'r',
  ];

  return strtr($string, $table);
}

function slugify ($text) {
  $text = normalize($text);
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, '-');
  $text = preg_replace('~-+~', '-', $text);
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

function antiInjection ($field, $addSlashes = false) {
  $field = preg_replace('/(from|alter table|select|insert|delete|update|where|drop table|show tables|#|\*|--|\\\\)/i', '', $field);
  $field = trim($field);
  $field = strip_tags($field);

  if ($addSlashes) {
    $field = addslashes($field);
  }

  return $field;
}

function getTimePlural (string $time) {
  if ($time == 'mês') return 'meses';
  return $time . 's';
}

function getElapsedTime ($datetime, $full = false) {
  date_default_timezone_set('America/Sao_Paulo');

  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = [
    'y' => 'ano',
    'm' => 'mês',
    'w' => 'semama',
    'd' => 'dia',
    'h' => 'hora',
    'i' => 'minuto',
    's' => 'segundo'
  ];

  foreach ($string as $k => &$v) {
    if ($diff->$k) {
      $v = $diff->$k . ' ' . ($diff->$k > 1 ? getTimePlural($v) : $v);
    } else {
      unset($string[$k]);
    }
  }

  if (!$full) $string = array_slice($string, 0, 1);

  return $string ? implode(', ', $string) . ' atrás' : 'agora mesmo';
}

function validEmail ($email) {
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return false;
  }

  return true;
}
