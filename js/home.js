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