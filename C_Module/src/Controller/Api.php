<?php
namespace src\Controller;

class Api
{
    function eventApi()
    {
        header("HTTP/1.1 200 OK");
        header("Content-Type: application/json; charset= UTF-8");
        extract($_POST);
        $returnArr = (object) [];
        $returnArr->message = "이벤트에 참여해 주셔서 감사합니다.";
        $date = date("Y-m-d");

        if($score == "" || $name == "" || $tel == "") {
            header("HTTP/1.1 401");
            $returnArr->message = "오류가 발생했습니다. 다시 시도해 주세요.";
        }
        
        $dbCheck = fetch("SELECT * FROM `event` WHERE `tel` = ? AND `date` = ?", [$tel, $date]);

        if($dbCheck) {
            header("HTTP/1.1 401");
            $returnArr->message = "하루에 한번만 참여할 수 있습니다.";
        } else {
            $ydate = date("Y-m-d", strtotime($date."-1 day"));
            $ydbCheck = fetch("SELECT * FROM `event` WHERE `tel` = ? AND `date` = ?", [$tel, $ydate]);

            if($ydbCheck) {
                execute("INSERT INTO `event`(`name`, `tel`, `score`, `date`, `conDate`) VALUES (?, ?, ?, ?, ?)", [$name, $tel, $score, $date, $ydbCheck->conDate+1]);
            } else {
                execute("INSERT INTO `event`(`name`, `tel`, `score`, `date`, `conDate`) VALUES (?, ?, ?, ?, ?)", [$name, $tel, $score, $date, 1]);
            }
        }

        echo json_encode($returnArr);
    }

    function stampApi($args)
    {
        header("HTTP/1.1 200 OK");
        header("Content-Type: applcation/json; charset=UTF-8");

        $returnArr = (object) [];
        $tel = $args[1];

        if($tel === "") {
            header("HTTP/1.1 401");
            $returnArr->message = "오류가 발생했습니다. 다시 시도해 주세요";
        }

        $date = date("Y-m-d");
        $ydate = date("Y-m-d", strtotime($date."-1 day"));
        $ddbCheck = fetch("SELECT * FROM `event` WHERE `tel` = ? AND `date` = ?", [$tel, $date]);
        $ydbCheck = fetch("SELECT * FROM `event` WHERE `tel` = ? AND `date` = ?", [$tel, $ydate]);

        if($ydbCheck) {
            $count = $ydbCheck->conDate >= 2 ? 2 : $ydbCheck->conDate;
            $returnArr->stamps = [];
            for($i=$count; $i>=0; $i--) {
                $nowDate = date("Y-m-d", strtotime($date."-{$i} day"));
                array_push($returnArr->stamps, $nowDate);
            }
        } else if($ddbCheck) {
            $returnArr->stamps = [];
            array_push($returnArr->stamps, $ddbCheck->date);
        }
        if(!$ddbCheck && !$ydbCheck){
            header("HTTP/1.1 401");
            $returnArr->message = "출석정보가 없습니다.";
        }

        echo json_encode($returnArr);
    }

    function reviewApi() {
        header("HTTP/1.1 200 OK");
        header("Content-Type: applcation/json; charset=UTF-8");
        extract($_POST);
        $returnArr = (object) [];
        $returnArr->message = "구매 후기가 등록되었습니다.";

        if($name == "" || $product == "" || $shop == "" || $_POST["purchase-date"] == "" || $contents == "" || $score == "") {
            header("HTTP/1.1 401");
            $returnArr->message = "필수 입력값이 누락 되었습니다.";
        } else {
            $result = fetchAll("SELECT * FROM `review` order by `sn` desc");
            $sn = isset($result[0]) ? $result[0]->sn+1 : 1;
    
            $nameArr = [];
            foreach(json_decode($photoArr) as $item) {
                $imgName = $item->name;
                array_push($nameArr, ["imgName" => $imgName]);
                
                $src = explode(",", $item->url)[1];
                file_put_contents("./img/{$imgName}", base64_decode($src));
            }
            $exeResult = execute("INSERT INTO `review`(`sn`, `name`, `product`, `shop`, `purchase_date`, `contents`, `score`, `photo`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", [$sn, $name, $product, $shop, $_POST["purchase-date"], $contents, $score, json_encode($nameArr)]);
            if(!$exeResult) {
                header("HTTP/1.1 401");
                $returnArr->message = "오류가 발생했습니다. 다시 시도해 주세요.";
            }
        }
        
        echo json_encode($returnArr);
    }
}