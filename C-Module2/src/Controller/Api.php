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
        
        if( $tel == "" || $name == "" || $score == "" ) {
            header("HTTP/1.1 401 OK");
            $returnArr->message = "오류가 발생했습니다. 다시 시도해 주세요.";
        } else {
            $dbCheck = fetch("SELECT * FROM `event` WHERE `date` = ? AND 'tel'= ?",[$date, $tel]);
            
            if($dbCheck) {
                // 있을때
                header("HTTP/1.1 401 OK");
                $returnArr->message = "하루에 한번만 참여할 수 있습니다.";
            } else {
                // 없을때
                execute("INSERT INTO `event`(`name`, `tel`, `date`, `conDate`, `score`) VALUES (?, ?, ?, ?, ?)", [$name, $tel, $date, 1, $score]);
            }

        }

        echo json_encode($returnArr);
    }

    function stampApi($args)
    {
        header("HTTP/1.1 200 OK");
        header("Content-Type: application/json; charset=UTF-8");
        $returnArr = (object) [];
        $tel = isset($args[1]) ? $args[1] : false;
        $date = date("Y-m-d");
        $ydate = date("Y-m-d", strtotime($date."-1 day"));

        if(!$tel) {
            // 전화번호가 url로 안 넘어 왔을때
            header("HTTP/1.1 401 OK");
            $returnArr->message = "오류가 발생했습니다. 다시 시도해 주세요";
        } else {
            // 전화번호가 넘어 왔을때
            $ydbCheck = fetch("SELECT * FROM `event` WHERE `date` = ? AND `tel` = ?", [$ydate, $tel]);
            if($ydbCheck) {
                // 어제 데이터값이 있을때
                $count = $ydbCheck->conDate >= 2 ? 2 : $ydbCheck->conDate;
                $returnArr->stamps = [];
                for($i = $count; $i >= 0; $i--) {
                    $newDate = date("Y-m-d", strtotime($date."-{$i} day"));
                    array_push($returnArr->stamps, $newDate);
                }
            } else {
                // 어베 데이터값이 없을때
                $lastData = fetch("SELECT * FROM `event` WHERE `tel` = ?", [$tel]);
                if(!$lastData) {
                    // 데이터가 단 1개도 없을 때
                    header("HTTP/1.1 404 OK");
                    $returnArr->message = "출석정보가 없습니다.";
                } else {
                    // 데이터가 단 1개라도 있을 때
                    $returnArr->stamps = [$lastData->date];
                }
            }
        }

        echo json_encode($returnArr);
    }

    function reviewsApi() {
        header("HTTP/1.1 200 OK");
        header("Content-Type: apllication/json; charset=UTF-8");
        extract($_POST);
        $returnArr = (object) [];

        if( $name == "" || $product == "" || $shop == "" || $_POST["purchase-date"] == "" || $contents == "" || $score == "" ) {
            header("HTTP/1.1 401");
            $returnArr->message = "필수 입력값이 누락 되었습니다.";
        } else {
            $default = fetchAll("SELECT * FROM `review` ORDER BY `key` DESC");
            $key = isset($default[0]->key) ? $default[0]->key+1 : 1;
            $nameArr = [];
            foreach( json_decode($photos) as $p )
            {
                array_push($nameArr, "{$key}_{$p->name}");
                $data = explode(",", $p->img);
                file_put_contents("./reviewimg/{$key}_{$p->name}", base64_decode($data[1]));
            }
            $result = execute("INSERT INTO `review`(`key`, `name`, `product`, `shop`, `date`, `content`, `score`, `photos`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            [$key, $name, $product, $shop, $_POST["purchase-date"], $contents, $score, json_encode($nameArr)]);

            if($result) {
                $returnArr->message = "구매 후기가 등록되었습니다.";
            } else {
                header("HTTP/1.1 401");
                $returnArr->message = "오류가 발생했습니다. 다시 시도해 주세요.";
            }

        }

        echo json_encode($returnArr);
    }

    function reviewList() {
        header("HTTP/1.1 200 OK");
        header("Content-Type: apllication/json; charset=UTF-8");
        $returnArr = (object) [];
        $key = $_GET["last-key"];

        $list = fetchAll("SELECT * FROM `review` WHERE `key` <= ? ORDER BY `date` DESC", [$key]);

        if(count($list)) {
            $returnArr->reviews = [];
            foreach($list as $item) {
                $arr = (object) [
                    "key" => $item->key,
                    "name" => $item->name,
                    "product" => $item->product,
                    "shop" => $item->shop,
                    "purchase-date" => $item->date,
                    "contents" => mb_substr($item->content, 1, 50, "UTF-8"),
                    "score" => $item->score,
                    "photo" => json_decode($item->photos)[0]
                ];
                array_push($returnArr->reviews, $arr);
            }
        } else {
            $returnArr->message = "오류가 발생했습니다. 다시 시도해 주세요.";
        }

        echo json_encode($returnArr);
    }
}
