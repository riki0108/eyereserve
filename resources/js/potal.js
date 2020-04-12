// ヘッダーのスライドショー
$(function(){
    $('.slider').slick({
        // 自動再生設定
        autoplay:true,
        // 自動再生のスライド切り替えの時間設定
        autoplaySpeed:5000,
        // インジゲーター表示
        dots:true,
    });
});


// 都道府県検索
function PreSearch(url){
    $.ajax({
        url:'/ph34/eyereserve/app/index.php?url='+url,
        data:{
            url:url
        },
        type:'GET',
        dataType:'json',
        success:function(data){
            console.log("都道府県検索成功");
            // 子要素を消去
            $("#pre").empty();            
            $("#area").empty();
            $('#pre').append($('<option>').val(0).html('選択してください'));
            $('#area').append($('<option>').val(0).html('市区'));
            var get_json = JSON.parse(data);
            // 値の加工・出力
            $.each(get_json['result'], function(i){
                $('#pre').append($('<option>').val(get_json['result'][i].prefCode).html(get_json['result'][i].prefName));
            });
        },
        error:function(XMLHttpRequest, textStatus, errorThrown){
            alert('error!!!');
        　　console.log("XMLHttpRequest : " + XMLHttpRequest.status);
        　　console.log("textStatus     : " + textStatus);
        　　console.log("errorThrown    : " + errorThrown.message);
        }
    });
};


// 市区検索
function CitySearch(url){
    $.ajax({
        url:'/ph34/eyereserve/app/index.php?url='+url,
        data:{
            url:url
        },
        type:'GET',
        dataType:'json',
        success:function(data){
            console.log("市区検索成功");
            // 子要素を消去
            $("#area").empty();
            $('#area').append($('<option>').val(0).html('選択してください'));
            var get_json = JSON.parse(data);
            // 値の加工・出力
            $.each(get_json['result'], function(i){
                $('#area').append($('<option>').val(get_json['result'][i].cityCode).html(get_json['result'][i].cityName));
            });
        },
        error:function(XMLHttpRequest, textStatus, errorThrown){
            alert('error!!!');
        　　console.log("XMLHttpRequest : " + XMLHttpRequest.status);
        　　console.log("textStatus     : " + textStatus);
        　　console.log("errorThrown    : " + errorThrown.message);
        }
    });
};
