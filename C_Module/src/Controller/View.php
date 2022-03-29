<?php
namespace src\Controller;

class View
{
    
    function main()
    {
        view("main");
    }
    
    function sub1()
    {
        $result = fetchAll("SELECT * FROM specialty");
        view("sub1", ["list" => $result]);
    }
    
    function sub2()
    {
        view("sub2");
    }
    
    function sub3()
    {
        view("sub3");
    }
    
    function adminPage()
    {
        view("admin");
    }

    function detailPage()
    {
        $result = fetch("SELECT * FROM specialty WHERE area = ?", [$_GET["area"]]);

        view("detail", ["item" => $result]);
    }

    function detailProccess()
    {
        extract($_POST);

        $result = fetch("SELECT * FROM specialty WHERE area = ?", [$area]);

        if(isset($photo)) {
            $data = explode(",", $base64)[1];
            file_put_contents("./(웹디자인)선수제공파일/특산품/{$photo}", base64_decode($data));
            execute("UPDATE specialty SET `imgName` = ?, `specialty` = ? WHERE `area` = ?", [$photo, $specialty, $area]);
        } else {
            execute("UPDATE specialty SET `imgName` = ?, `specialty` = ? WHERE `area` = ?", [$result->imgName, $specialty, $area]);
        }

        move("/admin_specialty", "정보가 수정되었습니다.");
    }
    
    function adminEventPage()
    {
        if(!isset($_SESSION["admin"])) {
            back("관리자 권한이 필요합니다.");
        }
        view("admin_event");
    }
    
    function adminSpacialtyPage()
    {
        if(!isset($_SESSION["admin"])) {
            back("관리자 권한이 필요합니다.");
        }

        $result = fetchAll("SELECT * FROM specialty");
        view("admin_specialty", ["list" => $result]);
    }
    
    function adminProccess()
    {
        extract($_POST);

        if($id === "admin" && $pass === "1234") {
            $_SESSION["admin"] = true;
            move("/", "관리자 권한이 부여되었습니다.");
        }

        back("아이디 혹은 비밀번호가 일치하지 않습니다.");
    }

}
