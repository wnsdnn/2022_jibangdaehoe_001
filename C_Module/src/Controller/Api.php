<?php
namespace src\Controller;

class Api
{
    function eventApi()
    {
        header("HTTP/1.1 200 OK");
        header("Content-Type: application/json; charset=UTF-8");
        extract($_POST);
        $returnArr = (object) [];
        $returnArr->message = "이벤트에 참여해 주셔서 감사합니다.";
        
        $date = date("Y-m-d");
        $dbCheck = fetch("SELECT * FROM `event` WHERE `tel` = ? AND `date` = ?", [$tel, $date]);
        $userCheck = fetch("SELECT * FROM `event` WHERE `tel` = ?", [$tel]);
        
        if($name == "" || $tel == "" || $score == "") {
            header("HTTP/1.1 401 OK");
            $returnArr->message = "오류가 발생했습니다. 다시 시도해 주세요";
        }
        if($userCheck && $name != $userCheck->name){
            header("HTTP/1.1 401 OK");
            $returnArr->message = "오류가 발생했습니다. 다시 시도해 주세요";
        } else {
            if($dbCheck) {
                header("HTTP/1.1 401 OK");
                $returnArr->message = "하루에 한번만 참여할 수 있습니다";
            } else {
                $ydate = date("Y-m-d", strtotime($date."-1 day"));
                $yCheck = fetch("SELECT * FROM `event` WHERE `tel` = ? AND `date` = ?", [$tel, $ydate]);
    
                if($yCheck) {
                    execute("INSERT INTO `event`(`name`, `tel`, `date`, `conDate`, `score`) VALUES (?, ?, ?, ?, ?)", [$name, $tel, $date, $yCheck->conDate + 1, $score]);
                } else {
                    execute("INSERT INTO `event`(`name`, `tel`, `date`, `conDate`, `score`) VALUES (?, ?, ?, ?, ?)", [$name, $tel, $date, 1, $score]);
                }
            }
        }

        echo json_encode($returnArr);
    }

    function stampsApi($args)
    {
        header("HTTP/1.1 200 OK");
        header("Content-Type: application/json; charset=UTF-8");
        $tel = $args[1];
        $returnArr = (object) [];

        $date = date("Y-m-d");
        $ydate = date("Y-m-d", strtotime($date."-1 day"));
        $ydateInfo = fetch("SELECT * FROM `event` WHERE `tel` = ? AND `date` = ?", [$tel, $ydate]);
        
        if(!isset($args[1]) || $tel == "") {
            $returnArr->message = "오류가 발생했습니다. 다시 시도해 주세요.";
        } else {
            if($ydateInfo) {
                $count = $ydateInfo->conDate >= 2 ? 2 : intval($ydateInfo->conDate);
                $arr = [];
                for($i=$count; $i>=0; $i--) {
                    array_push($arr, date("Y-m-d", strtotime($date."-{$i} day")) );
                }
                $returnArr->stamps = $arr;
            } else {
                $returnArr->message = "출석정보가 없습니다.";
                $returnArr->stamps = [$date];
            }
        }


        echo json_encode($returnArr);
    }



}






