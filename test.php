<?php

include 'vendor/autoload.php';

$fm = Bulldog\FrontMatter::load('file.yaml');

var_dump($fm->config());
var_dump($fm->html());
