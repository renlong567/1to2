<?php

/**
 * @desc 支付宝支付报关信息接口
 * @author RenLong
 * @date 2015-10-08
 */
if (!defined('IN_ECS')) {
    die('Hacking attempt');
}

require_once ROOT_PATH . 'includes/modules/customs/customsCore.php';
require_once ROOT_PATH . 'includes/lib_payment.php';

class alipay extends customsCore {

    private $service = 'alipay.acquire.customs';   //接口名称  String   alipay.acquire.customs
    private $partner = '';   //合作者身份ID String(16) 
    public $key = '';  //安全检验码，以数字和字母组成的32位字符
    private $_input_charset = EC_CHARSET;
    private $sign_type = 'MD5';
    public $sign = '';
    public $out_request_no = '';    //报关流水号 String(32) 
    public $trade_no = '';  //支付宝交易号
    public $merchant_customs_code = COMPANY_CUSTOMS_NUMBER; //商户海关备案编号
    public $amount = 0; //报关金额
    public $customs_place = PAY_TYPE_ALIPAY_CUSTOMS_ZONGBAOQU; //海关编号
    private $merchant_customs_name = COMPANY_NAME; //商户海关备案名称  可空
    public $is_split = '';  //是否拆单 可空
    public $sub_out_biz_no = '';    //子订单号  可空

    public function __construct() {
        $this->Url = 'https://mapi.alipay.com/gateway.do';
        $payment = get_payment(__CLASS__);

        if ($payment) {
            $this->partner = $payment['alipay_partner'];
            $this->key = $payment['alipay_key'];
        }
    }

    public function send() {
        $data = $this->getContent();

        $result = $this->postToServer($data, false);

        $this->revice($result);
    }

    /**
     * @desc 处理返回数据
     * @author RenLong
     * @date 2015-11-12
     * @param string $result
     * @return boolean
     */
    private function revice($result) {
        $data = array(
            'pay_number_status' => AIRPORT_CUSTOMS_FAIL,
            'pay_comments' => '',
        );

        $result = str_replace('<?xml version="1.0" encoding="GBK"?>', '<?xml version="1.0" encoding="utf-8"?>', $result);
        $xml = simplexml_load_string($result);
        $xml = json_decode(json_encode($xml), true);
        switch ($xml['is_success']) {
            case 'T':
                //检查签名
                $o = '';
                foreach ($xml['response']['alipay'] as $k => $v) {
                    $o .= sprintf('%s=%s&', $k, $v);
                }
                $o = rtrim($o, '&');

                if ($xml['sign'] != md5($o . $this->key)) {
                    $data['pay_comments'] = '签名错误';
                } else {
                    switch ($xml['response']['alipay']['result_code']) {
                        case 'SUCCESS':
                            $data['pay_number_status'] = AIRPORT_CUSTOMS_OK;
                            $data['pay_comments'] = $xml['response']['alipay']['alipay_declare_no'];
                            break;
                        default:
                            $data['pay_comments'] = $xml['response']['alipay']['detail_error_code'] . '|' . $xml['response']['alipay']['detail_error_des'];
                            break;
                    }
                }
                break;

            default:
                $data['pay_comments'] = $xml['error'];
                break;
        }

        $table = 'airport_order';
        $where = 'order_sn';

        return $GLOBALS['db']->autoExecute($GLOBALS['ecs']->table($table), $data, 'UPDATE', $where . '=' . $this->out_request_no);
    }

    private function getContent() {
        $data = array(
            'service' => $this->service,
            'partner' => $this->partner,
            '_input_charset' => $this->_input_charset,
            'out_request_no' => $this->out_request_no,
            'trade_no' => $this->trade_no,
            'merchant_customs_code' => $this->merchant_customs_code,
            'amount' => $this->amount,
            'customs_place' => $this->customs_place,
            'merchant_customs_name' => $this->merchant_customs_name,
//            'is_split' => $this->is_split, //暂时不需要
//            'sub_out_biz_no' => $this->sub_out_biz_no, //暂时不需要
        );

        ksort($data);

        $str = '';
        foreach ($data as $key => $value) {
            $str .= sprintf('%s=%s&', $key, $value);
        }
        $str = rtrim($str, '&');

        $this->sign = md5($str . $this->key);
        $data['sign'] = $this->sign;
        $data['sign_type'] = $this->sign_type;

        return $data;
    }

}
