<?php

/**
 * @desc 易通跨境供应链报关统一版接口类
 * @author RenLong
 * @date 2017-04-11
 * @version 1.4.3.1
 */
if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}
require_once ROOT_PATH . 'includes/lib_customs.php';
require_once ROOT_PATH . 'includes/modules/customs/customsCore.php';

class airportEton extends customsCore
{

    private $_key = 'ZZHYETK'; //密钥
    private $_company_code = 'ZZHYC';
    public $billmode = '';   //    Int(1)  N   模式代码    1一般模式2保税模式
    public $seqno = 5340005776;  //   String(32)  N   主单号 航空提单号海运运单号
    public $voyageNo = 5340005776;   //    String(32)  Y   航班航次号   直购进口必填。货物进出境的运输工具的航次编号。保税进口免填。
    public $wbpccond = '';   //    String(32)  N   批次号 保税模式不校验，一般模式按实际情况填写）
    public $cbecode = '';    // String(32)  N   电商海关备案编码    
    public $ecpcode = '';    // String(32)  N   电商平台海关备案编码  
    public $orderid = '';    // String(64)  N   电商订单号
    public $submittime = ''; //  String(32)  N   订单提交时间  yyyy-MM-dd HH:mm:ss
    public $payenterprisename = '';  //   String(64)  N   支付企业名称  
    public $payenterprisecode = '';  //   String(32)  N   支付企业代码  
    public $paynumber = '';  //   String(64)  N   支付单号    
    public $purchasername = '';  //   String(64)  N   订购人名称   
    public $buyerregno = ''; //  String(64)  N   订购人注册号  
    public $purchasertelephone = ''; //  String(32)  N   订购人电话   
    public $ordersum = 0;   //    Double(10,2)    N   订单总价    
    public $goodsvalue = 0; //  Double(10,2)    N   订单实际销售价格    含非现金折扣金额
    public $freight = 0;    // Double(10,2)    N   运杂费 不包含在商品价格中的运杂费，无则填写"0"。
    public $discount = 0;   //    Double(10,2)    N   非现金抵扣金额 使用积分、虚拟货币、代金券等非现金支付金额，无则填写"0"。
    public $taxTotal = 0;   //    Double(10,2)    N   代扣税款    企业预先代扣的税款金额，无则填写“0”
    public $acturalPaid = 0;    // Double(10,2)    N   实际支付金额  商品价格+运杂费+代扣税款-非现金抵扣金额，与支付凭证的支付金额一致
    public $collectionusername = ''; //  String(64)  N   收件人名称   跟订单保持一致
    public $collectionusertelephone = '';    // String(32)  N   收件人电话   跟订单保持一致
    public $collectionuseraddress = '';  //   String(255) N   收件人地址   跟订单保持一致（包含省市区）
    public $remark = ''; //  String(255) Y   订单备注    
    public $senderusercountry = '';  //   String(32)  N   发货人所在国  海关代码(保税填142)一般填写国别海关代码
    public $senderusername = ''; //  String(64)  N   发货人名称   
    public $senderuseraddress = '';  //   String(255) N   发货人地址   
    public $senderusertelephone = '';    // String(32)  N   发货人电话   
    public $idtype = 1; //  String(32)  N   证件类型    1:身份证
    public $customerid = ''; //  String(32)  N   证件号码    
    public $trepcodeinsp = '';   //    String(32)  N   物流企业OMS代码   申通4100910023 中通4100606550 EMS4100810004
    public $tradecompany = '';   //    String(32)  N   贸易国别    海关代码
    public $totalfeeunit = '';   //    String(32)  N   总费用币制   
    public $weightunit = '035'; //  String(32)  N   毛重单位    
    public $weight = ''; //  Double(10,2)    y   毛重  一般模式(集货)必填
    public $collusercountryinsp = '';    // String(32)  N   发货人所在国  检验检疫代码
    public $senderusercountryinsp = '';  //   String(32)  N   订购人所在国  检验检疫代码
    public $consigneeprov = '';  //   String(64)  N   收件人省    保税进口必填
    public $consigneecity = '';  //   String(64)  N   收件人市    保税进口必填
    public $consigneedistrict = '';  //   String(64)  N   收件人区    保税进口必填
    public $expresscode = '';  //   若不填，则系统自动分配运单号；若填，请填写易通分配的运单号。
    public $order_id = 0;
    private $_debug = true;

    public function __construct($_CFG)
    {
        $this->Url = 'http://omsv2.eton.bfcorp.cn:8080/api/insertOrder';

        $this->cbecode = $_CFG['cus_cbecode'];
        $this->ecpcode = $_CFG['cus_ecpcode'];
        $this->senderusercountry = $_CFG['cus_senderusercountry'];
        $this->senderusername = $_CFG['cus_senderusername'];
        $this->senderuseraddress = $_CFG['cus_senderuseraddress'];
        $this->senderusertelephone = $_CFG['cus_senderusertelephone'];
        $this->tradecompany = $_CFG['cus_tradecompany'];
        $this->trepcodeinsp = $_CFG['cus_trepcodeinsp'];
        $this->totalfeeunit = $_CFG['cus_totalfeeunit'];
        $this->senderusercountryinsp = $_CFG['cus_sendusercountryinsp'];
        $this->collusercountryinsp = $_CFG['cus_collusercountryinsp'];
        $this->payenterprisecode = $_CFG['cus_payenterprisecode'];
        $this->payenterprisename = $_CFG['cus_payenterprisename'];

        if ($this->_debug)
        {
            $this->Url = 'http://test.oms.eton.bfcorp.cn:18080/insertOrder';
            $this->_key = 'TEST';
            $this->_company_code = 'BXYPN';
            $this->trepcodeinsp = '4100606550';
            $this->cbecode = '1114960298';
            $this->ecpcode = '1114960298';
        }
    }

    /**
     * @desc 发送报文
     * @author RenLong
     * @date 2015-12-05
     * @return json
     */
    public function send()
    {
        //生成数据
        $data = $this->getCode();
        var_export(json_decode($data, true));
        echo '<hr />';
        //提交报文
        $send_data = array(
            'data' => $data,
            'data_digest' => base64_encode(md5($data . $this->_key)),
            'company_code' => $this->_company_code
        );

        $result = $this->postToServer($send_data);
        var_dump($result);
        exit;
        //保存报文
        $this->createXml($this->orderid, serialize(json_decode($data)), 'Eton', 'send', 'txt');
        //保存回执
        $this->createXml($this->orderid, serialize(json_decode($result)), 'Eton', 'receive', 'txt');
        //处理结果
        return $this->revice($result);
    }

    /**
     * @desc 处理服务器返回信息
     * @author Fern
     * @date 2016-07-18
     * @param json $result
     * @return boolean
     */
    private function revice($result)
    {
        $result = json_decode($result, true);
        $message = array(
            'transfer_status' => AIRPORT_CUSTOMS_FAIL,
            'transfer_comments' => $result['remark'],
            'transfer_company' => '易通',
        );
//        expressstatus 是说明发送给快递的状态
//        omsstatus  oms系统的状态
        if ($result['expressstatus'] === true && $result['omsstatus'] === true)
        {
            $message['transfer_status'] = AIRPORT_CUSTOMS_OK;
            $message['logisticsNo'] = $result['expresscode'];
        }
        return $GLOBALS['db']->autoExecute($GLOBALS['ecs']->table('airport_order'), $message, 'UPDATE', 'order_sn = \'' . $result['orderid'] . '\'');
    }

    /**
     * @desc 组合json格式
     * @author Fern
     * @date 2016-07-16
     * @return string
     */
    private function getCode()
    {
        $order = get_airport_info($this->order_id);

        switch ($this->billmode)
        {
            case CUSTOMS_MODE_JIHUO:
                break;
            case CUSTOMS_MODE_BEIHUO:
                break;
        }

        $this->orderid = $order['order_sn'];

        $data = array(
            'billmode' => $this->billmode,
            'seqno' => $this->seqno,
            'voyageNo' => $this->voyageNo,
            'wbpccond' => $order['batchNumbers'],
            'cbecode' => $this->cbecode,
            'ecpcode' => $this->ecpcode,
            'orderid' => $this->orderid,
            'submittime' => local_date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']),
            'payenterprisename' => $this->payenterprisename,
            'payenterprisecode' => $this->payenterprisecode,
            'paynumber' => $order['paymentNo'],
            'purchasername' => $order['consignee'],
            'buyerregno' => $order['mobile'], //订购人注册号?
            'purchasertelephone' => $order['mobile'],
            'ordersum' => $order['order_amount'],
            'goodsvalue' => $order['goods_amount'],
            'freight' => $order['shipping_fee'],
            'discount' => $this->discount,
            'taxTotal' => $order['taxfee'],
            'acturalPaid' => $order['order_amount'],
            'collectionusername' => $order['consignee'],
            'collectionusertelephone' => $order['mobile'],
            'collectionuseraddress' => $order['address'],
            'remark' => $this->remark,
            'senderusercountry' => $this->senderusercountry,
            'senderusername' => $this->senderusername,
            'senderuseraddress' => $this->senderuseraddress,
            'senderusertelephone' => $this->senderusertelephone,
            'idtype' => $this->idtype,
            'customerid' => $order['customerid'],
            'expresscode' => $order['logisticsNo'],
            'trepcodeinsp' => $this->trepcodeinsp, //物流企业代码
            'tradecompany' => $this->tradecompany,
            'totalfeeunit' => $this->totalfeeunit,
            'weightunit' => $this->weightunit,
            'weight' => $order['weight'],
            'collusercountryinsp' => $this->collusercountryinsp,
            'senderusercountryinsp' => $this->senderusercountryinsp,
            'consigneeprov' => $order['province'],
            'consigneecity' => $order['city'],
            'consigneedistrict' => $order['district'],
            'orderGoods' => $this->getGoodsByOrderId(),
        );
        return json_encode($data);
    }

    private function getGoodsByOrderId()
    {
        if ($this->_debug)
        {
            return array(
                array(
                    'itemno' => 'B0201901013',
                    'goodprice' => 1,
                    'amount' => 1,
                ),
                array(
                    'itemno' => 'B0201901003',
                    'goodprice' => 1,
                    'amount' => 1,
                )
            );
        }

        $sql = 'SELECT '
                . 'g.itemno'
                . 'og.goods_price AS goodprice,'
                . 'og.goods_number AS amount'
                . ' FROM ' . $GLOBALS['ecs']->table('airport_order') . ' ag'
                . ' INNER JOIN ' . $GLOBALS['ecs']->table('order_info') . ' o ON ag.order_sn=o.order_sn'
                . ' INNER JOIN ' . $GLOBALS['ecs']->table('order_goods') . ' og ON og.order_id=o.order_id'
                . ' INNER JOIN ' . $GLOBALS['ecs']->table('goods') . ' g ON og.goods_id=g.goods_id'
                . ' WHERE ag.id = ' . $this->order_id
                . ' ORDER BY g.itemno ASC';

        return $GLOBALS['db']->getAll($sql);
    }

}
