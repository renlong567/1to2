<?php

/**
 * @desc 支付宝统一接口
 * @version 1.0
 * @author RenLong
 * @date 2015-11-05
 */
if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

$payment_lang = ROOT_PATH . 'languages/' . $GLOBALS['_CFG']['lang'] . '/payment/alipay.php';

if (file_exists($payment_lang))
{
    global $_LANG;

    include_once($payment_lang);
}

/* 模块的基本信息 */
if (isset($set_modules) && $set_modules == TRUE)
{
    $i = isset($modules) ? count($modules) : 0;

    /* 代码 */
    $modules[$i]['code'] = basename(__FILE__, '.php');

    /* 描述对应的语言项 */
    $modules[$i]['desc'] = 'alipay_desc';

    /* 是否支持货到付款 */
    $modules[$i]['is_cod'] = '0';

    /* 是否支持在线支付 */
    $modules[$i]['is_online'] = '1';

    /* 作者 */
    $modules[$i]['author'] = 'ZZHBest';

    /* 网址 */
    $modules[$i]['website'] = 'http://www.alipay.com';

    /* 版本号 */
    $modules[$i]['version'] = '1.3';

    /* 配置信息 */
    $modules[$i]['config'] = array(
        array('name' => 'alipay_account', 'type' => 'text', 'value' => ''),
        array('name' => 'alipay_key', 'type' => 'text', 'value' => ''),
        array('name' => 'alipay_partner', 'type' => 'text', 'value' => ''),
        array('name' => 'alipay_pay_method', 'type' => 'select', 'value' => '')
    );

    return;
}

include_once ROOT_PATH . '/includes/modules/payment/paymentInterface.php';
include_once ROOT_PATH . '/includes/modules/payment/paymentCore.php';

class alipay extends paymentCore implements paymentInterface
{

    public $service = 'alipay.acquire.page.createandpay';   // 接口名称 String 接口名称。 不可空 alipay.acquire.page.createandpay
    public $partner = '';   // 合作者身份ID String(16)签约的支付宝账号对应的支付宝唯一用户号。以 2088 开头的 16 位纯数字组成。不可空 208801117754562
    public $_input_charset = EC_CHARSET;   // 参数编码字符集 String 商户网站使用的编码格式， 如 utf-8、 gbk、 gb2312 等。 不可空 gbk
    public $sign_type = 'MD5';   // 签名方式 String DSA、 RSA、 MD5 三个值可选，必须大写。 不可空 MD5
    public $sign = '';   // 签名 String 请参见“ 8 签名机制”。 不可空 
    public $return_url = '';   // 页面跳转同步通知页面路径String(200)支付宝处理完请求后，当前页面自动跳转到商户网站里指定页面的 http 路径。可空 
    public $notify_url = '';   // 服务器异步通知页面路径String(190) 支付宝服务器主动通知商户网站里指定的页面 http 路径。 可空 
    public $out_trade_no = '';   // 商户网站唯一订单号String(64)支付宝合作商户网站唯一订单号。 不可空
    public $subject = '';   // 订单标题 String(256)商品的标题/交易标题/订单标题/订单关键字等。该参数最长为 128 个汉字。不可空 
    public $product_code = 'FAST_INSTANT_TRADE_PAY';   // 订单业务类型String(32)用来区分是哪种业务类型的下单。目前仅支持：FAST_INSTANT_TRADE_PAY（快捷即时到帐）。不可空 FAST_INSTANT_TRADE_PAY
    public $total_fee = '';   // 订单金额 number(9,2)该笔订单的资金总额，取值范围[0.01,100000000]，精确到小数点后 2 位。币种为人民币时单位为元。不可空 0.01
//    public $seller_id = '';   // 卖家支付宝用户号String(28)卖家支付宝账号对应的支付宝唯一用户号。以 2088 开头的纯 16 位数字。如果和 seller_email 同时为空，则本参数默认填充partner 的值。可空 2088011177545623
//    public $seller_email = '';   // 卖家支付宝账号String(100)卖家支付宝账号，可以为email 或者手机号。如果 seller_id 不为空，则以seller_id 的值作为卖家账号，忽略本参数。可空 test@alitest.com
    public $buyer_info = '';   // 买家信息 String(5 12) 描述买家信息， 体请参见“ 4.3 json 买家其他信 格式，具息说明”。可空
//    public $it_b_pay = '';   // 订单支付超时时间String(200)设置未付款交易的超时时间，一旦超时，该笔交易就会自动被关闭。
    public $passback_parameters = __CLASS__;   // 公用回传参数String(256)如果用户请求时传递了该参数，则返回给商户时会回传该参数。可空
    private $trade_no = '';   // 支付交易号
    private $alipay_key = '';
    private $gateway = 'https://mapi.alipay.com/gateway.do';
    private $from = ''; //支付来源

    public function __construct()
    {
        $payment = get_payment(__CLASS__);
        $this->notify_url = $GLOBALS['ecs']->get_domain() . '/api/asyn_notify/alipay.php';
        $this->return_url = $GLOBALS['ecs']->url() . 'respond.php';

        if (!empty($payment))
        {
            $this->partner = $payment['alipay_partner'];
            $this->seller_email = $payment['alipay_account'];
            $this->alipay_key = $payment['alipay_key'];
        }
    }

    public function get_code($order, $payment)
    {
        if (empty($order))
        {
            return '';
        }

        $this->loadData($order);

        $parmas = $this->getSignAndParams();

        $button = '<div align="center"><input type="button" onclick="window.open(\'' . $this->gateway . '?' . http_build_query($parmas) . '\')" value="' . $GLOBALS['_LANG']['pay_button'] . '" /></div>';

        return $button;
    }

    public function get_url($order)
    {
        if (empty($order))
        {
            return '';
        }

        $this->loadData($order);

        $parmas = $this->getSignAndParams();

        $url = $this->gateway . '?' . http_build_query($parmas);

        return $url;
    }

    /**
     * @desc 处理接收信息
     * @author RenLong
     * @date 2015-10-28
     * @return boolean
     */
    public function respond()
    {
        if (!$this->checkPost())
        {
            return false;
        }

        $this->_log();

        order_paid_plus($this->out_trade_no, PS_PAYED, $this->from, __CLASS__, $this->trade_no);

        return $this->out_trade_no;
    }

    /**
     * @desc 检查接收数据
     * @author RenLong
     * @date 2015-10-28
     * @return boolean
     */
    private function checkPost()
    {
        //接收异步回调参数
        if (!empty($_POST))
        {
            foreach ($_POST as $key => $value)
            {
                $_GET[$key] = $value;
            }
        }

        //接收同步回调参数
        foreach ($_GET as $key => $value)
        {
            $data[$key] = $value;
        }

        $reviceSign = $data['sign'];
        $SignType = $data['sign_type'];
        unset($data['sign']);
        unset($data['sign_type']);

        //验证数据来源是否合法
//        if ($this->verityDataSource($data['notify_id']) !== 'true')
//        {
//            sendWaringEmail(__CLASS__ . '-notify_id', 'POST:' . json_encode($_POST) . '------------' . 'GET' . json_encode($_GET));
//            return false;
//        }
        //检查签名
        switch ($SignType)
        {
            case 'MD5':
                $this->createSignOfMd5($data);
                $this->from = 'WEB';    //标记来源为web端
                if ($reviceSign !== $this->sign)
                {
//                    sendWaringEmail(__CLASS__ . '-sign(MD5)', json_encode($data));
                    return false;
                }
                break;
            case 'RSA':
                $this->from = 'APP';    //标记来源为APP端
                if (!$this->checkSignOfRsa($data, $reviceSign))
                {
//                    sendWaringEmail(__CLASS__ . '-sign(RSA)', json_encode($data));
                    return false;
                }
                break;
        }

        //判断状态
        if ($data['trade_status'] != 'TRADE_SUCCESS' && $data['trade_status'] != 'TRADE_FINISHED')
        {
            return false;
        }

        //对比金额
        if (!$this->checkOrderAmount($data['out_trade_no'], $data['total_fee']))
        {
//            sendWaringEmail(__CLASS__ . '-orderAmount', serialize($data));
            return false;
        }

        $this->out_trade_no = $data['out_trade_no'];
        $this->trade_no = $data['trade_no'];

        return true;
    }

    /**
     * @desc 赋值
     * @author RenLong
     * @date 2015-11-06
     * @param array $order
     */
    private function loadData($order)
    {
        $this->out_trade_no = $order['order_sn'];
        $this->subject = $order['order_sn'];
        $this->total_fee = $order['order_amount'];
        $this->buyer_info = json_encode(
                array(
                    'buyerName' => $order['consignee'],
                    'buyerIdNo' => $order['user_idc'],
                    'needBuyerRealnamed' => 'T',
        ));
    }

    /**
     * @desc 生成签名和参数
     * @author RenLong
     * @date 2015-10-28
     * @return array
     */
    private function getSignAndParams()
    {
        $data = array(
            'service' => $this->service,
            'partner' => $this->partner,
            '_input_charset' => $this->_input_charset,
            'return_url' => $this->return_url,
            'notify_url' => $this->notify_url,
            'out_trade_no' => $this->out_trade_no,
            'subject' => $this->subject,
            'product_code' => $this->product_code,
            'total_fee' => $this->total_fee,
            'buyer_info' => $this->buyer_info,
            'passback_parameters' => $this->passback_parameters,
        );

        $this->createSignOfMd5($data);

        $data['sign'] = $this->sign;
        $data['sign_type'] = $this->sign_type;

        return $data;
    }

    /**
     * @desc 生成MD5签名
     * @author RenLong
     * @date 2015-11-07
     * @param array $data
     */
    private function createSignOfMd5($data)
    {
        $str = $this->spliceParamsStr($data);

        $this->sign = md5($str . $this->alipay_key);
    }

    /**
     * @desc 检查RSA签名
     * @author RenLong
     * @date 2015-11-07
     * @param [] $data
     * @param string $sign
     * @return boolean
     */
    private function checkSignOfRsa($data = array(), $sign = '')
    {
        $sign = base64_decode($sign);

        $str = $this->spliceParamsStr($data);

        $public_key = file_get_contents(ROOT_PATH . 'includes/modules/payment/lib_alipay/rsa_public_key.pem');

        $pkeyid = openssl_get_publickey($public_key);

        if ($pkeyid)
        {
            $verify = openssl_verify($str, $sign, $pkeyid);
            openssl_free_key($pkeyid);
        }

        if ($verify === 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @desc 检查订单金额是否一致
     * @author RenLong
     * @date 2015-10-28
     * @param string $orderSn
     * @param int $payAmount
     * @return boolean
     */
    private function checkOrderAmount($orderSn = '', $payAmount = 0)
    {
        $orderInfo = order_info(0, $orderSn);

        if ($orderInfo['pay_status'] == PS_PAYED)
        {
            return true;
        }

        if ($orderInfo['order_amount'] != $payAmount)
        {
            return false;
        }

        return true;
    }

    /**
     * @desc 消息记录
     * @author RenLong
     * @date 2015-10-28
     */
    private function _log()
    {
        $log = '[' . local_date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']) . ']' . serialize($_GET) . PHP_EOL;
        file_put_contents(ROOT_PATH . 'data/payment/alipay/' . $this->out_trade_no . '.txt', $log, FILE_APPEND);
    }

    /**
     * @desc 验证数据来源是否合法
     * @author RenLong
     * @date 2015-11-10
     * @param string $notify_id
     * @return boolean
     */
    private function verityDataSource($notify_id)
    {
        $this->Url = $this->gateway;

        $data = array(
            'service' => 'notify_verify',
            'partner' => $this->partner,
            'notify_id' => $notify_id
        );

        return $this->postToServer($data);
    }

    /**
     * @desc 拼接参数字符串（自然排序法）
     * @author RenLong
     * @date 2015-12-31
     * @param [] $params
     * @return string
     */
    private function spliceParamsStr($params = array())
    {
        $str = '';

        ksort($params);

        foreach ($params as $key => $value)
        {
            if ($value !== '')
            {
                $str .= sprintf('%s=%s&', $key, trim($value));
            }
        }
        $str = rtrim($str, '&');

        return $str;
    }

}

?>