<?php

/**
 * @desc 综保机场EMS运单报文类
 * @author RenLong
 * @date 2016-01-08
 * @version 1.0.4
 */
if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

require_once ROOT_PATH . 'includes/modules/customs/customsCore.php';

class airportEMS extends customsCore
{

    //电子运单报文头<Head>
    public $MessageID = ''; //   报文编号    VARCHAR2(30)    非空  每份报文唯一的编号，规则：报文类型+当前系统时间（YYYYMMDDHHMMSS）+4位序号
    public $MessageType = 200200;   // 报文类型    VARCHAR2(6) 非空  运单报文类型； 200200
    public $USERNAME = '';  //    认证用户名   VARCHAR2(20)    非空  
    public $Signature = ''; //   认证加密串   VARCHAR2(255)   非空  认证用户名+授权码+报文日期 通过MD5加密后的字符串
    public $SenderID = '';  //    接入客户编号  VARCHAR2(20)    非空  填写接入接口的编号；(填写接入方的客户代码)系统会根据此客户代码作校验，系统中不存在该客户代码，接口接不通
    public $SendTime = '';  //    报文日期    DATETIME    非空  YYYY-MM-DD HH24:MM:SS
    public $Version = '1.0';   // 报文版本号   VARCHAR2(10)    非空  默认：1.0
    public $key = '';
    //电子运单报文体<EWay>
    public $ORDERID = '';   //     订单编号    必填  50  数字+英文字母 
    public $DELIVERYENTERPRISECODE = '';    //  物流企业代码  必填  20  数字+英文字母 
    public $DELIVERYENTERPRISENAME = '';    //  物流企业名称  必填  50  汉字 
    public $TOTALTRANSFERNUMBER = '';   //     总运单号    必填  30  字符 
    public $TRANSFERNUMBER = '';    //  运单号     必填  30  字符  物流面单号 
    public $ECPCODE = '';   //     电商平台代码  必填  20  数字+英文字母 
    public $ECPNAME = '';   //     电商平台名称  必填  50  汉字 
    public $TRACKNO = '';   //     物流跟踪号   非必填     30  字符 
    public $TRACKSTATUS = '';   //     物流跟踪状态  非必填     1   字符 
    public $COLLECTIONUSERADDRESS = ''; //   收货人地址   必填  200     汉字 
    public $COLLECTIONUSERCOUNTRY = CONSIGNEE_COUNTRY_CUS; //   收货人国家   必填  3   字符 
    public $COLLECTIONUSERNAME = '';    //  收货人名称   必填  50  汉字 
    public $COLLECTIONUSERTELEPHONE = '';   //     收货人电话   必填  30  字符 
    public $SENDERUSERCOUNTRY = ''; //   发货人所在国  必填  3   字符 
    public $SENDERUSERNAME = '';    //  发货人的名称  非必填     50  汉字 
    public $SENDERUSERADDRESS = ''; //   发货人的地址  非必填     200     汉字 
    public $SENDERUSERTELEPHONE = '';   //     发货人电话   非必填     30  字符 
    public $IDTYPE = '';    //  证件类型    必填  10  字符  TOC001：身份证 
    public $CUSTOMERID = '';    //  证件号码    非必填     30  字符 
    public $DECLAREDATE = '';   //     申报日期    非必填     30  例：2015-05-26 17:54:30 
    public $CROSSFREIGHT = '';  //    跨境运费    非必填     10  数字，两位小数 
    public $FREIGHT = '';   //     境内运费    非必填     10  数字，两位小数 
    public $SUPPORTVALUE = '';  //    保价金额    非必填     10  数字 
    public $WEIGHT = '';    //  毛重(公斤)  必填  10  数字，4位小数 
    public $AMOUNT = '';    //  商品数量    必填  10  数字 
    public $PACKCATEGORY = PACKAGE_TYPE_CUS;  //    包装种类    必填  10  字符  包装种类代码 
    public $PACKNUM = 1;   //     件数  必填  10  数字 
    public $NETWEIGHT = ''; //   净重  必填  10  数字，4位小数 
    public $GOODSNAME = ''; //   商品名称    必填  200     汉字
    public $SHIPNAME = '';  //    运输工具名称  非必填     20  汉字 
    public $DESTINATIONPORT = '';   //     装运港/指运港     非必填     6   字符 
    public $IETYPE = 'I';    //  进出口标志   必填  1   字符  I-进口；E-出口 
    public $TRADECOUNTRY = '';  //    贸易国别    必填  3   字符 
    public $MODIFYMARK = '';    //  操作类型    必填  1   字符  1-新增；2-修改；3-删除 
    public $BUSINESSTYPE = 4;  //    快递类型    必填          1标准快递，4经济快递，5：国际快递
    public $REMARK = '';    //  备注  非必填     300     汉字 
    public $JCBORDERTIME = '';  //    进/出境日期  必填  30  例：2015-05-26 17:54:30 
    public $JCBORDERPORT = '';  //    进/出境口岸  必填  10  字符  海关口岸代码 
    public $TRANSFERTYPE = TRANSFER_TYPE;  //    运输方式代码  必填  10  字符 
    public $JCBORDERPORTINSP = '';  //    检验检疫进/出境口岸  必填  10  字符  为属地检验检疫机构代码 
    public $TRANSFERTYPEINSP = TRANSPORTATION_METHOD;  //    检验检疫运输方式代码  必填  10  字符  检验检疫运输方式代码 
    public $SHIPNAMEINSP = SHIP_NAME_INSP;  //    检验检疫运输工具名称  必填  20  汉字 
    public $SHIPCODEINSP = SHIP_CODE_INSP;  //    检验检疫运输工具代码  必填  10  字符  检验检疫运输工具代码 
    public $APPLYPORTINSP = ''; //   检验检疫申报口岸代码  必填  10  字符  为属地检验检疫机构代码 
    public $TRANSFERREGIONINSP = TRANSFER_REGION_INSP;    //  检验检疫起运国/抵运国     必填  10  字符  国别代码 
    public $PACKCATEGORYINSP = PACKAGE_TYPE_CIQ;  //    检验检疫包装种类    必填  10  字符  检验检疫包装种类 
    public $WLQYCODEINSP = '';  //    物流企业检验检疫备案编号    必填  50  英文字符+数字 
    public $CBECODEINSP = '';   //     电商企业检验检 疫备案编号    必填  50  英文字符+数字 
    public $COININSP = COIN_INSP;  //    币制（检验检疫代码）  必填  3   字符  检验检疫币制 
    public $CBECODE = '';   //     电商企业代码  必填  20  英文字符+数字 
    public $CBENAME = '';   //     电商企业名称  非必填     50  汉字 
    public $DECLAREPORT = '';   //     申报口岸    必填  4   字符  海关申报口岸 
    public $BILLMODE = '';  //    模式代码    非必填 1   字符  模式代码,1-一般模式；2-保税模式
    //接收订单号
    public $orderIdArr = array();

    public function __construct($_CFG)
    {
        $wsdlUrl = 'http://58.250.173.167:9020/zz_xzjcApiServer/LoadDataPortService?wsdl';   //测试
        $location = 'http://58.250.173.167:9020/zz_xzjcApiServer/LoadDataPortService';   //测试
//        $wsdlUrl = 'http://211.156.193.152:8080/zz_xzjcApiServer/LoadDataPortService?wsdl';   //正式
//        $location = 'http://211.156.193.152:8080/zz_xzjcApiServer/LoadDataPortService';   //正式

        $this->Url = $wsdlUrl;
        $this->location = $location;
        $this->time = local_date('YmdHis', $_SERVER['REQUEST_TIME']);
        $this->SendTime = local_date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);

        $this->USERNAME = $_CFG['cus_ems_USERNAME'];
        $this->SenderID = $_CFG['cus_ems_SenderID'];
        $this->key = $_CFG['cus_ems_key'];
        $this->CBECODE = $_CFG['cus_cbecode'];
        $this->CBENAME = $_CFG['cus_cbename'];
        $this->ECPCODE = $_CFG['cus_ecpcode'];
        $this->ECPNAME = $_CFG['cus_ecpname'];
        $this->CBECODEINSP = $_CFG['cus_cbecodeinsp'];
        $this->SENDERUSERCOUNTRY = $_CFG['cus_senderusercountry'];
        $this->SENDERUSERNAME = $_CFG['cus_senderusername'];
        $this->SENDERUSERADDRESS = $_CFG['cus_senderuseraddress'];
        $this->SENDERUSERTELEPHONE = $_CFG['cus_senderusertelephone'];
        $this->TRADECOUNTRY = $_CFG['cus_tradecompany'];
        $this->WLQYCODEINSP = $_CFG['cus_trepcodeinsp'];
        $this->DELIVERYENTERPRISECODE = $_CFG['cus_deliveryenterprisecode'];
        $this->DELIVERYENTERPRISENAME = $_CFG['cus_deliveryenterprisename'];
    }

    /**
     * @desc 发送报文
     * @author RenLong
     * @date 2015-12-05
     * @return xml
     */
    public function send()
    {
        //生成数据
        $message = $this->getCode();
//        header('Content-Type:text/xml');
//        echo $message;
        //提交报文
        $data = array('parameters' => $message);
        $result = $this->sendToServer($data, 'GetWaybillInfo', false);
        //保存报文XML
        $this->createXml($this->time, $message, 'EMS');
        //保存回执XML
        $this->createXml($this->time, $result, 'EMS', 'receive');
        //处理结果
        if ($this->revice($result))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @desc 处理服务器返回信息
     * @author RenLong
     * @date 2015-12-10
     * @param xml $result
     * @return boolean
     */
    private function revice($result)
    {
        $result = simplexml_load_string($result);

        switch ($result->Head->Result)
        {
            case 0:
                $sql = 'UPDATE ' . $GLOBALS['ecs']->table('airport_order') . ' SET transfer_status=CASE logisticsNo';
                foreach ($result->Body->Responses->Response as $value)
                {
                    switch ($value->V_STATUS)
                    {
                        case '入库成功':
                            $transfer_status = AIRPORT_CUSTOMS_OK;
                            break;
                        default:
                            $transfer_status = AIRPORT_CUSTOMS_FAIL;
                            break;
                    }
                    $sql .= sprintf(' WHEN \'%s\' THEN %d', $value->V_NO, $transfer_status);
                }
                $sql .=' END,transfer_comments=CASE logisticsNo';
                foreach ($result->Body->Responses->Response as $value)
                {
                    $sql .= sprintf(' WHEN \'%s\' THEN \'%s\'', $value->V_NO, $value->V_REMARK);
                }
                $sql .= ' END WHERE id IN(' . implode(',', $this->orderIdArr) . ')';
                break;

            default:
                $sql = 'UPDATE ' . $GLOBALS['ecs']->table('airport_order')
                        . ' SET '
                        . 'transfer_status=' . AIRPORT_CUSTOMS_FAIL . ','
                        . 'transfer_comments=\'' . $result->Head->Desc . '\''
                        . ' WHERE id IN(' . implode(',', $this->orderIdArr) . ')';
                break;
        }

        if ($GLOBALS['db']->query($sql))
        {
            return true;
        }

        return false;
    }

    /**
     * @desc 组合xml报文
     * @author RenLong
     * @date 2015-12-05
     * @return string
     */
    private function getCode()
    {
        $MESSAGEHEAD = $this->createHead();

        $MESSAGEBODY = $this->createEWay();

        $data = <<<ETO
<?xml version="1.0" encoding="UTF-8"?>
<Manifest>
    <Head>
        $MESSAGEHEAD
    </Head>
    <Declaration>
        <EWayList>
            $MESSAGEBODY
        </EWayList>
    </Declaration>
</Manifest>
ETO;

        return $data;
    }

    /**
     * @desc 生成头部信息
     * @author RenLong
     * @date 2015-12-05
     * @return string
     */
    private function createHead()
    {
        $this->MessageID = $this->MessageType . $this->time . mt_rand(1000, 9999);
        $this->Signature = md5($this->USERNAME . $this->key . $this->SendTime);

        $data = <<<ETO
<MessageID>$this->MessageID</MessageID>
<MessageType>$this->MessageType</MessageType>
<USERNAME>$this->USERNAME</USERNAME>
<Signature>$this->Signature</Signature>
<SenderID>$this->SenderID</SenderID>
<SendTime>$this->SendTime</SendTime>
<Version>$this->Version</Version>
ETO;

        return $data;
    }

    /**
     * @desc 生成body
     * @author RenLong
     * @date 2015-12-05
     * @return string
     */
    private function createEWay()
    {
        $data = '';
        $orderInfo = $this->getOrderInfo();
//        var_dump($orderInfo);exit;
        foreach ($orderInfo as $value)
        {
            $this->IDTYPE = $value['idtype'];

            $data .= <<<ETO
<EWay>
    <ORDERID>{$value['order_sn']}</ORDERID>
    <DELIVERYENTERPRISECODE>$this->DELIVERYENTERPRISECODE</DELIVERYENTERPRISECODE>
    <DELIVERYENTERPRISENAME>$this->DELIVERYENTERPRISENAME</DELIVERYENTERPRISENAME>
    <TOTALTRANSFERNUMBER>{$value['totalLogisticsNo']}</TOTALTRANSFERNUMBER>
    <TRANSFERNUMBER>{$value['logisticsNo']}</TRANSFERNUMBER>
    <ECPCODE>$this->ECPCODE</ECPCODE>
    <ECPNAME>$this->ECPNAME</ECPNAME>
    <TRACKNO>$this->TRACKNO</TRACKNO>
    <TRACKSTATUS>$this->TRACKSTATUS</TRACKSTATUS>
    <COLLECTIONUSERADDRESS>{$value['address']}</COLLECTIONUSERADDRESS>
    <COLLECTIONUSERCOUNTRY>$this->COLLECTIONUSERCOUNTRY</COLLECTIONUSERCOUNTRY>
    <COLLECTIONUSERNAME>{$value['consignee']}</COLLECTIONUSERNAME>
    <COLLECTIONUSERTELEPHONE>{$value['mobile']}</COLLECTIONUSERTELEPHONE>
    <SENDERUSERCOUNTRY>$this->SENDERUSERCOUNTRY</SENDERUSERCOUNTRY>
    <SENDERUSERNAME>$this->SENDERUSERNAME</SENDERUSERNAME>
    <SENDERUSERADDRESS>$this->SENDERUSERADDRESS</SENDERUSERADDRESS>
    <SENDERUSERTELEPHONE>$this->SENDERUSERTELEPHONE</SENDERUSERTELEPHONE>
    <IDTYPE>$this->IDTYPE</IDTYPE>
    <CUSTOMERID>{$value['consignee_idc']}</CUSTOMERID>
    <DECLAREDATE>$this->DECLAREDATE</DECLAREDATE>
    <CROSSFREIGHT>$this->CROSSFREIGHT</CROSSFREIGHT>
    <FREIGHT>$this->FREIGHT</FREIGHT>
    <SUPPORTVALUE>$this->SUPPORTVALUE</SUPPORTVALUE>
    <WEIGHT>{$value['weight']}</WEIGHT>
    <AMOUNT>{$value['quantity']}</AMOUNT>
    <PACKCATEGORY>$this->PACKCATEGORY</PACKCATEGORY>
    <PACKNUM>$this->PACKNUM</PACKNUM>
    <NETWEIGHT>{$value['netweight']}</NETWEIGHT>
    <GOODSNAME>{$value['GOODNAME']}</GOODSNAME>
    <SHIPNAME>$this->SHIPNAME</SHIPNAME>
    <DESTINATIONPORT>$this->DESTINATIONPORT</DESTINATIONPORT>
    <IETYPE>$this->IETYPE</IETYPE>
    <TRADECOUNTRY>$this->TRADECOUNTRY</TRADECOUNTRY>
    <MODIFYMARK>$this->MODIFYMARK</MODIFYMARK>
    <BUSINESSTYPE>$this->BUSINESSTYPE</BUSINESSTYPE>
    <REMARK>{$value['note']}</REMARK>
    <JCBORDERTIME>$this->JCBORDERTIME</JCBORDERTIME>
    <JCBORDERPORT>$this->JCBORDERPORT</JCBORDERPORT>
    <TRANSFERTYPE>$this->TRANSFERTYPE</TRANSFERTYPE>
    <JCBORDERPORTINSP>$this->JCBORDERPORTINSP</JCBORDERPORTINSP>
    <TRANSFERTYPEINSP>$this->TRANSFERTYPEINSP</TRANSFERTYPEINSP>
    <SHIPNAMEINSP>$this->SHIPNAMEINSP</SHIPNAMEINSP>
    <SHIPCODEINSP>$this->SHIPCODEINSP</SHIPCODEINSP>
    <APPLYPORTINSP>$this->APPLYPORTINSP</APPLYPORTINSP>
    <TRANSFERREGIONINSP>$this->TRANSFERREGIONINSP</TRANSFERREGIONINSP>
    <PACKCATEGORYINSP>$this->PACKCATEGORYINSP</PACKCATEGORYINSP>
    <WLQYCODEINSP>$this->WLQYCODEINSP</WLQYCODEINSP>
    <CBECODEINSP>$this->CBECODEINSP</CBECODEINSP>
    <COININSP>$this->COININSP</COININSP>
    <CBECODE>$this->CBECODE</CBECODE>
    <CBENAME>$this->CBENAME</CBENAME>
    <DECLAREPORT>$this->DECLAREPORT</DECLAREPORT>
    <BILLMODE>$this->BILLMODE</BILLMODE>
</EWay>
ETO;
        }

        return $data;
    }

    /**
     * @desc 获取订单信息
     * @author RenLong
     * @date 2015-12-05
     * @return array
     */
    private function getOrderInfo()
    {
        $sql = 'SELECT '
                . 'ao.*,'
                . 'o.idtype,'
                . 'SUM(g.goods_weight*og.goods_number) as weight,'
                . 'g.goods_name,'
                . 'COUNT(*) as quantity '
                . 'FROM ' . $GLOBALS['ecs']->table('airport_order') . ' ao '
                . 'INNER JOIN ' . $GLOBALS['ecs']->table('order_info') . ' o ON ao.order_sn=o.order_sn '
                . 'INNER JOIN ' . $GLOBALS['ecs']->table('order_goods') . ' og ON o.order_id=og.order_id '
                . 'INNER JOIN ' . $GLOBALS['ecs']->table('goods') . ' g ON g.goods_id=og.goods_id '
                . ' WHERE ao.id IN(' . implode(',', $this->orderIdArr) . ')'
                . ' GROUP BY ao.order_sn';

        return $GLOBALS['db']->getAll($sql);
    }

}
