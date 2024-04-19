<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>選課系統</title>
    <style>
        body {
            font-family: "Helvetica", "Arial","LiHei Pro","黑體-繁","微軟正黑體", sans-serif;
            background-color: #d3fbff;
            color: #333;
            margin: 0;
            padding: 0;
            animation-name:oxxo;
            animation-duration:1.5s;
            font-weight:bold;
        }

        .title {
            background-color: #4e72b8;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-weight:bold;
            font-size:20px;
        }

        .title button{
            background-color:#fff;
            color: #446938;
            font-weight:bold;
            font-size:14px;
            cursor: pointer;
            border: none;
            border-radius: 3px;
            animation-name:oxxo;
            transition: all 0.3s ease-in-out;
        }

        .title button:hover{
            transform: scale(1.1);
            opacity:1;
            -moz-transform: scale(1.1);
            -ms-transform: scale(1.1);
            -webkit-transfrom:scale(1.1);
            background-color: #afb4db;
        }

        @keyframes oxxo{
            from{
                opacity: 0;
                transform: translateY(-20px);
            }
            to{
                opacity: 1;
                transform: translateY(0);
            }
        }


        .timeTable {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            left:350px;
            position: relative;
            width:1100px;
        }

        table {
            width: 1100px;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout:fixed;
            word-wrap:break-word;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;

        }

        th {
            background-color: ;

        }

        .search {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width:300px;
            position:absolute;
            top:198px;
            left:0px;
        }

        .addSelection{
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width:300px;
            position:absolute;
            top:449px;
            left:0px;
        }

        .drop{
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width:300px;
            position:absolute;
            top:655px;
            left:0px;
        }

        input[type="text"], input[type="submit"] {
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            animation-name:oxxo;
            transition: all 0.3s ease-in-out;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
            font-weight:bold;

        }


        input[type="submit"]:hover {
            opacity:1;
            -moz-transform: scale(1.1);
            -ms-transform: scale(1.1);
            -webkit-transfrom:scale(1.1);
            transform: scale(1.1);
            background-color: #2980b9;
        }

        input type="submit"

        /*from internet*/

        *{
        box-sizing: border-box;
        }
        body {
        margin: 0;
        padding: 0;
        }

        .modal {
        position: absolute;
        z-index: 10;
        display: none;
        width: 100%;
        height: 100%;
        background: #6a6a6aa6;
        }

        .dialog {
        position: absolute;
        z-index: 11;
        /* 將對話框水平置中。 */
        left: 50%;
        transform: translate(-50%, 0%);
        top: -10px; /* 設定對話框的起始位置。 對話框滑動的距離與時間會影響淡入效果，可以自行嘗試調整。 */
        opacity: 0; /* 將對話框設為透明。 */
        display: none; /* 隱藏對話框。 */
        width: 90%; /* 對話框寬度。 */
        background: white;
        box-shadow: 2px 2px 8px 1px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        line-height: 1.7em;
        font-size: 16px;
        }

        .titleSearch {
        text-align: center;
        padding: 8px;
        font-size: 20px;
        background: #74905d;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        color: white;
        border: 1px #f2e6e6 solid;
        box-shadow: 0px 2px 8px 1px rgb(0 0 0 / 15%);
        }

        .content {
        padding: 4px 8px;

        }

        .buttons {
        text-align: right;
        padding: 8px 14px;
        }

        .cancelBtn {
            display: inline-block;
            background: #8e7437;
            color: #ffffffeb;
            border-radius: 8px;
            border: 1px solid white;
            padding: 4px 8px;
            cursor: pointer;
            position:absolute;
            top:5px;
            right:10px;
            width:40px;
            text-align: center;
            border:none;
            font-size:20px;
        }

        .cancelBtn:hover{
            opacity:1;
            -moz-transform: scale(1.1);
            -ms-transform: scale(1.1);
            -webkit-transfrom:scale(1.1);
            transform: scale(1.1);
        }

    </style>
</head>

    <body>
        <div class="title">
            <h1>選課系統</h1>
            <?php
            echo "<p>" . "目前登入帳號為: <strong style=' font-size: 20px; border-bottom: 2px solid white;'> " . $_SESSION["name"] . "</strong></p>";
            ?>
            <a href="php/logout.php"> <button>登出</button> </a>
        </div>

        <div class="timeTable">
            <?php
            echo "<p>" . "已選學分數:" . $_SESSION["credit"] . "</p>";
            ?>
            <table border="1">
                <tr>
                    <td></td>
                    <td>星期一</td>
                    <td>星期二</td>
                    <td>星期三</td>
                    <td>星期四</td>
                    <td>星期五</td>
                </tr>
                <tr>
                    <td>1<br>08:10~9:00</td>
                    <td id="1"></td>
                    <td id="15"></td>
                    <td id="29"></td>
                    <td id="43"></td>
                    <td id="57"></td>
                </tr>
                <tr>
                    <td>2<br>09:10~10:00</td>
                    <td id="2"></td>
                    <td id="16"></td>
                    <td id="30"></td>
                    <td id="44"></td>
                    <td id="58"></td>
                </tr>
                <tr>
                    <td>3<br>10:10~11:00</td>
                    <td id="3"></td>
                    <td id="17"></td>
                    <td id="31"></td>
                    <td id="45"></td>
                    <td id="59"></td>
                </tr>
                <tr>
                    <td>4<br>11:10~12:00</td>
                    <td id="4"></td>
                    <td id="18"></td>
                    <td id="32"></td>
                    <td id="46"></td>
                    <td id="60"></td>
                </tr>
                <tr>
                    <td>5<br>12:10~13:00</td>
                    <td id="5"></td>
                    <td id="19"></td>
                    <td id="33"></td>
                    <td id="47"></td>
                    <td id="61"></td>
                </tr>
                <tr>
                    <td>6<br>13:10~14:00</td>
                    <td id="6"></td>
                    <td id="20"></td>
                    <td id="34"></td>
                    <td id="48"></td>
                    <td id="62"></td>
                </tr>
                <tr>
                    <td>7<br>14:10~15:00</td>
                    <td id="7"></td>
                    <td id="21"></td>
                    <td id="35"></td>
                    <td id="49"></td>
                    <td id="63"></td>
                </tr>
                <tr>
                    <td>8<br>15:10~16:00</td>
                    <td id="8"></td>
                    <td id="22"></td>
                    <td id="36"></td>
                    <td id="50"></td>
                    <td id="64"></td>
                </tr>
                <tr>
                    <td>9<br>16:10~17:00</td>
                    <td id="9"></td>
                    <td id="23"></td>
                    <td id="37"></td>
                    <td id="51"></td>
                    <td id="65"></td>
                </tr>
                <tr>
                    <td>10<br>17:10~18:00</td>
                    <td id="10"></td>
                    <td id="24"></td>
                    <td id="38"></td>
                    <td id="52"></td>
                    <td id="66"></td>
                </tr>
                <tr>
                    <td>11<br>18:30~19:20</td>
                    <td id="11"></td>
                    <td id="25"></td>
                    <td id="39"></td>
                    <td id="53"></td>
                    <td id="67"></td>
                </tr>
                <tr>
                    <td>12<br>19:25~20:15</td>
                    <td id="12"></td>
                    <td id="26"></td>
                    <td id="40"></td>
                    <td id="54"></td>
                    <td id="68"></td>
                </tr>
                <tr>
                    <td>13<br>20:25~21:15</td>
                    <td id="13"></td>
                    <td id="27"></td>
                    <td id="41"></td>
                    <td id="55"></td>
                    <td id="69"></td>
                </tr>
                 <tr>
                    <td>14<br>21:20~22:10</td>
                    <td id="14"></td>
                    <td id="28"></td>
                    <td id="42"></td>
                    <td id="56"></td>
                    <td id="70"></td>
                </tr>
            </table>
            <?php include $_SERVER["DOCUMENT_ROOT"] . "/db_topic1/php/courseTable.php"; ?>
        </div>

        <div class="search">
            <p>搜尋課程：</p>
            <form id="search" action="php/search.php" method="POST">
                <p>課程名稱：<input id="pattern" type="text" name="pattern"></p>
                <input type="hidden" name="search">
                <input type="submit" class="searchSubmit" value="送出">
            </form>
            <form id="list" action="php/list.php" method="post">
                <input type="hidden" name="list">
                <input type="submit" class="listSubmit" value="列出可選課程清單">
            </form>
        </div>

        <div class="addSelection">
            <p>加選課程：</p>
            <form action="php/addSelection.php" method="post">
                <p>課程代號：<input type="text" name="cid"></p>
                <input type="hidden" name="addSelection">
                <input type="submit" value="送出">
            </form>
        </div>

        <div class="drop">
            <p>退選/取消關注：</p>
            <form action="php/drop.php" method="post">
                <p>課程代號：<input type="text" name="cid"></p>
                <input type="hidden" name="drop">
                <input type="submit" value="送出">
            </form>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <div class="dialog">
            <div class="titleSearch">課程搜尋</div>
            <div class="content">
            <div id="searchResult"></div>

            <div class="buttons">
                <div class="cancelBtn">關閉</div>
            </div>
        </div>

        <script>
            $(".searchSubmit").click(function () {
                if($("#pattern").val().length > 0) {
                    //$(".modal").css("display", "block"); // 顯示modal，遮住畫面背景。
                    $(".dialog").css("display", "block"); // 顯示dialog。

                    $(".dialog").animate({
                        opacity: '1',
                        top: '50px' // 決定對話框要滑到哪個位置停止。
                    }, 550);
                }
            });

            $(".listSubmit").click(function () {
                //$(".modal").css("display", "block"); // 顯示modal，遮住畫面背景。
                $(".dialog").css("display", "block"); // 顯示dialog。

                $(".dialog").animate({
                    opacity: '1',
                    top: '50px' // 決定對話框要滑到哪個位置停止。
                }, 550);
            });

            $(".cancelBtn").click(function () {
                $(".dialog").animate({
                    opacity: '0',
                    top: '-50px' // 需與CSS設定的起始位置相同，以保證下次彈出視窗的效果相同。
                }, 350, function () {
                    // 此區塊為callback function，會在動畫結束時被呼叫。
                    $(".modal").css("display", "none"); // 隱藏modal。
                    $(".dialog").css("display", "none"); // 隱藏dialog。
                });
            });


            $("#search").submit(function(event) {
                event.preventDefault(); // Prevent default action
                var post_url = $(this).attr("action"); // Get form action URL
                var request_method = $(this).attr("method"); // Get form GET/POST method
                var form_data = new FormData(this); // Creates new FormData object
                $.ajax({
                    url: post_url,
                    type: request_method,
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false
                }).done(function (response) { //
                    $("#searchResult").html(response);
                });
            });

            $("#list").submit(function(event){
                event.preventDefault(); // Prevent default action
                var post_url = $(this).attr("action"); // Get form action URL
                var request_method = $(this).attr("method"); // Get form GET/POST method
                var form_data = new FormData(this); // Creates new FormData object
                $.ajax({
                    url : post_url,
                    type: request_method,
                    data : form_data,
                    contentType: false,
                    cache: false,
                    processData: false
                }).done(function(response){ //
                    $("#searchResult").html(response);
                });
            });
        </script>
    </body>
</html>