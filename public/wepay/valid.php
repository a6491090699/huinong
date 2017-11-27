<?php
/**
*
*/
class WechatValid
{

	/**
     * @FunctionDescription:验证开发者服务器url有效性
     * @Param:token(令牌 用户手动输入的配置信息)
     * @Return:echostr（随机字符串）
     * @Description:
     * @Author:helen zheng
     */
    public function valid($token){
        $echostr = $_GET['echostr'];
        if($this->checkSignature($token)){
            echo $echostr;
            exit;
        }
    }

     /**
     * @FunctionDescription:检验signature函数
     * @Param:token(令牌 用户手动输入的配置信息)
     * @Return:true/false
     * @Description:微信服务器发送get请求将signature、timestamp、nonce、echostr四个参数发送到开发者提供的url，利用接收到的参数进行验证。
     * @Author:helen zheng
     */
    function checkSignature($token){
        /*获取微信发送确认的参数。*/
        $signature = $_GET['signature'];    /*微信加密签名，signature结合了开发者填写的token参数和请求中的timestamp参数、nonce参数。*/
        $timestamp = $_GET['timestamp'];    /*时间戳 */
        $nonce = $_GET['nonce'];            /*随机数 */
        $echostr = $_GET['echostr'];        /*随机字符串*/
        /*加密/校验流程*/
        /*1. 将token、timestamp、nonce三个参数进行字典序排序*/
        $array = array($token,$timestamp,$nonce);
        sort($array,SORT_STRING);
        /*2. 将三个参数字符串拼接成一个字符串进行sha1加密*/
        $str = sha1( implode($array) );
        /*3. 开发者获得加密后的字符串可与signature对比，标识该请求来源于微信*/
        if( $str==$signature && $echostr ){
            return ture;
        }else{
            return false;
        }
    }
}
include './wechat.class.php';
$obj = new Wechat;
// $obj = new WechatValid;
if (!isset($_GET['echostr'])) {
	$obj->responseMsg();
}else{
    $obj->valid();
}

 ?>
