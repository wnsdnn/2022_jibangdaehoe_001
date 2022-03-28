<?php

spl_autoload_register(function($name) {
    $f = str_replace("\\", "/", $name);
    require_once("../{$f}.php");
});


function script($tg)
{
    echo "<script>$tg</script>";
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
    script("history.back()");
    exit;
};

function view($page, $data=[])
{
    extract($data);

    require_once("../src/views/template/header.php");
    require_once("../src/views/{$page}.php");
    require_once("../src/views/template/footer.php");
};

function getItem($tg, ...$names)
{
    return array_map(function($name) use ($tg) {
        return $tg[$name];
    }, $names);
};

function get(...$names)
{
    return getItem($_GET, ...$names);
};

function post(...$names)
{
    return getItem($_POST, ...$names);
};

