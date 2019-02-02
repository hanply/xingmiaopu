<?php
// +----------------------------------------------------------------------
// | 企业付款
// +----------------------------------------------------------------------
namespace Purewechat\Controller;
use SimpleXMLElement;
class Comppay extends BaseController {
    
    /**
    * 微信企业付款接口  2017-05-11
    */
    public function pay($parameter){
        $url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers";
        
        $data = array(
            'mch_appid'         => $parameter['mch_appid'], //公众账号ID
            'mchid'             => $parameter['mchid'],         //商户号
            'nonce_str'         => createnoncestr(32),              //随机字符串，不长于32位
            'partner_trade_no'  => $parameter['ordernumber'],           //商户订单号
            'openid'            => $parameter['openid'],                    //用户OPENID
            'check_name'        => 'NO_CHECK',              //校验用户姓名选项，NO_CHECK：不校验真实姓名， FORCE_CHECK：强校验真实姓名OPTION_CHECK：针对已实名认证的用户才校验真实姓名      
            'amount'            => $parameter['money'] * 100,           //企业付款金额，单位为分
            'desc'              => $parameter['desc'],          //企业付款操作说明信息
            'spbill_create_ip'  => get_client_ip(),         //接口的机器Ip地址                 
        );
        $data['sign'] = $this -> getsign($data,$parameter);//生成签名
        
        $xml = new SimpleXMLElement('<xml></xml>');
        data2xml($xml, $data);
        $data_xml = $xml->asXML();
        $result = $this -> curl_post_ssl($url, $data_xml, $second=30,$aHeader=array(),$parameter);
        $result = xmltoarray($result);
        apilog('','wechat','companypay',$url, serializeMysql($data), serializeMysql($result));
        return $result;
    }
    
    /**
    * 普通现金红包   2017-08-22
    */
    public function redbagpay($parameter){
        $url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";
    
        $data = array(
            'nonce_str'         => createnoncestr(32),              //随机字符串，不长于32位
            'mch_billno'        => $parameter['mch_billno'],            //商户订单号
            'mch_id'            => $parameter['mchid'],         //商户号
            'wxappid'           => $parameter['mch_appid'], //公众账号ID
            'send_name'         => $parameter['send_name'], //商户名称
            're_openid'         => $parameter['openid'],                    //用户OPENID
            'total_amount'      => $parameter['money'] * 100,   //付款金额，单位为分
            'total_num'         => 1,   //红包发放总人数
            'wishing'           => $parameter['wishing'],   //红包祝福语
            'client_ip'         => get_client_ip(),         //接口的机器Ip地址
            'act_name'          => $parameter['act_name'],              //活动名称
            'remark'            => $parameter['remark'],    //备注
        );
        $data['sign'] = $this -> getsign($data,$parameter);//生成签名
        $xml = new SimpleXMLElement('<xml></xml>');
        data2xml($xml, $data);
        $data_xml = $xml->asXML();
        
        $result = $this -> curl_post_ssl($url, $data_xml, $second=30,$aHeader=array(),$parameter);
        $result = xmltoarray($result);
        apilog('','wechat','redbagpay',$url, serializeMysql($data), serializeMysql($result));
        return $result;
    }
    
    
    /**
    * 微信企业付款接口-格式化参数，签名过程需要使用
    */
    public function curl_post_ssl($url, $vars, $second=30,$aHeader=array(),$parameter){

        $ch = curl_init();
        //超时时间
        curl_setopt($ch,CURLOPT_TIMEOUT,$second);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        //这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
            
        //以下两种方式需选择一种
            
        //第一种方法，cert 与 key 分别属于两个.pem文件
        //默认格式为PEM，可以注释
        curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');

        curl_setopt($ch,CURLOPT_SSLCERT,getcwd().$parameter['path1']);
        //默认格式为PEM，可以注释
        curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLKEY,getcwd().$parameter['path2']);
        
            
        if( count($aHeader) >= 1 ){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
        }
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
        $data = curl_exec($ch);
        if($data){
            curl_close($ch);
            return $data;
        }else{
            $error = curl_errno($ch);
            echo "call faild, errorCode:$error\n";
            curl_close($ch);
            return false;
        }
    }
    
    public function getsign($data,$param){
        foreach($data as $k => $v){
            if($v){
                $Parameters[$k] = $v;
            }
        }
        ksort($Parameters);
        foreach ($Parameters as $k => $v){
            $String .= $k . "=" . $v . "&";
        }
        $String = $String."key=".$param['partnerkey'];
        $String = md5($String);
        $result = strtoupper($String);
            
        return $result;
    }
    

}
