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
        $result = fetchAll("SELECT * FROM specialty");

        view("sub1", ["list" => $result]);
    }

    function sub2Page()
    {
        view("sub2");
    }

    function sub3Page()
    {
        view("sub3");
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
            move("/", "관리자 권한이 부여 되었습니다.");
        }

        back("아이디 혹은 비밀번호가 다릅니다.");
    }

    function detailPage()
    {
        extract($_GET);
        $result = fetch("SELECT * FROM specialty WHERE area = ?", [$area]);
        
        view("detail", ["info" => $result]);
    }

    function detailProccess()
    {
        extract($_POST);
        $default = fetch("SELECT * FROM specialty WHERE area = ?", [$area]);

        if($imgUrl != "") {
            $data = explode(",", $imgUrl)[1];
            file_put_contents("./(웹디자인)선수제공파일/특산품/{$photo_name}", base64_decode($data));
        }
        
        if($photo_name == "") {
            execute("UPDATE `specialty` SET `img` = ?, `specialty` = ? WHERE area = ?", [$default->img, $specialty, $area]);
        } else {
            execute("UPDATE `specialty` SET `img` = ?, `specialty` = ? WHERE area = ?", [$photo_name, $specialty, $area]);
        }

        $result = fetch("SELECT * FROM specialty WHERE area = ?", [$area]);
        
        move("/admin_specialty", "정보가 수정되었습니다.");
    }

    function adminSpecialtyPage()
    {
        if(!isset($_SESSION["admin"])){
            back("관리자 권한이 필요합니다.");
        }
        $result = fetchAll("SELECT * FROM specialty");

        view("admin_specialty", ["list" => $result]);
    }
    
    function adminEventPage()
    {
        if(!isset($_SESSION["admin"])){
            back("관리자 권한이 필요합니다.");
        }
        $result = fetchAll("SELECT * FROM `event`");
        view("admin_event", ["list" => $result]);
    }
}