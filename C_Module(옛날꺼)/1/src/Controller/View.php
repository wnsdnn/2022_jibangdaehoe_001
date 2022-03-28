<?php
namespace src\Controller;

class View
{
    function main()
    {
        view("main");
    }

    function eventPage()
    {
        view("event");
    }

    function reviewPage()
    {
        view("review");
    }

    function reviewListPage()
    {
        view("reviewList");
    }

    function reviewTestPage()
    {
        view("reviewTest");
    }

    function specialtyPage()
    {
        $result = fetchAll("SELECT * FROM specialty_tbl");
        view("specialty", ["list" => $result]);
    }

    function adminSpecialtyPage()
    {
        if(!$_SESSION["admin"]) {
            back("관리자 권한이 필요합니다.");
            
            return;
        }
        $result = fetchAll("SELECT * FROM specialty_tbl");
        
        view("specialty_admin", ["list" => $result]);
    }

    function adminEventPage()
    {
        if(!$_SESSION["admin"]) {
            back("관리자 권한이 필요합니다.");

            return;
        }

        $result = fetchAll("SELECT * FROM event_tbl");

        view("event_admin", ["result" => $result]);
    }

    function detailPage()
    {
        extract($_GET);
        $result = fetch("SELECT * FROM specialty_tbl WHERE area = ?", [$area]);

        view("detail", ["result" => $result]);
    }

    function detailProcess()
    {
        extract($_POST);

        $src = explode(",", $src);
        $result = base64_decode($src[1]);
        
        $saveDir = "./img/".$name;
        file_put_contents($saveDir, $result);

        execute("UPDATE specialty_tbl SET specialty = ?, img = ? WHERE area = ?", [$specialty, $name, $area]);

        move("/specialty_admin", "특산품 정보가 수정되었습니다.");
    }

    function adminPage()
    {
        view("admin");
    }

    function adminProcess()
    {
        extract($_POST);

        if( $id == "admin" && $pass == "1234" ) {
            $_SESSION["admin"] = true;

            move("/", "관리자 권한이 부여 되었습니다.");
        }

        back("아이디 혹은 비밀번호가 일치하지 않습니다.");
    }

    function logout()
    {
        unset($_SESSION["admin"]);

        move("/", "로그아웃 되었습니다.");
    }
}   
