<?php
namespace src\Controller;

class Api
{
    function reviewApi()
    {
        header("HTTP/1.1 200 OK");
        header("Content-Type: application/json; charset=UTF-8");
        extract($_POST);
        $returnArr = (object) [];

        $default = fetchAll("SELECT * FROM `review` ORDER BY `key` DESC");
        $key = $default ? $default[0]->key+1 : 1;
        $returnArr->key = $key;

        if($name == "" || $product == "" || $shop == "" || $_POST["purchase-date"] == "" || $contents == "" || $score == "") {
            header("HTTP/1.1 401");
            $returnArr->message = "필수 입력값이 누락 되었습니다.";
        } else {
            $nameArr = [];
            foreach(json_decode($photoArr) as $p) {
                array_push($nameArr, "{$key}_{$p->name}");
                $data = explode(",", $p->img);

                file_put_contents("./reviewImg/{$key}_{$p->name}", base64_decode($data[1]));
            }
            $result = execute("INSERT INTO `review`(`key`, `name`, `product`, `shop`, `date`, `contents`, `score`, `photos`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            [$key, $name, $product, $shop, $_POST["purchase-date"], $contents, $score, json_encode($nameArr)]);

            if($result) {
                $returnArr->message = "구매후기가 등록되었습니다.";
            } else {
                header("HTTP/1.1 401");
                $returnArr->message = "오류가 발생했습니다. 다시 시도해 주세요";
            }
        }
        $returnArr->post = $_POST;

        echo json_encode($returnArr);
    }

    function reviewListApi()
    {
        header("HTTP/1.1 200 OK");
        header("Content-Type: application/json; charset=UTF-8");
        $returnArr = (object) [];
        $key = $_GET["last-key"];

        $default = fetchAll("SELECT * FROM `review` WHERE `key` <= ? ORDER BY `date` DESC limit 10",[$key]);

        if($key <= -1) {
            header("HTTP/1.1 401");
            $returnArr->message = "오류가 발생했습니다. 다시 시도해 주세요.";
        } else {
            $returnArr->reviews = [];
            foreach($default as $item) {
                $arr = (object) [
                    "key" => $item->key,
                    "name" => $item->name,
                    "product" => $item->product,
                    "shop" => $item->shop,
                    "purchase-date" => $item->date,
                    "contents" => mb_substr($item->contents, 1, 50, "UTF-8"),
                    "score" => $item->score,
                    "photo" => json_decode($item->photos)[0]
                ];
                array_push($returnArr->reviews, $arr);
            }
        }

        echo json_encode($returnArr);
    }

    function reviewDetailApi($args)
    {
        header("HTTP/1.1 200 OK");
        header("Content-Type: application/json; charset=UTF-8");
        $key = $args[1];
        
        $result = fetch("SELECT * FROM `review` WHERE `key` = ?",[$key]);
        
        if($result) {
            $photoArr = [];
            foreach(json_decode($result->photos) as $p) {
                array_push($photoArr, (object) ["file" => $p]);
            }
            $returnArr = (object) [
                "name" => $result->name,
                "product" => $result->product,
                "shop" => $result->shop,
                "purchase-date" => $result->date,
                "contents" => $result->contents,
                "score" => $result->score,
                "photos" => $photoArr,
            ];
            echo json_encode($returnArr);
        } else {
            header("HTTP/1.1 404");
            $returnArr = (object) [];
            $returnArr->message = "구매 후기를 찾을 수 없습니다.";
            echo json_encode($returnArr);
        }

    }

    function eventApi()
    {
        header("HTTP/1.1 200 OK");
        header("Content-Type: application/json; charset=UTF-8");
        $returnArr = (object) [];
        extract($_POST);
        $date = date("Y-m-d");

        if( $name == "" || $tel == "" || $score == "" ){
            header("HTTP/1.1 401");
            $returnArr->message = "오류가 발생했습니다. 다시 시도해 주세요";
        } else {
            $dbCheck = fetch("SELECT * FROM `event` WHERE `tel` = ? AND `date` = ?", [$tel, $date]);
            
            if($dbCheck) {
                header("HTTP/1.1 401");
                $returnArr->message = "하루에 한번만 참여할 수 있습니다.";
            } else {
                $ydate = date("Y-m-d", strtotime($date."-1 day"));
                $ydbChange = fetch("SELECT * FROM `event` WHERE `tel` = ? AND `date` = ?", [$tel, $ydate]);
                if($ydbChange) {
                    execute("INSERT INTO `event`(`name`, `tel`, `date`, `score`, `conDate`) VALUES (?, ?, ?, ?, ?)", [$name, $tel, $date, $score, $ydbChange->conDate+1]);
                } else {
                    execute("INSERT INTO `event`(`name`, `tel`, `date`, `score`, `conDate`) VALUES (?, ?, ?, ?, ?)", [$name, $tel, $date, $score, 1]);
                }
                $returnArr->message = "이벤트에 참여해 주셔서 감사합니다.";
            }
        }

        echo json_encode($returnArr);
    }

    function stampApi($args)
    {
        header("HTTP/1.1 200 OK");
        header("Content-Type: application/json; charset=UTF-8");
        $returnArr = (object) [];
        $tel = $args[1];
        $date = date("Y-m-d");
        
        if( $tel == "" ) {
            header("HTTP/1.1 200 OK");
            $returnArr->message = "오류가 발생했습니다.";
        } else {
            $result = fetchAll("SELECT * FROM `event` WHERE `tel` = ? ORDER BY `date` DESC", [$tel]);
            if(!$result) {
                header("HTTP/1.1 404");
                $returnArr->message = "출석정보가 없습니다.";
            } else {
                $count = $result[0]->conDate >= 3 ? 3 : $result[0]->conDate;
                
                $returnArr->stamps = [];
                $ydate = $result[0]->date;
                for($i = $count-1; $i >= 0; $i--) {
                    $yydate = date("Y-m-d", strtotime($ydate."-{$i} day"));
                    array_push($returnArr->stamps, $yydate);
                }
            }
        }

        echo json_encode($returnArr);
    }
}