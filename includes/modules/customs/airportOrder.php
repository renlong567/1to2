<?php

/**
 * @desc 进出口订单信息类属性定义
 * @author RenLong
 * @date 2016-05-04
 */
if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

require_once ROOT_PATH . 'includes/modules/customs/customsCore.php';

class airportOrder extends customsCore
{

    public $orderId = 0;
    public $batchNumbers = '';
    public $ITEMNO = '';
    public $CBECODE = '';
    public $CBENAME = '';
    public $ECPCODE = '';
    public $ECPNAME = '';
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
    public $TAXEDENTERPRISE = '';
    public $CBECODEINSP = '';
    public $ECPCODEINSP = '';
    public $TREPCODEINSP = '';
    public $SUBMITTIME = '';
    public $TRADECOMPANY = ''; //检验检疫-贸易国别-澳大利亚
    public $TOTALFEEUNIT = '';
    public $COUNTOFGOODSTYPE = '';
    public $WEIGHT = 0;
    public $WEIGHTUNIT = '035';
    public $NETWEIGHT = 0;
    public $NETWEIGHTUNIT = '035';
    public $PLATFORMURL = '';
    public $COLLUSERCOUNTRYINSP = '';
    public $SENDUSERCOUNTRYINSP = '';
    public $PAYNUMBER = '';
    public $PAYENTERPRISECODE = '';
    public $PAYENTERPRISENAME = '';
    public $OTHERPAYMENT = 0;
    public $OTHERPAYMENTTYPE = '';
    public $LMSNO = ''; //S账册编号
    public $MANUALNO = ''; //H账册编号
    public $LICENSE_NO = ''; //  许可证号    非必填 50  字符  出口必填
    public $DECLCODE = ''; // 郑州市程驰速递有限公司  报关企业海关备案编码  必填  20  字符
    public $DECLARETYPE = '';
    public $DECLNAME = '';
    public $DEPOSITORGUARANTEE = 0; //保金保函类型 进口必填 保金保函类型【0-担保金，1-保函】 一般进口模式只能填写0；保税模式可以选择填写 0 或 1，出口为非必填
    public $GUARANTEENO = '';
    public $EXTENDFIELD1 = '';
    public $EXTENDFIELD2 = '';
    public $EXTENDFIELD3 = '';
    public $EXTENDFIELD4 = '';
    public $EXTENDFIELD5 = '';

    public function __construct($_CFG)
    {
        $this->Url = 'http://171.12.5.86:83/DataInteractonWbs/webservice/wbs?wsdl';   //测试
        $this->location = 'http://171.12.5.86:83/DataInteractonWbs/webservice/wbs';   //测试
        
        $this->CBECODE = $_CFG['cus_cbecode'];
        $this->CBENAME = $_CFG['cus_cbename'];
        $this->ECPCODE = $_CFG['cus_ecpcode'];
        $this->ECPNAME = $_CFG['cus_ecpname'];
        $this->TAXEDENTERPRISE = $_CFG['cus_taxedenterprise'];
        $this->CBECODEINSP = $_CFG['cus_cbecodeinsp'];
        $this->SENDERUSERCOUNTRY = $_CFG['cus_senderusercountry'];
        $this->SENDERUSERNAME = $_CFG['cus_senderusername'];
        $this->SENDERUSERADDRESS = $_CFG['cus_senderuseraddress'];
        $this->SENDERUSERTELEPHONE = $_CFG['cus_senderusertelephone'];
        $this->ECPCODEINSP = $_CFG['cus_ecpcodeinsp'];
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

        //综保区测试数据
        if (true)
        {
            $this->PAYENTERPRISECODE = 'P461263461';
            $this->PAYENTERPRISENAME = '测试支付企业';
            $this->ECPCODE = $this->TAXEDENTERPRISE = 'W461224549';
            $this->ECPNAME = '测试电商企业';
            $this->CBECODE = 'D461288464';
            $this->CBENAME = '测试电商企业';
            $this->CBECODEINSP = '3697899510';
            $this->ECPCODEINSP = '3697899510';
            $this->ITEMNO = 'D461274638AH14525';
            $this->LMSNO = 'S4612I696715';
            $this->DECLCODE = '4101983536';
            $this->DECLNAME = '测试报关';
        }

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
            if(true)
            {
                $value['goodidinsp'] = '5120124001AH14525';
            }
//            $this->CBECODE{$value['goods_sn']}
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
