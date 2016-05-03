<?php

/**
 * @desc 报关公共方法类
 * @author RenLong
 * @date 2015-06-25
 */
class customsCore
{

    public $time = 0;
    protected $location = ''; //数据地址
    protected $Url = ''; //接口WSDL地址

    /**
     * @desc soap发送数据
     * @author RenLong
     * @date 2015-06-26
     * @param array $data
     * @param string $func 调用服务名
     * @param string $isWsdl 是否使用wsdl模式
     * @return 服务器返回结果
     */

    protected function sendToServer($data, $func = 'receive', $isWsdl = true)
    {
        try
        {
            switch ($isWsdl)
            {
                //wsdl模式
                case true:
                    $options = array(
                        "location" => $this->location,
                        "style" => SOAP_DOCUMENT,
                        "trace" => 1,
                        "connection_timeout" => 200,
                    );

                    $client = new SoapClient($this->Url, $options); //使用 wsdl方式
//                    var_dump($client->__getFunctions());
                    $receive = $client->$func($data);
                    break;

                //non-wsdl模式
                default:
                    $soap = new SoapClient(null, array('location' => $this->location, 'uri' => $this->Url));
//                    两种调用方式，直接调用方法，和用__soapCall简接调用
//                    $result1 = $soap->getName();
                    $receive = $soap->__soapCall($func, $data);
                    break;
            }

            return $receive;
        }
        catch (Exception $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * @desc post发送数据
     * @author RenLong
     * @date 2015-06-29
     * @param array $data
     * @return 服务器返回结果
     */
    protected function postToServer($data, $post = true)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->Url);
        // curl_setopt($ch,CURLOPT_TIMEOUT,10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        return curl_exec($ch);
    }

    /**
     * @desc 写入xml
     * @author RenLong
     * @date 2015-10-29
     * @param type $orderSn
     * @param type $data
     */
    protected function createXml($orderSn, $data, $type = 'order')
    {
        file_put_contents(ROOT_PATH . 'data/customs/airport/send/' . $type . '/' . $orderSn . '.xml', $data);
    }

    /**
     * @desc 金额转化单位为分
     * @param int $param
     * @param int $val
     * @param boolean $type
     * @return float
     */
    protected function amount_format($param = 0, $val = 100, $type = true)
    {
        $amount = 0;

        switch ($type)
        {
            case true:
                $amount = $param * $val;
                break;
            case false:
                $amount = $param / $val;
                break;
        }

        return $amount;
    }

}
