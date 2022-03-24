<?php

spl_autoload_register(function($name) {
    $f = str_replace("\\", "/", $name);
    require_once("../{$f}.php");
});


function script($s)
{
    echo "<script>$s</script>";
};

function alert($t="")
{
    !empty($t) && script("alert('$t');");
};

function move($tg, $t="")
{
    alert($t);
    script("location.replace('$tg');");
    exit;
};

function back($t="")
{
    alert($t);
    script("history.back();");
    exit;
};


function view($page, $data=[])
{
    extract($data);

    require_once("src/views/header.php");
    require_once("src/views/{$page}.php");
    require_once("src/views/footer.php");
};

function getItems($tg, ...$names)
{
    return array_map(function ($name) use ($tg) {
        return $tg[$name];
    }, $names);
};

function get(...$names) {
    return getItems($_GET, ...$names);
};

function post(...$names) {
    return getItems($_POST, ...$names);
};
















