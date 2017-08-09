<?php

/**
 * @desc 郑州综保区订单信息类
 * @author RenLong
 * @date 2016-07-04
 * @version 1.5
 */
if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

require_once ROOT_PATH . 'includes/modules/customs/customsCore.php';

class airportOrder extends customsCore
{

    public $orderId = 0;
    public $guid = '08c525c0-96d1-404c-8536-b767281b3030';  //系统唯一序号  guid    C36 是   企业系统生成36位唯一序号（英文字母大写）。
    public $dxpid = DXPID;
    public $appType = 1;   //报送类型    appType C1  是   企业报送类型。1-新增 2-变更 3-删除。默认为1。
    public $appTime = '';   //报送时间    appTime C14 是   企业报送时间。格式:YYYYMMDDhhmmss。
    public $appStatus = 2; //业务状态    appStatus   C..3    是   业务状态:1-暂存,2-申报,默认为2。
    public $orderType = 'I'; //订单类型    orderType   C1  是   电子订单类型：I进口
    public $orderNo = '';   //订单编号    orderNo C..30   是   交易平台的订单编号，同一交易平台的订单编号应唯一。订单编号长度不能超过60位。
    public $ebpCode = '';   //电商平台代码  ebpCode C..18   是   电商平台的海关注册登记编号；电商平台未在海关注册登记，由电商企业发送订单的，以中国电子口岸发布的电商平台标识编号为准。
    public $ebpName = '';   //电商平台名称  ebpName C..100  是   电商平台的海关注册登记名称；电商平台未在海关注册登记，由电商企业发送订单的，以中国电子口岸发布的电商平台名称为准。
    public $ebcCode = '';   //电商企业代码  ebcCode C..18   是   电商企业的海关注册登记编号。
    public $ebcName = '';   //电商企业名称  ebcName C..100  是   电商企业的海关注册登记名称。
    public $goodsValue = 0;    //商品价格    goodsValue  N19,2   是   商品实际成交价，含非现金抵扣金额。
    public $freight = 0;   //运杂费 freight N19,2   是   不包含在商品价格中的运杂费，无则填写"0"。
    public $discount = 0;  //非现金抵扣金额 discount    N19,2   是   使用积分、虚拟货币、代金券等非现金支付金额，无则填写"0"。
    public $taxTotal = 0;  //代扣税款    taxTotal    N19,2   是   企业预先代扣的税款金额，无则填写“0”
    public $acturalPaid = 0;   //实际支付金额  acturalPaid N19,2   是   商品价格+运杂费+代扣税款-非现金抵扣金额，与支付凭证的支付金额一致。
    public $currency = 142;  //币制  currency    C3  是   限定为人民币，填写“142”。
    public $buyerRegNo = '';    //订购人注册号  buyerRegNo  C..60   是   订购人的交易平台注册号。
    public $buyerName = ''; //订购人姓名   buyerName   C..60   是   订购人的真实姓名。
    public $buyerIdType = 1;   //订购人证件类型 buyerIdType C1  是   1-身份证,2-其它。限定为身份证，填写“1”。
    public $buyerIdNumber = ''; //订购人证件号码 buyerIdNumber   C..60   是   订购人的身份证件号码。
    public $payCode = '';   //支付企业代码  payCode C..18   否   支付企业的海关注册登记编号。
    public $payName = '';   //支付企业名称  payName C..100  否   支付企业在海关注册登记的企业名称。
    public $payTrCsactionId = '';   //支付交易编号  payTrCsactionId C..60   否   支付企业唯一的支付流水号。
    public $batchNumbers = '';  //商品批次号   batchNumbers    C..30   否   商品批次号。
    public $consignee = ''; //收货人姓名   consignee   C..60   是   收货人姓名，必须与电子运单的收货人姓名一致。
    public $consigneeTelephone = '';    //收货人电话   consigneeTelephone  C..20   是   收货人联系电话，必须与电子运单的收货人电话一致。
    public $consigneeAddress = '';  //收货地址    consigneeAddress    C..200  是   收货地址，必须与电子运单的收货地址一致。
    public $consigneeDitrict = '';  //收货地址行政区划代码  consigneeDitrict    C6  否   参照国家统计局公布的国家行政区划标准填制。
    public $note = '';  //备注  note    C..1000 否   
    public $ordersum = 0;  //订单总价    ordersum    N19,2   是   订单总价
    public $otherfee = 0;  //其它费用    otherfee    N19,2   否   其他费用
    public $taxfee = 0;    //进口行邮费   taxfee  N19,2   否   进口行邮费
    public $senderusername = '';    //发货人姓名   senderusername  C..50   是   发货人姓名
    public $senderuseraddress = ''; //发货人地址   senderuseraddress   C..200  是   发货人地址
    public $senderusertelephone = '';   //发货人电话   senderusertelephone C..30   是   发货人电话
    public $billmode = '';  //模式代码    billmode    C1  是   模式代码1、 一般模式 ； 2、 保税模式
    public $wasterornot = 'N';   //是否有废旧物品检验检疫   wasterornot C1  是   
    public $botanyornot = 'N';   //是否带有植物性包装及铺垫材料检验检疫）    botanyornot C1  是   
    public $cbecodeinsp = '';   //电商检验检疫CIQ备案编号   cbecodeinsp C..50   是   
    public $ecpcodeinsp = '';   //电商平台检验检疫CIQ备案编号 ecpcodeinsp C..50   否   
    public $trepcodeinsp = '';  //物流企业CIQ检验检疫备案编号 trepcodeinsp    C..50   是   
    public $submittime = '';    //订单提交时间  submittime  C..14   是   例：20150526175430
    public $tradecompany = '';  //贸易国别检验检疫  tradecompany    C3  是   
    public $totalfeeunit = '';  //总费用单位检验检疫 totalfeeunit    C..20   是   
    public $countofgoodstype = '';  //商品种类数检验检疫 countofgoodstype    C..10   是   
    public $weight = 0;    //毛重检验检疫    weight  N19,4   是   
    public $weightunit = '035';    //毛重单位检验检疫  weightunit  C..20   是   
    public $netweight = 0; //净重检验检疫    netweight   N19,4   是   
    public $netweightunit = '035'; //净重单位检验检疫  netweightunit   C..20   是   
    public $platformurl = '';   //平台网址    platformurl C..100  否   
    public $collusercountryinsp = '';   //发货人所在国检验检疫    collusercountryinsp C3  是   
    public $sendusercountryinsp = '';   //收货人所在国检验检疫    sendusercountryinsp C3  是   
    public $paynumber = ''; //支付交易号   paynumber   C..50   是   
    public $lmsno = ''; //S账册号    lmsno   C..20   否   
    public $manualno = '';  //关联H2010账册号  manualno    C..20   否   
    public $purchasername = ''; //订购人名称   purchasername   C..50   是   【 v1.5新增】
    public $buyerregno = '';    //订购人注册号  buyerregno  C..100  是   【 v1.5新增】
    public $purchasertelephone = '';    //订购人电话   purchasertelephone  C..30   是   【 v1.5新增】

    public function __construct($_CFG)
    {
        $this->appTime = local_date('YmdHis', $_SERVER['REQUEST_TIME']);
        $this->ebpCode = $_CFG['cus_ecpcode'];
        $this->ebpName = $_CFG['cus_ecpname'];
        $this->ebcCode = $_CFG['cus_cbecode'];
        $this->ebcName = $_CFG['cus_cbename'];
        $this->cbecodeinsp = $_CFG['cus_cbecodeinsp'];
        $this->ecpcodeinsp = $_CFG['cus_ecpcodeinsp'];
        $this->trepcodeinsp = $_CFG['cus_trepcodeinsp'];
        $this->totalfeeunit = $_CFG['cus_totalfeeunit'];
        $this->senderuseraddress = $_CFG['cus_senderuseraddress'];
        $this->senderusername = $_CFG['cus_senderusername'];
        $this->senderusertelephone = $_CFG['cus_senderusertelephone'];
        $this->sendusercountryinsp = $_CFG['cus_sendusercountryinsp'];
        $this->collusercountryinsp = $_CFG['cus_collusercountryinsp'];
        $this->tradecompany = $_CFG['cus_tradecompany'];
        $this->lmsno = $_CFG['cus_lmsno'];
        $this->manualno = $_CFG['cus_manualno'];
        $this->payCode = $_CFG['cus_payenterprisecode'];
        $this->payName = $_CFG['cus_payenterprisename'];
    }

    public function send()
    {
        $message = $this->getCode();

        $batchNumber_path = empty($this->batchNumbers) ? '' : '/' . $this->batchNumbers;

        $this->createXml($this->orderNo, $message, 'order' . $batchNumber_path);
    }

    private function getCode()
    {
        $this->getOrderInfo();
        $goods = $this->getGoodsByOrderId();
//        var_dump($goods);exit;
        $this->countofgoodstype = count($goods);

        $ORDER = <<<ETO
<OrderHead>
    <guid>$this->guid</guid>
    <appType>$this->appType</appType>
    <appTime>$this->appTime</appTime>
    <appStatus>$this->appStatus</appStatus>
    <orderType>$this->orderType</orderType>
    <orderNo>$this->orderNo</orderNo>
    <ebpCode>$this->ebpCode</ebpCode>
    <ebpName>$this->ebpName</ebpName>
    <ebcCode>$this->ebcCode</ebcCode>
    <ebcName>$this->ebcName</ebcName>
    <goodsValue>$this->goodsValue</goodsValue>
    <freight>$this->freight</freight>
    <discount>$this->discount</discount>
    <taxTotal>$this->taxTotal</taxTotal>
    <acturalPaid>$this->acturalPaid</acturalPaid>
    <currency>$this->currency</currency>
    <buyerRegNo>$this->buyerRegNo</buyerRegNo>
    <buyerName>$this->buyerName</buyerName>
    <buyerIdType>$this->buyerIdType</buyerIdType>
    <buyerIdNumber>$this->buyerIdNumber</buyerIdNumber>
    <consignee>$this->consignee</consignee>
    <consigneeTelephone>$this->consigneeTelephone</consigneeTelephone>
    <consigneeAddress>$this->consigneeAddress</consigneeAddress>
    <note>$this->note</note>
    <ordersum>$this->ordersum</ordersum>
    <otherfee>$this->otherfee</otherfee>
    <taxfee>$this->taxfee</taxfee>
    <senderusername>$this->senderusername</senderusername>
    <senderuseraddress>$this->senderuseraddress</senderuseraddress>
    <senderusertelephone>$this->senderusertelephone</senderusertelephone>
    <billmode>$this->billmode</billmode>
    <wasterornot>$this->wasterornot</wasterornot>
    <botanyornot>$this->botanyornot</botanyornot>
    <cbecodeinsp>$this->cbecodeinsp</cbecodeinsp>
    <ecpcodeinsp>$this->ecpcodeinsp</ecpcodeinsp>
    <trepcodeinsp>$this->trepcodeinsp</trepcodeinsp>
    <submittime>$this->submittime</submittime>
    <tradecompany>$this->tradecompany</tradecompany>
    <totalfeeunit>$this->totalfeeunit</totalfeeunit>
    <countofgoodstype>$this->countofgoodstype</countofgoodstype>
    <weight>$this->weight</weight>
    <weightunit>$this->weightunit</weightunit>
    <netweight>$this->netweight</netweight>
    <netweightunit>$this->netweightunit</netweightunit>
    <platformurl>$this->platformurl</platformurl>
    <collusercountryinsp>$this->collusercountryinsp</collusercountryinsp>
    <sendusercountryinsp>$this->sendusercountryinsp</sendusercountryinsp>
    <paynumber>$this->paynumber</paynumber>
    <lmsno>$this->lmsno</lmsno>
    <manualno>$this->manualno</manualno>
    <purchasername>$this->purchasername</purchasername>
    <buyerregno>$this->buyerregno</buyerregno>
    <purchasertelephone>$this->purchasertelephone</purchasertelephone>
</OrderHead>
ETO;

        foreach ($goods as $value)
        {
            ++$gnum;
            $ORDER .= <<<ETO
<OrderList>
    <gnum>$gnum</gnum>
    <itemNo>{$value['itemno']}</itemNo>
    <itemName>{$value['goods_name']}</itemName>
    <itemDescribe></itemDescribe>
    <barCode></barCode>
    <unit>{$value['unit']}</unit>
    <qty>{$value['goods_number']}</qty>
    <price>{$value['goods_price']}</price>
    <totalPrice>{$value['totalPrice']}</totalPrice>
    <currency>$this->currency</currency>
    <country>{$value['sourceproducercountry']}</country>
    <note></note>
    <goodname></goodname>
    <specifications>{$value['specifications']}</specifications>
    <ciqbarcode>{$value['barcode']}</ciqbarcode>
    <flag>N</flag>
    <goodidinsp>$this->cbecodeinsp{$value['goodidinsp']}</goodidinsp>
    <orderid></orderid>
    <goodnameenglish></goodnameenglish>
    <weightunit></weightunit>
    <packcategoryinsp>4M</packcategoryinsp>
    <remarksinsp></remarksinsp>
    <coininsp>{$value['coininsp']}</coininsp>
    <unitinsp>{$value['unitinsp']}</unitinsp>
    <srccountryinsp>{$value['srccountryinsp']}</srccountryinsp>
    <gno>{$value['gno']}</gno>
</OrderList>
ETO;
        }

        $data = <<<ETO
<?xml version="1.0" encoding="UTF-8"?>
<ENT311Message xmlns="http://www.chinaport.gov.cn/ENT" guid="08c525c0-96d1-404c-8536-8767281b3030" version="v1.0" sendCode="sendcode" reciptCode="reciptcode">
    <Order>
        $ORDER
    </Order>
    <BaseTransfer>
        <copCode>$this->ebcCode</copCode>
        <copName>$this->ebcName</copName>
        <dxpMode>DXP</dxpMode>
        <dxpId>$this->dxpid</dxpId>
        <note></note>
    </BaseTransfer>
</ENT311Message>
ETO;

        return $data;
    }

    private function getOrderInfo()
    {
        $order = get_airport_info($this->orderId);

        $this->orderNo = $order['order_sn'];
        $this->goodsValue = $order['goods_amount'];
        $this->freight = $order['shipping_fee'];
        $this->otherfee = $order['other'];
        $this->taxTotal = $order['taxfee'];
        $this->acturalPaid = $this->ordersum = $order['order_amount'];
        $this->buyerRegNo = $this->consigneeTelephone = $this->buyerregno = $this->purchasertelephone = $order['mobile'];
        $this->buyerName = $this->consignee = $this->purchasername = $order['consignee'];
        $this->buyerIdNumber = $order['customerid'];
        $this->paynumber = $order['paymentNo'];
        $this->batchNumbers = $order['batchNumbers'];
        $this->consigneeAddress = $order['address'];
        $this->note = $order['note'];
        $this->submittime = $order['order_addtime'];
        $this->weight = $order['weight'];
        $this->netweight = $order['goods_netweight'];
        $this->countofgoodstype = $order['COUNTOFGOODSTYPE'];
    }

    private function getGoodsByOrderId()
    {
//        $sql = 'SELECT ag.*,o.origin_code,o.origin_code_insp,g.goods_netweight'
//                . ' FROM ' . $GLOBALS['ecs']->table('airport_goods') . ' ag'
//                . ' INNER JOIN ' . $GLOBALS['ecs']->table('goods') . ' g ON ag.GOODID=g.goods_sn'
//                . ' LEFT JOIN ' . $GLOBALS['ecs']->table('goods_origin') . ' o ON g.origin_id=o.origin_id'
//                . ' WHERE ag.cid = ' . $this->orderId;
//
//        return $GLOBALS['db']->getAll($sql);

        $sql = 'SELECT '
                . 'og.goods_price,'
                . 'og.goods_number,'
                . 'og.goods_price*og.goods_number AS totalPrice,'
                . 'g.*'
                . ' FROM ' . $GLOBALS['ecs']->table('airport_order') . ' ag'
                . ' INNER JOIN ' . $GLOBALS['ecs']->table('order_info') . ' o ON ag.order_sn=o.order_sn'
                . ' INNER JOIN ' . $GLOBALS['ecs']->table('order_goods') . ' og ON og.order_id=o.order_id'
                . ' INNER JOIN ' . $GLOBALS['ecs']->table('goods') . ' g ON og.goods_id=g.goods_id'
                . ' WHERE ag.id = ' . $this->orderId
                . ' ORDER BY g.itemno ASC';

        return $GLOBALS['db']->getAll($sql);
    }

}
