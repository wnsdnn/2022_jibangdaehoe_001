<?php
namespace src\Controller;

class Event
{
    function eventApi()
    {
        extract($_POST);

        header("HTTP/1.1 200 OK");
        header("Content-Type: application/json; charset=UTF-8");

        $returnArr = (object) ["message" => "이벤트에 참여해 주셔서 감사합니다."];
        $date = date("Y-m-d");

        $resultDB = fetch("SELECT * FROM event_tbl WHERE tel = ? AND date = ?", [$phone, $date]);

        if($resultDB) {
            header("HTTP/1.1 401 OK");
            $returnArr->message = "하루에 한번만 참여할 수 있습니다.";
        } else {
            $ydate = date("Y-m-d", strtotime($date."-1 day"));
            $checkDate = fetch("SELECT conDate FROM event_tbl WHERE tel = ? AND date = ?", [$phone, $ydate]);

            if($checkDate) {
                execute("INSERT INTO event_tbl VALUES(?, ?, ?, ?, ?)", [$name, $phone, $score, $date, $checkDate->conDate+1]);
            } else {
                execute("INSERT INTO event_tbl VALUES(?, ?, ?, ?, ?)", [$name, $phone, $score, $date, '1']);
            }
        }
        
        echo json_encode($returnArr);
    }

    function eventTelApi($args)
    {
        header("HTTP/1.1 200 OK");
        header("Content-Type: application/json; charset=UTF-8");

        $tel = $args[1];
        $date = date("Y-m-d");
        $result = fetch("SELECT * FROM event_tbl WHERE tel = ? ORDER BY date DESC", [$tel]);
        
        $returnArr = (object) ["stamps" => []];
        if($result) {
            $lastconDate = $result->conDate;
            for($i = $lastconDate; $i >= 1; $i--) {
                $day = $i-1;
                $ydate = date("Y-m-d", strtotime(date("Y-m-d"). "-$day day"));
                $date = fetch("SELECT date FROM event_tbl WHERE tel = ? AND date = ?", [$tel, $ydate]);

                $arr = $returnArr->stamps;
                array_push($arr, $date->date);
                
                $returnArr->stamps = $arr;
            }
        } else {
            $returnArr->message = "출석정보가 없습니다.";
        }

        echo json_encode($returnArr);

    }

    function reviewsApi()
    {
        header("HTTP/1.1 200 OK");
        header("Content-Type: application/json; charset=UTF-8");
        extract($_POST);
        
        $returnArr = (object) [];

        if( $name == "" || $product == "" || $shop == "" || $_POST["purchase-date"] == "" || $contents == "" || $score == "" ) {
            $returnArr->message = "필수 입력값이 누락 되었습니다.";
        } else {
            $result = fetchAll("SELECT * FROM `review_tbl` order by `key` desc");
            $key = isset($result[0]) ? $result[0]->key+1 : 1;
            $returnArr->key = $result;
            
            $nameArr = [];
            
            foreach(json_decode($imgArr) as $item) {
                array_push($nameArr, ["url" => $item->name]); // array에 이미지 이름 추가
                
                $src = explode(",", $item->url);
                $result = base64_decode($src[1]);
                
                $saveDir = "./img/".$item->name;
                file_put_contents($saveDir, $result);
            }
            
            execute("INSERT INTO `review_tbl`(`key`, `name`, `product`, `shop`, `purchase-date`, `contents`, `score`, `photo`) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ", [$key, $name, $product, $shop, $_POST["purchase-date"], $contents, $score, json_encode($nameArr)]);
            $returnArr->message = "구매 후기가 등록되었습니다.";
        }


        echo json_encode($returnArr);

    }

    function reviewListApi()
    {
        header("HTTP/1.1 200 OK");
        header("Content-type: application/json; charset=UTF-8");

        $key = isset($_GET["last-key"]) ? $_GET["last-key"] : 0;
        $returnArr = (object) ["reviews" => []];

        $count = fetch("SELECT count(*) as count FROM review_tbl WHERE `key` <= ?", [$key]);
        $list = fetchAll("SELECT * FROM review_tbl limit {$count->count}");
    
        for($i = count($list)-1; $i >= 0; $i--) {
            $arr = $returnArr->reviews;
            array_push($arr, $list[$i]);
            
            $photos = json_decode($list[$i]->photo);
            $urlobj = reset($photos) ? reset($photos)->url : "";
            $list[$i]->photo = $urlobj;

            $returnArr->reviews = $arr;
        }

        echo json_encode($returnArr);

    }

    function reviewDetailApi($args)
    {
        header("HTTP/1.1 200 OK");
        header("Content-type: application/json; charset=UTF-8");
        $key = $args[1];
        $result = fetch("SELECT * FROM review_tbl WHERE `key` = ?", [$key]);
        $resultArr = (array) $result;

        if($result) {
            $returnArr = (object) ["purchase-date" => $resultArr["purchase-date"]];
            $returnArr->name = $result->name;
            $returnArr->product = $result->product;
            $returnArr->shop = $result->shop;
            $returnArr->contents = $result->contents;
            $returnArr->score = $result->score;
            $returnArr->photos = json_decode($result->photo);
            echo json_encode($returnArr);
        } else {
            $returnArr = (object) ["message" => "구매 후기를 찾을 수 없습니다."];
            echo json_encode($returnArr);
        }

    }

}




