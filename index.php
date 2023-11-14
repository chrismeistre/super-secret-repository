<?php
  $dev_mode = true;
  if ($dev_mode) {
    $env_file = __DIR__."/.env.dev";
  } else {
    $env_file = __DIR__."/.env";
  }
  
  if (file_exists($env_file) && is_file($env_file)) {
    $env = file_get_contents($env_file);
    $lines = explode("\n",$env);

    foreach($lines as $line){
      preg_match("/([^#]+)\=(.*)/",$line,$matches);
      if(isset($matches[2])){
        putenv(trim($line));
      }
    }

    # testing access - hardcoded for now
    if ($dev_mode) {
      putenv("access_key=\"8OkfHRRQtJB2QLFEJGqkC0s9joaduQCgRxP+Zggt\"");
    }

    var_dump(getenv());
  } else {
    echo "Cannot find configuration file.\n";
  }
