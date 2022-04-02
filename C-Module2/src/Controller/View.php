<?php
namespace src\Controller;

class View
{
    function indexPage()
    {
        view("index");
    }

    function sub1Page()
    {
        $result = fetchAll('SELECT * FROM specialty');
        view("sub1", ["list" => $result]);
    }

    function sub2Page()
    {
        view("sub2");
    }

    function sub3Page()
    {
        $key = fetchAll("SELECT * FROM `review` ORDER BY `key` DESC");
        view("sub3", ["key" => $key[0]->key]);
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
        back("아이디 혹은 비밀번호가 일치하지 않습니다.");
    }

    
    function adminSpecialtyPage()
    {
        if(!isset($_SESSION["admin"])) {
            back("관리자 권한이 필요합니다.");
        }
        $result = fetchAll("SELECT * FROM specialty");
        view("admin_specialty", ["list" => $result]);
    }

    function detailPage()
    {
        $result = fetch("SELECT * FROM specialty WHERE area = ?", [$_GET["area"]] );

        view("detail", ["result"=> $result]);
    }

    function detailProccess()
    {
        extract($_POST);

        $default = fetch('SELECT * FROM specialty WHERE area = ?', [$area]);

        if($photo == "") {
            execute("UPDATE specialty SET img = ?, specialty = ?, specialtys = ? WHERE area = ?", [$default->img, $specialty, $specialtys, $area]);
        } else {
            execute("UPDATE specialty SET img = ?, specialty = ?, specialtys = ? WHERE area = ?", [$photo, $specialty, $specialtys, $area]);
            $data = explode(",", $base64)[1];
            file_put_contents("./(웹디자인)선수제공파일/특산품/{$photo}", base64_decode($data));
        }

        move("/admin_specialty", "정보가 수정되었습니다.");

    }
    
    function adminEventPage()
    {
        if(!isset($_SESSION["admin"])) {
            back("관리자 권한이 필요합니다.");
        }

        $list = fetchAll("SELECT * FROM `event`");
        view("admin_event", ["list" => $list]);
    }
}
