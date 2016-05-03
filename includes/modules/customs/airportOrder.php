<?php

/**
 * @desc进出口订单信息类属性定义
 * @author WangMin
 * @date 2015-06-23
 */
if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

require_once ROOT_PATH . 'includes/modules/customs/customsCore.php';

class airportOrder extends customsCore
{

    public $orderId = 0;
    public $ITEMNO = '';
    public $CBECODE = COMPANY_CUSTOMS_NUMBER;
    public $CBENAME = COMPANY_NAME;
    public $ECPCODE = COMPANY_CUSTOMS_NUMBER;
    public $ECPNAME = COMPANY_NAME;
    public $PURCHASERNAME = ''; //订购人名称
    public $BUYER_REG_NO = '';  //订购人注册号
    public $PURCHASERTELEPHONE = '';   //订购人电话
    public $COLLECTIONUSERADDRESS = '';
    public $COLLECTIONUSERNAME = '';
    public $COLLECTIONUSERTELEPHONE = '';
    public $GOODSVALUE = 0;
    public $ORDERID = '';
    public $ORDERSUM = 0;
    public $CONSUMPTIONTAX = '';
    public $VAT = '';
    public $FREIGHT = '';
    public $OTHERFEE = '';
    public $REMARK = '';
    public $SENDERUSERCOUNTRY = '';
    public $SENDERUSERNAME = '';
    public $SENDERUSERADDRESS = '';
    public $SENDERUSERTELEPHONE = '';
    public $IDTYPE = '';    //订购人证件类型
    public $CUSTOMERID = '';    //订购人证件号码
    public $IETYPE = 'I';
    public $MODIFYMARK = '';
    public $BILLMODE = '';   //模式代码 1： 一般模式(集货) 2： 保税模式(备货)
    public $WASTERORNOT = 'N';
    public $BOTANYORNOT = 'N';
    public $TAXEDENTERPRISE = COMPANY_CUSTOMS_NUMBER;
    public $CBECODEINSP = CBE_CODE_INSP;
    public $ECPCODEINSP = ECP_CODE_INSP;
    public $TREPCODEINSP = TREP_CODE_INSP;
    public $SUBMITTIME = '';
    public $TRADECOMPANY = ''; //检验检疫-贸易国别-澳大利亚
    public $TOTALFEEUNIT = COIN_INSP;
    public $COUNTOFGOODSTYPE = '';
    public $WEIGHT = 0;
    public $WEIGHTUNIT = '035';
    public $NETWEIGHT = 0;
    public $NETWEIGHTUNIT = '035';
    public $PLATFORMURL = 'zzhy.com';
    public $COLLUSERCOUNTRYINSP = '';
    public $SENDUSERCOUNTRYINSP = CONSIGNEE_COUNTRY_CIQ;
    public $PAYNUMBER = '';
    public $PAYENTERPRISECODE = '';
    public $PAYENTERPRISENAME = '';
    public $OTHERPAYMENT = 0;
    public $OTHERPAYMENTTYPE = '';
    public $LMSNO = ''; //S账册编号
    public $MANUALNO = ''; //H账册编号
    public $LICENSE_NO = ''; //  许可证号    非必填 50  字符  出口必填
    public $DECLCODE = '4101985808'; // 郑州市程驰速递有限公司  报关企业海关备案编码  必填  20  字符
    public $DECLARETYPE = '';
    public $DECLNAME = '';
    public $DEPOSITORGUARANTEE = 0; //保金保函类型 进口必填 保金保函类型【0-担保金，1-保函】 一般进口模式只能填写0；保税模式可以选择填写 0 或 1，出口为非必填
    public $GUARANTEENO = '';
    public $EXTENDFIELD1 = '';
    public $EXTENDFIELD2 = '';
    public $EXTENDFIELD3 = '';
    public $EXTENDFIELD4 = '';
    public $EXTENDFIELD5 = '';

    public function __construct()
    {
//        $this->Url = 'http://171.12.5.86:83/DataInteractonWbs/webservice/wbs?wsdl';   //测试
//        $this->location = 'http://171.12.5.86:83/DataInteractonWbs/webservice/wbs';   //测试
    }

    public function send()
    {
        $message = $this->getCode();

        $this->createXml($this->ORDERID, $message);

//        $data = array('xmlStr' => $message);
//        header('Content-type:text/xml');
//        print_r($message);
//        exit;
//        return $this->sendToServer($data, 'payParse');
    }

    private function getCode()
    {
        $goods = $this->getGoodsByOrderId();

//        if (true)
//        {
//            $this->PAYENTERPRISECODE = 'P461263355';
//            $this->PAYENTERPRISENAME = '美华有限公司';
//            $this->ECPCODE = $this->TAXEDENTERPRISE = 'W461287621';
//            $this->ECPNAME = '美华有限公司';
//            $this->CBECODE = 'D461241432';
//            $this->CBENAME = '美华有限公司';
//            $this->CBECODEINSP = '5122343433';
//            $this->ECPCODEINSP = '5122343433';
//            $this->ITEMNO = 'D461241432LLQY001997';
//            $this->LMSNO = 'S4612I696715';
//            $this->DECLCODE = '6546646456';
//            $this->DECLNAME = '美华报关';
//        }

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
            $goods_netweight = $value['AMOUNT'] * $value['goods_netweight'];

            $MESSAGEBODY .= <<<ETO
                <ORDERLIST>
                    <GNO>{$value['GNO']}</GNO>
                    <ITEMNO>$this->CBECODE{$value['GOODID']}</ITEMNO>
                    <SHELFGOODSNAME>{$value['SHELFGOODSNAME']}</SHELFGOODSNAME>
                    <DESCRIBE></DESCRIBE>
                    <GOODID>{$value['GOODID']}</GOODID>
                    <GOODNAME>{$value['GOODNAME']}</GOODNAME>
                    <SPECIFICATIONS>{$value['SPECIFICATIONS']}</SPECIFICATIONS>
                    <BARCODE>{$value['BARCODE']}</BARCODE>
                    <SOURCEPRODUCERCOUNTRY>{$value['origin_code']}</SOURCEPRODUCERCOUNTRY>
                    <COIN>142</COIN>
                    <UNIT>{$value['UNIT']}</UNIT>
                    <UNIT1>{$value['UNIT']}</UNIT1>
                    <UNIT2>{$value['UNIT2']}</UNIT2>
                    <AMOUNT>{$value['AMOUNT']}</AMOUNT>
                    <AMOUNT1>{$value['AMOUNT']}</AMOUNT1>
                    <AMOUNT2>{$value['AMOUNT2']}</AMOUNT2>
                    <GOODPRICE>{$value['GOODPRICE']}</GOODPRICE>
                    <ORDERSUM>{$value['ORDERSUM']}</ORDERSUM>
                    <FLAG>N</FLAG>
                    <GOODIDINSP>$this->CBECODEINSP{$value['GOODID']}</GOODIDINSP>
                    <ORDERID>{$value['ORDERID']}</ORDERID>
                    <GOODNAMEENGLISH></GOODNAMEENGLISH>
                    <WEIGTH></WEIGTH>
                    <WEIGHTUNIT></WEIGHTUNIT>
                    <PACKCATEGORYINSP>4M</PACKCATEGORYINSP>
                    <WASTERORNOTINSP></WASTERORNOTINSP>
                    <REMARKSINSP></REMARKSINSP>
                    <COININSP>156</COININSP>
                    <UNITINSP>{$value['UNIT']}</UNITINSP>
                    <SRCCOUNTRYINSP>036</SRCCOUNTRYINSP>
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
        $sql = 'SELECT ag.*,o.origin_code,g.goods_netweight'
                . ' FROM ' . $GLOBALS['ecs']->table('airport_goods') . ' ag'
                . ' INNER JOIN ' . $GLOBALS['ecs']->table('goods') . ' g ON ag.GOODID=g.goods_sn'
                . ' LEFT JOIN ' . $GLOBALS['ecs']->table('goods_origin') . ' o ON g.origin_id=o.origin_id'
                . ' WHERE ag.cid = ' . $this->orderId;

        return $GLOBALS['db']->getAll($sql);
    }

}
