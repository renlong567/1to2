<?php

/**
 * @desc 小马过河仓储接口
 * @author RenLong
 * @date 2016-09-08
 */
if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

require_once ROOT_PATH . 'includes/modules/customs/customsCore.php';

class airportStorage extends customsCore
{

    public $orderId = 0;
    /* 系统参数说明 */
    public $SenderID = 1;  //客户编号 SenderID Int  必填    客户与公司正式签订合约后分配编号，测试时可使用默认编号 1。
    public $AppToken = '1234567890'; //AppToken 号 AppToken String  必填   客户与公司正式签订合约后分配，测试时可使用默认值 1234567890。
    public $AppKey = '1234567890';   //AppKey AppKey String  必填  客户与公司正式签订合约后分配，测试时可使用默认值 1234567890。
    public $Sign = '';     //验签值 Sign String  必填
    public $ActionID = 0; //动作编号 ActionID Int  必填 仅可取值为 0 或 1(1:新增 -1:取消)。
    public $Timestamp = '';        //时间戳 Timestamp DateTime  必填  当前时间(系统将对该时间与服务器时间进行比对，误差不得超过 5 分钟。
    /* 订单信息 */
    public $ECPCode = '';   //电商平台代码 ECPCode VarChar(20) 20   是
    public $ECPName = '';  //电商平台名称 ECPName VarChar(50) 50   是
    public $ECPCodeINSP = '';      //电商平台代码(检) ECPCodeINSP VarChar(20) 20   是
//    public $ECPNameINSP = '';      //电商平台名称(检) ECPNameINSP VarChar(50) 50   是
    public $CBECode = '';  //电商企业代码 CBECode VarChar(20) 20   是
    public $CBEName = '';  //电商企业名称 CBEName VarChar(50) 50   是
    public $ShopID = 12;   //店铺编号 ShopID int     是
    public $PlatformOrderNO = '';  //订单编号(平台) PlatformOrderNO VarChar(30) 30   是
    public $OrderTime = '';        //订单创建时间 OrderTime datetime       
    public $PayTime = '';  //支付时间 PayTime datetime       
    public $Totoal = '';   //订单总金额 Totoal Decimal(10,2) 10 2 是
    public $IDType = '';   //证件类型 IDType VarChar(10) 10   是
    public $IDNO = '';     //证件号码 IDNO VarChar(30) 30   是
    public $ConsigneeCountry = ''; //收货人所在国 ConsigneeCountry VarChar(50) 50     
    public $ConsigneeName = '';    //收货人名称 ConsigneeName varchar(200) 200   是
    public $C_Province = '';       //收货人所在省 C_Province VarChar(50) 50   是
    public $C_City = '';   //收货人所在市 C_City VarChar(50) 50   是
    public $C_Tel1 = '';   //收货人手机号 C_Tel1 VarChar(50) 50     
    public $C_Tel2 = '';   //收货人固话 C_Tel2 VarChar(50) 50     
    public $C_Zone = '';        //收货人所在区/县 C_Zone VarChar(50) 50   是
    public $C_ZIP = '';    //收货人邮编 C_ZIP VarChar(50) 50     
    public $C_Address1 = '';       //收货人所在地址 C_Address1 VarChar(200) 200   是
    public $Remark = '';   //备注信息 Remark VarChar(800) 800     
    public $InvoicePrintFlag = ''; //是否需要发票 InvoicePrintFlag bit     是
    public $DeliverCode = '';      //快递公司编号 DeliverCode VarChar(20) 20   是
    /* 订单明细信息 */
    public $GoodsID = '';   //单品ID GoodsID VarChar(20) 20   是
    public $ItemNO = '';   //海关备案编号 ItemNO VarChar(100) 100     
    public $GoodsName = '';        //单品名称 GoodsName VarChar(50) 50     
    public $Amount = '';    //成交数量 Amount int     是
    public $GoodsPrice = '';       //成交单价 GoodsPrice Decimal(10,2) 10 2 是
    public $OrderSum = ''; //成交总价 OrderSum Decimal(10,2) 10 2 是
    public $ChangeFlag = '';       //是否退换货 ChangeFlag bit     是
    public $GilfFlag = ''; //是否赠品 GilfFlag bit     是
    /* 发票信息 */
    public $Title = '';     //发票抬头 Title VarChar(20) 20   是
    public $Reference1 = '';       //电商平台的发票串号 Reference1 VarChar(50) 50   是
    public $SKU = '';      //产品名称 SKU VarChar(50) 50   是
    public $UOM = '';      //单位 UOM VarChar(10) 10   是
    public $QTY = '';      //数量 QTY Decimal(18,8) 18 8 是
    public $UnitPrice = '';        //单价 UnitPrice Decimal(18,8) 18 8 是
    public $Amount = '';   //小计 Amount Decimal(18,8) 18 8   
    public $TaxRate = '';  //税率 TaxRate Decimal(18,8) 18 8   
    public $TaxAmount = '';        //税额 TaxAmount Decimal(18,8) 18 8   
    public $SKUDescr = ''; //发票产品名称 SKUDescr VarChar(100) 100     
    public $DetalTitle = '';       //发票型号 DetalTitle VarChar(100) 100     
    public $Notes = '';    //备注 Notes VarChar(500) 500     
    public $UserDefine1 = '';      //自定义1 UserDefine1 VarChar(200) 200     
    public $UserDefine2 = '';      //自定义2 UserDefine2 VarChar(200) 200     
    public $UserDefine3 = '';      //自定义3 UserDefine3 VarChar(200) 200     
    public $UserDefine4 = '';      //自定义4 UserDefine4 VarChar(200) 200     
    public $UserDefine5 = '';      //自定义5 UserDefine5 VarChar(200) 200 

    public function __construct($_CFG)
    {
        $this->Url = 'http://wms1.chinapony.cn:88/ws/wsorder.asmx?WSDL';   //测试
        $this->location = 'http://wms1.chinapony.cn:88/ws/wsorder.asmx';   //测试
//        $this->Url = 'http://www.haeport.com:8081/DataInteractonWbs/webservice/wbs?wsdl';   //正式
//        $this->location = 'http://www.haeport.com:8081/DataInteractonWbs/webservice/wbs';   //正式

        $this->CBECode = $_CFG['cus_cbecode'];
        $this->CBEName = $_CFG['cus_cbename'];
        $this->ECPCode = $_CFG['cus_ecpcode'];
        $this->ECPName = $_CFG['cus_ecpname'];
        $this->TAXEDENTERPRISE = $_CFG['cus_taxedenterprise'];
        $this->CBECODEINSP = $_CFG['cus_cbecodeinsp'];
        $this->SENDERUSERCOUNTRY = $_CFG['cus_senderusercountry'];
        $this->SENDERUSERNAME = $_CFG['cus_senderusername'];
        $this->SENDERUSERADDRESS = $_CFG['cus_senderuseraddress'];
        $this->SENDERUSERTELEPHONE = $_CFG['cus_senderusertelephone'];
        $this->ECPCodeINSP = $_CFG['cus_ecpcodeinsp'];
        $this->TREPCODEINSP = $_CFG['cus_trepcodeinsp'];
        $this->TRADECOMPANY = $_CFG['cus_tradecompany'];
        $this->TOTALFEEUNIT = $_CFG['cus_totalfeeunit'];
        $this->COLLUSERCOUNTRYINSP = $_CFG['cus_collusercountryinsp'];
        $this->SENDUSERCOUNTRYINSP = $_CFG['cus_sendusercountryinsp'];
        $this->PAYENTERPRISECODE = $_CFG['cus_payenterprisecode'];
        $this->PAYENTERPRISENAME = $_CFG['cus_payenterprisename'];
        $this->LMSNO = $_CFG['cus_lmsno'];
        $this->MANUALNO = $_CFG['cus_manualno'];
        $this->DECLCODE = $_CFG['cus_declcode'];
        $this->DECLNAME = $_CFG['cus_declname'];
        $this->DEPOSITORGUARANTEE = $_CFG['cus_depositorguarantee'];
        $this->GUARANTEENO = $_CFG['cus_guaranteeno'];
    }

    public function send()
    {
        $message = $this->getCode();

        $batchNumber_path = empty($this->batchNumbers) ? '' : '/' . $this->batchNumbers;

        $this->createXml($this->ORDERID, $message, 'order' . $batchNumber_path);

        $data = array('xmlStr' => $message);
//        header('Content-type:text/xml');
//        print_r($message);
//        exit;
        $result = $this->sendToServer($data, 'payParse');

        return $this->revice($result);
    }

    /**
     * @desc 处理服务器返回信息
     * @author RenLong
     * @date 2015-12-10
     * @param xml $result
     * @return boolean
     */
    private function revice($result = '')
    {
        $result_xml = $result->return;
        $data = simplexml_load_string($result_xml);

        if (!empty($data))
        {
            if (!empty($data->MESSAGEBODY->BODYMASTER->NUMBER))
            {
                $orderSn = $data->MESSAGEBODY->BODYMASTER->NUMBER;
                $batchNumber_path = empty($this->batchNumbers) ? '' : '/' . $this->batchNumbers;
                $this->createXml($orderSn, $result_xml, 'order' . $batchNumber_path, 'receive');
                $where = 'order_sn=\'' . mysql_real_escape_string($orderSn) . '\'';
                $key = array(
                    'order_status', 'order_comments'
                );
            }
            else
            {
                return 'unknown error';
            }

            $sql = 'SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('airport_order') . ' WHERE ' . $where;
            $id = $GLOBALS['db']->getOne($sql);

            if ($id)
            {
                $data = array(
                    $key[0] => $data->MESSAGEBODY->BODYMASTER->FLAG == 'SUCCESS' ? 1 : 0,
                    $key[1] => mysql_real_escape_string($data->MESSAGEBODY->BODYMASTER->COMMENTS)
                );

                if ($GLOBALS['db']->autoExecute($GLOBALS['ecs']->table('airport_order'), $data, 'UPDATE', $where))
                {
                    return 'success';
                }
                else
                {
                    return 'fail';
                }
            }
            else
            {
                return 'notexist';
            }
        }
    }

    private function getCode()
    {
        $goods = $this->getGoodsByOrderId();

        $MESSAGEHEAD = <<<ETO
            <MESSAGEID>e2e175ce-6534-4b1a-b350-29fc79fe1249</MESSAGEID>
            <MESSAGETYPE>IEPT302</MESSAGETYPE>
            <SENDERID>1102013201</SENDERID>
            <RECEIVERID>0100</RECEIVERID>
            <SENDTIME>$this->time</SENDTIME>
            <SEQNO>14202004944</SEQNO>
ETO;
        /* 数组赋值  2015-6-25  WangMin editer:RenLong 2015-09-14 */
        $MESSAGEBODY = <<<ETO
        <BODYMASTER>
            <LMSNO>$this->LMSNO</LMSNO>
            <MANUALNO>$this->MANUALNO</MANUALNO>
            <CBECODE>$this->CBECODE</CBECODE>
            <CBENAME>$this->CBENAME</CBENAME>
            <ECPCODE>$this->ECPCODE</ECPCODE>
            <ECPNAME>$this->ECPNAME</ECPNAME>
            <PURCHASERNAME>$this->PURCHASERNAME</PURCHASERNAME>
            <BUYER_REG_NO>$this->BUYER_REG_NO</BUYER_REG_NO>
            <PURCHASERTELEPHONE>$this->PURCHASERTELEPHONE</PURCHASERTELEPHONE>
            <COLLECTIONUSERADDRESS>$this->COLLECTIONUSERADDRESS</COLLECTIONUSERADDRESS>
            <COLLECTIONUSERNAME>$this->COLLECTIONUSERNAME</COLLECTIONUSERNAME>
            <COLLECTIONUSERTELEPHONE>$this->COLLECTIONUSERTELEPHONE</COLLECTIONUSERTELEPHONE>
            <GOODSVALUE>$this->GOODSVALUE</GOODSVALUE>
            <ORDERID>$this->ORDERID</ORDERID>
            <ORDERSUM>$this->ORDERSUM</ORDERSUM>
            <CONSUMPTIONTAX>$this->CONSUMPTIONTAX</CONSUMPTIONTAX>
            <VAT>$this->VAT</VAT>
            <FREIGHT>$this->FREIGHT</FREIGHT>
            <OTHERFEE>$this->OTHERFEE</OTHERFEE>
            <REMARK>$this->REMARK</REMARK>
            <SENDERUSERCOUNTRY>$this->SENDERUSERCOUNTRY</SENDERUSERCOUNTRY>
            <SENDERUSERNAME>$this->SENDERUSERNAME</SENDERUSERNAME>
            <SENDERUSERADDRESS>$this->SENDERUSERADDRESS</SENDERUSERADDRESS>
            <SENDERUSERTELEPHONE>$this->SENDERUSERTELEPHONE</SENDERUSERTELEPHONE>
            <IDTYPE>$this->IDTYPE</IDTYPE>
            <CUSTOMERID>$this->CUSTOMERID</CUSTOMERID>
            <IETYPE>$this->IETYPE</IETYPE>
            <MODIFYMARK>$this->MODIFYMARK</MODIFYMARK>
            <BILLMODE>$this->BILLMODE</BILLMODE>
            <WASTERORNOT>$this->WASTERORNOT</WASTERORNOT>
            <BOTANYORNOT>$this->BOTANYORNOT</BOTANYORNOT>
            <TAXEDENTERPRISE>$this->TAXEDENTERPRISE</TAXEDENTERPRISE>
            <CBECODEINSP>$this->CBECODEINSP</CBECODEINSP>
            <ECPCODEINSP>$this->ECPCODEINSP</ECPCODEINSP>
            <TREPCODEINSP>$this->TREPCODEINSP</TREPCODEINSP>
            <SUBMITTIME>$this->SUBMITTIME</SUBMITTIME>
            <TRADECOMPANY>$this->TRADECOMPANY</TRADECOMPANY>
            <TOTALFEEUNIT>$this->TOTALFEEUNIT</TOTALFEEUNIT>
            <COUNTOFGOODSTYPE>$this->COUNTOFGOODSTYPE</COUNTOFGOODSTYPE>
            <WEIGHT>$this->WEIGHT</WEIGHT>
            <WEIGHTUNIT>$this->WEIGHTUNIT</WEIGHTUNIT>
            <NETWEIGHT>$this->NETWEIGHT</NETWEIGHT>
            <NETWEIGHTUNIT>$this->NETWEIGHTUNIT</NETWEIGHTUNIT>
            <PLATFORMURL>$this->PLATFORMURL</PLATFORMURL>
            <COLLUSERCOUNTRYINSP>$this->COLLUSERCOUNTRYINSP</COLLUSERCOUNTRYINSP>
            <SENDUSERCOUNTRYINSP>$this->SENDUSERCOUNTRYINSP</SENDUSERCOUNTRYINSP>
            <PAYNUMBER>$this->PAYNUMBER</PAYNUMBER>
            <PAYENTERPRISECODE>$this->PAYENTERPRISECODE</PAYENTERPRISECODE>
            <PAYENTERPRISENAME>$this->PAYENTERPRISENAME</PAYENTERPRISENAME>
            <OTHERPAYMENT>$this->OTHERPAYMENT</OTHERPAYMENT>
            <OTHERPAYMENTTYPE>$this->OTHERPAYMENTTYPE</OTHERPAYMENTTYPE>
            <LICENSE_NO>$this->LICENSE_NO</LICENSE_NO>
            <DECLARETYPE>$this->DECLARETYPE</DECLARETYPE>
            <DECLCODE>$this->DECLCODE</DECLCODE>
            <DECLNAME>$this->DECLNAME</DECLNAME>
            <DEPOSITORGUARANTEE>$this->DEPOSITORGUARANTEE</DEPOSITORGUARANTEE>
            <GUARANTEENO>$this->GUARANTEENO</GUARANTEENO>
            <EXTENDFIELD1>$this->EXTENDFIELD1</EXTENDFIELD1>
            <EXTENDFIELD2>$this->EXTENDFIELD2</EXTENDFIELD2>
            <EXTENDFIELD3>$this->EXTENDFIELD3</EXTENDFIELD3>
            <EXTENDFIELD4>$this->EXTENDFIELD4</EXTENDFIELD4>
            <EXTENDFIELD5>$this->EXTENDFIELD5</EXTENDFIELD5>
        </BODYMASTER>
ETO;

        $MESSAGEBODY .= '<BODYDETAIL>';
        foreach ($goods as $value)
        {
            $goods_netweight = $value['goods_number'] * $value['netweight'];
            if (false)
            {
                $value['goodidinsp'] = '5120124001AH14525';
            }
            $value['goodidinsp'] = $this->CBECODE{$value['goods_sn']};
            $MESSAGEBODY .= <<<ETO
                <ORDERLIST>
                    <GNO>{$value['GNO']}</GNO>
                    <ITEMNO>$this->ITEMNO</ITEMNO>
                    <SHELFGOODSNAME>{$value['goods_name']}</SHELFGOODSNAME>
                    <DESCRIBE></DESCRIBE>
                    <GOODID>{$value['goods_name']}</GOODID>
                    <GOODNAME>{$value['goods_name']}</GOODNAME>
                    <SPECIFICATIONS>{$value['specifications']}</SPECIFICATIONS>
                    <BARCODE>{$value['barcode']}</BARCODE>
                    <SOURCEPRODUCERCOUNTRY>{$value['sourceproducercountry']}</SOURCEPRODUCERCOUNTRY>
                    <COIN>{$value['coin']}</COIN>
                    <UNIT>{$value['unit']}</UNIT>
                    <UNIT1>{$value['unit']}</UNIT1>
                    <UNIT2>{$value['unit2']}</UNIT2>
                    <AMOUNT>{$value['goods_number']}</AMOUNT>
                    <AMOUNT1>{$value['goods_number']}</AMOUNT1>
                    <AMOUNT2>{$value['goods_number2']}</AMOUNT2>
                    <GOODPRICE>{$value['goods_price']}</GOODPRICE>
                    <ORDERSUM>{$value['goods_price']}</ORDERSUM>
                    <FLAG>N</FLAG>
                    <GOODIDINSP>{$value['goodidinsp']}</GOODIDINSP>
                    <ORDERID>$this->ORDERID</ORDERID>
                    <GOODNAMEENGLISH>{$value['goodnameenglish']}</GOODNAMEENGLISH>
                    <WEIGTH>{$value['weight']}</WEIGTH>
                    <WEIGHTUNIT>{$value['weightunit']}</WEIGHTUNIT>
                    <PACKCATEGORYINSP>4M</PACKCATEGORYINSP>
                    <WASTERORNOTINSP></WASTERORNOTINSP>
                    <REMARKSINSP></REMARKSINSP>
                    <COININSP>{$value['coininsp']}</COININSP>
                    <UNITINSP>{$value['unitinsp']}</UNITINSP>
                    <SRCCOUNTRYINSP>{$value['srccountryinsp']}</SRCCOUNTRYINSP>
                    <NETWEIGHT>$goods_netweight</NETWEIGHT>
                    <RESERVEDFIELD1></RESERVEDFIELD1>
                    <RESERVEDFIELD2></RESERVEDFIELD2>
                    <RESERVEDFIELD3></RESERVEDFIELD3>
                    <RESERVEDFIELD4></RESERVEDFIELD4>
                    <RESERVEDFIELD5></RESERVEDFIELD5>
                </ORDERLIST>
ETO;
        }
        $MESSAGEBODY .= '</BODYDETAIL>';

        $data = <<<ETO
<?xml version="1.0" encoding="UTF-8" ?>
    <CBECMESSAGE>
        <MESSAGEHEAD>
            $MESSAGEHEAD
        </MESSAGEHEAD>
        <MESSAGEBODY>
            $MESSAGEBODY
        </MESSAGEBODY>
    </CBECMESSAGE>
ETO;

        return $data;
    }

    private function getGoodsByOrderId()
    {
        $sql = 'SELECT og.goods_price,og.goods_number,g.*'
                . ' FROM ' . $GLOBALS['ecs']->table('airport_order') . ' ag'
                . ' INNER JOIN ' . $GLOBALS['ecs']->table('order_info') . ' o ON ag.order_sn=o.order_sn'
                . ' INNER JOIN ' . $GLOBALS['ecs']->table('order_goods') . ' og ON og.order_id=o.order_id'
                . ' INNER JOIN ' . $GLOBALS['ecs']->table('goods') . ' g ON og.goods_id=g.goods_id'
                . ' WHERE ag.id = ' . $this->orderId;

        return $GLOBALS['db']->getAll($sql);
    }

}
