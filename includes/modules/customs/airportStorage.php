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
    public $ECPNameINSP = '';      //电商平台名称(检) ECPNameINSP VarChar(50) 50   是
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
    public $InvoicePrintFlag = 'False'; //是否需要发票 InvoicePrintFlag bit     是
    public $DeliverCode = 'ZTO';      //快递公司编号 DeliverCode VarChar(20) 20   是
    /* 订单明细信息 */
    public $GoodsID = '';   //单品ID GoodsID VarChar(20) 20   是
    public $ItemNO = '';   //海关备案编号 ItemNO VarChar(100) 100     
    public $GoodsName = '';        //单品名称 GoodsName VarChar(50) 50     
    public $Amount = '';    //成交数量 Amount int     是
    public $GoodsPrice = '';       //成交单价 GoodsPrice Decimal(10,2) 10 2 是
    public $OrderSum = ''; //成交总价 OrderSum Decimal(10,2) 10 2 是
    public $ChangeFlag = 'False';       //是否退换货 ChangeFlag bit     是
    public $GilfFlag = 'False'; //是否赠品 GilfFlag bit     是

    /* 发票信息 */

//    public $Title = '';     //发票抬头 Title VarChar(20) 20   是
//    public $Reference1 = '';       //电商平台的发票串号 Reference1 VarChar(50) 50   是
//    public $SKU = '';      //产品名称 SKU VarChar(50) 50   是
//    public $UOM = '';      //单位 UOM VarChar(10) 10   是
//    public $QTY = '';      //数量 QTY Decimal(18,8) 18 8 是
//    public $UnitPrice = '';        //单价 UnitPrice Decimal(18,8) 18 8 是
//    public $Amount = '';   //小计 Amount Decimal(18,8) 18 8   
//    public $TaxRate = '';  //税率 TaxRate Decimal(18,8) 18 8   
//    public $TaxAmount = '';        //税额 TaxAmount Decimal(18,8) 18 8   
//    public $SKUDescr = ''; //发票产品名称 SKUDescr VarChar(100) 100     
//    public $DetalTitle = '';       //发票型号 DetalTitle VarChar(100) 100     
//    public $Notes = '';    //备注 Notes VarChar(500) 500     
//    public $UserDefine1 = '';      //自定义1 UserDefine1 VarChar(200) 200     
//    public $UserDefine2 = '';      //自定义2 UserDefine2 VarChar(200) 200     
//    public $UserDefine3 = '';      //自定义3 UserDefine3 VarChar(200) 200     
//    public $UserDefine4 = '';      //自定义4 UserDefine4 VarChar(200) 200     
//    public $UserDefine5 = '';      //自定义5 UserDefine5 VarChar(200) 200 

    public function __construct($_CFG)
    {
        $this->Url = 'http://wms1.chinapony.cn:88/ws/wsorder.asmx?WSDL';   //测试
        $this->location = 'http://wms1.chinapony.cn:88/ws/wsorder.asmx';   //测试
//        $this->Url = 'http://www.haeport.com:8081/DataInteractonWbs/webservice/wbs?wsdl';   //正式
//        $this->location = 'http://www.haeport.com:8081/DataInteractonWbs/webservice/wbs';   //正式
        $this->Timestamp = $_SERVER['REQUEST_TIME'];

        $this->CBECode = $_CFG['cus_cbecode'];
        $this->CBEName = $_CFG['cus_cbename'];
        $this->ECPCode = $_CFG['cus_ecpcode'];
        $this->ECPName = $_CFG['cus_ecpname'];
        $this->ECPNameINSP = $_CFG['cus_ecpname'];
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
        print_r($message);
//        $this->createXml($this->PlatformOrderNO, $message, 'st');
        $data = array('message' => $message);
//        header('Content-type:text/xml');
//        print_r($message);
//        exit;
        $result = $this->sendToServer($data, 'Recive');
        print_r($result);
        exit;
//        return $this->revice($result);
    }

    private function getCode()
    {
        $Details = array();
        $goods = $this->getGoodsByOrderId();

        foreach ($goods as $key => $value)
        {
            $Details['OrderDetail'][$key]['GoodsID'] = $value['goods_sn'];
            $Details['OrderDetail'][$key]['ItemNO'] = $value['itemno'];
            $Details['OrderDetail'][$key]['GoodsName'] = $value['goodname'];
            $Details['OrderDetail'][$key]['Amount'] = $value['goods_number'];
            $Details['OrderDetail'][$key]['GoodsPrice'] = $value['goods_price'];
            $Details['OrderDetail'][$key]['OrderSum'] = $value['OrderSum'];
            $Details['OrderDetail'][$key]['ChangeFlag'] = $this->ChangeFlag;
            $Details['OrderDetail'][$key]['GilfFlag'] = $this->GilfFlag;
        }

        $MESSAGEBODY = array(
            'Order' => array(
                'ECPCode' => $this->ECPCode,
                'ECPName' => $this->ECPName,
                'ECPCodeINSP' => $this->ECPCodeINSP,
                'ECPNameINSP' => $this->ECPNameINSP,
                'CBECode' => $this->CBECode,
                'CBEName' => $this->CBEName,
                'ShopID' => $this->ShopID,
                'PlatformOrderNO' => $this->PlatformOrderNO,
                'OrderTime' => $this->OrderTime,
                'PayTime' => $this->PayTime,
                'Totoal' => $this->Totoal,
                'IDType' => $this->IDType,
                'IDNO' => $this->IDNO,
                'ConsigneeCountry' => $this->ConsigneeCountry,
                'ConsigneeName' => $this->ConsigneeName,
                'C_Province' => $this->C_Province,
                'C_City' => $this->C_City,
                'C_Tel1' => $this->C_Tel1,
                'C_Tel2' => $this->C_Tel2,
                'C_Zone' => $this->C_Zone,
                'C_ZIP' => $this->C_ZIP,
                'C_Address1' => $this->C_Address1,
                'Remark' => $this->Remark,
                'InvoicePrintFlag' => $this->InvoicePrintFlag,
                'DeliverCode' => $this->DeliverCode,
            ),
            'Details' => $Details,
            'Invoices' => '',
        );

        $str = $this->createSign($goods);
        $this->Sign = strtoupper(base64_encode(md5($str)));
        var_dump($this->Sign);
        var_dump(md5($str));
//        exit;
        $data = array(
            'Head' => array(
                'SenderID' => $this->SenderID,
                'Apptoken' => $this->AppToken,
                'Appkey' => $this->AppKey,
                'Sign' => $this->Sign,
                'ActionID' => $this->ActionID,
                'Timestamp' => $this->Timestamp,
            ),
            'Body' => $MESSAGEBODY,
        );

        return $data;
    }

    private function createSign($goods)
    {
        $Timestamp = local_date('Y-m-d H:i:s', $this->Timestamp);
        $this->OrderTime = local_date('Y-m-d H:i:s', $this->OrderTime);
        $this->PayTime = local_date('Y-m-d H:i:s', $this->PayTime);

        $MESSAGEBODY = "<AppSecret>1234567890</AppSecret>" . PHP_EOL;
        $MESSAGEBODY .= "<ActionID>$this->ActionID</ActionID>" . PHP_EOL;
        $MESSAGEBODY .= "<Timestamp>$Timestamp</Timestamp>" . PHP_EOL;
        $MESSAGEBODY .= "<Data>" . PHP_EOL;
        $MESSAGEBODY .= "<OrderInfo>" . PHP_EOL;
        $MESSAGEBODY .= "<ECPCode>$this->ECPCode</ECPCode>" . PHP_EOL;
        $MESSAGEBODY .= "<ECPName>$this->ECPName</ECPName>" . PHP_EOL;
        $MESSAGEBODY .= "<ECPCodeINSP>$this->ECPCodeINSP</ECPCodeINSP>" . PHP_EOL;
        $MESSAGEBODY .= "<ECPNameINSP>$this->ECPNameINSP</ECPNameINSP>" . PHP_EOL;
        $MESSAGEBODY .= "<CBECode>$this->CBECode</CBECode>" . PHP_EOL;
        $MESSAGEBODY .= "<CBEName>$this->CBEName</CBEName>" . PHP_EOL;
        $MESSAGEBODY .= "<ShopID>$this->ShopID</ShopID>" . PHP_EOL;
        $MESSAGEBODY .= "<PlatformOrderNO>$this->PlatformOrderNO</PlatformOrderNO>" . PHP_EOL;
        $MESSAGEBODY .= "<OrderTime>$this->OrderTime</OrderTime>" . PHP_EOL;
        $MESSAGEBODY .= "<PayTime>$this->PayTime</PayTime>" . PHP_EOL;
        $MESSAGEBODY .= "<Totoal>$this->Totoal</Totoal>" . PHP_EOL;
        $MESSAGEBODY .= "<IDType>$this->IDType</IDType>" . PHP_EOL;
        $MESSAGEBODY .= "<IDNO>$this->IDNO</IDNO>" . PHP_EOL;
        $MESSAGEBODY .= "<ConsigneeCountry>$this->ConsigneeCountry</ConsigneeCountry>" . PHP_EOL;
        $MESSAGEBODY .= "<ConsigneeName>$this->ConsigneeName</ConsigneeName>" . PHP_EOL;
        $MESSAGEBODY .= "<C_Province>$this->C_Province</C_Province>" . PHP_EOL;
        $MESSAGEBODY .= "<C_City>$this->C_City</C_City>" . PHP_EOL;
        $MESSAGEBODY .= "<C_Tel1>$this->C_Tel1</C_Tel1>" . PHP_EOL;
        $MESSAGEBODY .= "<C_Tel2>$this->C_Tel2</C_Tel2>" . PHP_EOL;
        $MESSAGEBODY .= "<C_Zone>$this->C_Zone</C_Zone>" . PHP_EOL;
        $MESSAGEBODY .= "<C_ZIP>$this->C_ZIP</C_ZIP>" . PHP_EOL;
        $MESSAGEBODY .= "<C_Address1>$this->C_Address1</C_Address1>" . PHP_EOL;
        $MESSAGEBODY .= "<Remark>$this->Remark</Remark>" . PHP_EOL;
        $MESSAGEBODY .= "<InvoicePrintFlag>$this->InvoicePrintFlag</InvoicePrintFlag>" . PHP_EOL;
        $MESSAGEBODY .= "<DeliverCode>$this->DeliverCode</DeliverCode>" . PHP_EOL;
        $MESSAGEBODY .= "</OrderInfo>" . PHP_EOL;
        $MESSAGEBODY .= "<Details>" . PHP_EOL;

        foreach ($goods as $value)
        {
            $MESSAGEBODY .= "<OrderDetail>" . PHP_EOL;
            $MESSAGEBODY .= "<GoodsID>{$value['goods_sn']}</GoodsID>" . PHP_EOL;
            $MESSAGEBODY .= "<ItemNO>{$value['itemno']}</ItemNO>" . PHP_EOL;
            $MESSAGEBODY .= "<GoodsName>{$value['goodname']}</GoodsName>" . PHP_EOL;
            $MESSAGEBODY .= "<Amount>{$value['goods_number']}</Amount>" . PHP_EOL;
            $MESSAGEBODY .= "<GoodsPrice>{$value['goods_price']}</GoodsPrice>" . PHP_EOL;
            $MESSAGEBODY .= "<OrderSum>{$value['OrderSum']}</OrderSum>" . PHP_EOL;
            $MESSAGEBODY .= "<ChangeFlag>$this->ChangeFlag</ChangeFlag>" . PHP_EOL;
            $MESSAGEBODY .= "<GilfFlag>$this->GilfFlag</GilfFlag>" . PHP_EOL;
            $MESSAGEBODY .= "</OrderDetail>" . PHP_EOL;
        }
        $MESSAGEBODY .= "</Details>" . PHP_EOL;
        $MESSAGEBODY .= "<Invoices>" . PHP_EOL;
        $MESSAGEBODY .= "</Invoices>" . PHP_EOL;
        $MESSAGEBODY .= "</Data>" . PHP_EOL;

        return $MESSAGEBODY;
    }

    private function getGoodsByOrderId()
    {
        $sql = 'SELECT '
                . 'g.*,'
                . 'og.goods_price,'
                . 'og.goods_number,'
                . 'og.goods_price * og.goods_number AS OrderSum'
                . ' FROM ' . $GLOBALS['ecs']->table('airport_order') . ' ag'
                . ' INNER JOIN ' . $GLOBALS['ecs']->table('order_info') . ' o ON ag.order_sn=o.order_sn'
                . ' INNER JOIN ' . $GLOBALS['ecs']->table('order_goods') . ' og ON og.order_id=o.order_id'
                . ' INNER JOIN ' . $GLOBALS['ecs']->table('goods') . ' g ON og.goods_id=g.goods_id'
                . ' WHERE ag.id = ' . $this->orderId;

        return $GLOBALS['db']->getAll($sql);
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
                    'st_status', 'st_comments'
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

}
