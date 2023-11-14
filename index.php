<?php
  $dev_mode = false;
  if ($dev_mode) {
    $env_file = __DIR__."/.env.dev";
  } else {
    $env_file = __DIR__."/.env";
  }

  function checkBase64Encoded($str) {
    return base64_encode(base64_decode($str, true)) === $str;
  }
  
  if (file_exists($env_file) && is_file($env_file)) {
    $env = file_get_contents($env_file);
    $lines = explode("\n",$env);

    foreach($lines as $line){
      if (checkBase64Encoded($line)) {
        $line = base64_decode(trim($line));
      }
      preg_match("/([^#]+)\=(.*)/",$line,$matches);
      if(isset($matches[2])){
        putenv(trim($line));
      }
    }

    var_dump(getenv());
  } else {
    echo "Cannot find configuration file.\n";
  }
