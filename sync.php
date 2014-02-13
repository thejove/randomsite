<?php

$b=isset($_GET["b"]) ? $_GET["b"] : 0;


$branches=array("master");
print "<pre>";
print shell_exec("git fetch origin ".$branches[$b]." 2>&1");
print shell_exec("git checkout ".$branches[$b]);

