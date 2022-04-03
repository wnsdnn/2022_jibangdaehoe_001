<?php
namespace src\Controller;

class View
{
    function indexPage()
    {
        // unset($_SESSION["admin"]);
        view("index");
    }

    function sub1Page()
    {
        $list = fetchAll('SELECT * FROM `specialty`');
        view("sub1", ["list" => $list]);
    }

    function sub2Page()
    {
        view("sub2");
    }

    function sub3Page()
    {
        $default = fetchAll("SELECT * FROM `review` ORDER BY `key` DESC");
        $key = $default ? $default[0]->key : 0;
        view("sub3", ["key" => $key]);
    }

    function adminPage()
    {
        view("admin");
    }

    function adminProccess()
    {
        extract($_POST);
        if($id == "admin" && $pass == "1234") {
            $_SESSION["admin"] = true;
            move("/", "관리자 권한이 부여되었습니다.");
        }
        back("아이디 혹은 비밀번호가 다릅니다.");
    }

    function adminSPage()
    {
        if(!isset($_SESSION["admin"])) {
            back("관리자 권한이 필요합니다.");
            return;
        }
        $list = fetchAll("SELECT * FROM `specialty`");
        view("admin_specialty", ["list" => $list]);
    }

    function adminEPage()
    {
        if(!isset($_SESSION["admin"]))
        {
            back("관리자 권한이 필요합니다.");
            return;
        }
        $list = fetchAll("SELECT * FROM `event`");
        view("admin_event", ["list" => $list]);
    }

    function detailPage()
    {
        $result = fetch('SELECT * FROM `specialty` WHERE area = ?', [$_GET["area"]]);
        view("detail", ["result" => $result]);
    }

    function detailProccess()
    {
        extract($_POST);

        if($photo == "") {
            execute("UPDATE `specialty` SET `specialty`=?,`specialtys`=? WHERE area = ?", [$specialty, $specialtys, $area]);
        } else {
            $data = explode(",", $base64);
            file_put_contents("./(웹디자인)선수제공파일/특산품/{$photo}", base64_decode($data[1]));
            execute("UPDATE `specialty` SET `img`=?, `specialty`=?, `specialtys`=? WHERE area = ?", [$photo, $specialty, $specialtys, $area]);
        }
        move("/admin_specialty", "특산품 정보가 수정되었습니다.");

    }
}