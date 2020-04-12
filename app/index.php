<?php
    $url = $_GET['url'];

    // リクエストヘッダ
    header('Content-type:application/json:charset=UTF-8');
    $header = array(
        "X-API-KEY: budGMh5oXhPN0HSXG4171wfD8fwtQ1gsEqDCkt62"
    );
    
    // HTTPコンテキスト
    $options = array('http' =>
        array(
            'method' => 'GET',
            'header' => implode("\r\n", $header),
        )
    );
    // JSONを取得
    $contents = file_get_contents($url, false, stream_context_create($options));
    echo json_encode($contents);
?>
