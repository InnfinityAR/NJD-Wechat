<?php

/*
 *  Copyright (c) 2014 The CCP project authors. All Rights Reserved.
 *
 *  Use of this source code is governed by a Beijing Speedtong Information Technology Co.,Ltd license
 *  that can be found in the LICENSE file in the root of the web site.
 *
 *   http://www.yuntongxun.com
 *
 *  An additional intellectual property rights grant can be found
 *  in the file PATENTS.  All contributing project authors may
 *  be found in the AUTHORS file in the root of the source tree.
 */

include_once("CCPRestSmsSDK.php");
// 初始化REST SDK
global $accountSid, $accountToken, $appId, $serverIP, $serverPort, $softVersion;


//徐鑫测试账号
$accountSid = "aaf98f895335f2be01533b0d8af909de";
$accountToken = "13def111556942bd904e76135b3c928f";
$appId = '8a48b5515388ec150153bb062ed04c0f';

$serverIP = 'sandboxapp.cloopen.com';
//        说明：请求地址。
//        沙盒环境配置成sandboxapp.cloopen.com，
//        生产环境配置成app.cloopen.com。
$serverPort = '8883';
//        说明：请求端口 ，无论生产环境还是沙盒环境都为8883.
$softVersion = '2013-12-26';

/**
 * 发送模板短信
 * @param to 手机号码集合,用英文逗号分开
 * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
 * @param $tempId 模板Id,测试应用和未上线应用使用测试模板请填写1，正式应用上线后填写已申请审核通过的模板ID
 */
function sendTemplateSMS($to, $datas, $tempId) {
    $rest = new REST($GLOBALS['serverIP'], $GLOBALS['serverPort'], $GLOBALS['softVersion']);
    $rest->setAccount($GLOBALS['accountSid'], $GLOBALS['accountToken']);
    $rest->setAppId($GLOBALS['appId']);

    // 发送模板短信
    echo "Sending TemplateSMS to $to <br/>";
    $result = $rest->sendTemplateSMS($to, $datas, $tempId);
    if ($result == NULL) {
//        echo "result error!";
        return;
    }
    if ($result->statusCode != 0) {
//        echo "error code :" . $result->statusCode . "<br>";
//        echo "error msg :" . $result->statusMsg . "<br>";
        //TODO 添加错误处理逻辑
    } else {
//        echo "Sendind TemplateSMS success!<br/>";
        // 获取返回信息
//        $smsmessage = $result->TemplateSMS;
//        echo "dateCreated:" . $smsmessage->dateCreated . "<br/>";
//        echo "smsMessageSid:" . $smsmessage->smsMessageSid . "<br/>";
        //TODO 添加成功处理逻辑
    }
}

//Demo调用 
//**************************************举例说明***********************************************************************
//*假设您用测试Demo的APP ID，则需使用默认模板ID 1，发送手机号是13800000000，传入参数为6532和5，则调用方式为           *
//*result = sendTemplateSMS("13800000000" ,array('6532','5'),"1");																		  *
//*则13800000000手机号收到的短信内容是：【云通讯】您使用的是云通讯短信模板，您的验证码是6532，请于5分钟内正确输入     *
//*********************************************************************************************************************
//sendTemplateSMS("",array('',''),"");//手机号码，替换内容数组，模板ID
?>
