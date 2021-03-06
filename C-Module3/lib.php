<?php

spl_autoload_register(function($f) {
    $f = str_replace("\\", "/", $f);
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

    require_once("../src/views/template/header.php");
    require_once("../src/views/{$page}.php");
    require_once("../src/views/template/footer.php");
};