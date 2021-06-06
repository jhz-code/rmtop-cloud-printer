<?php


namespace RmTop\RmPrinter\lib\feier;


use think\Exception;

class FeierCloudPrint extends FeierClient
{

    public $printerId = '' ;

    /**
     * 设置打印机ID
     * @param int $printerId
     */
    function setPrinterId(int $printerId){
        $this->printerId = $printerId;
    }


    /**
     * [批量添加打印机接口 Open_printerAddlist]
     * @param  [string] $printerContent [打印机的sn#key]
     * $printerConten => 打印机编号sn(必填) # 打印机识别码key(必填) # 备注名称(选填) # 流量卡号码(选填)，多台打印机请换行（\n）添加新打印机信息，每次最多100台。
     * $printerContent = "sn1#key1#remark1#carnum1\nsn2#key2#remark2#carnum2";
     * @return string [string]                 [接口返回值]
     * @throws Exception
     */
    function printerAddlist(string $printerContent): string
    {
        $param = array(['printerContent'=>$printerContent]);
        return  $this->requestClient($this->printerId,'Open_printerAddlist',$param);
    }
    //***接口返回值说明***
    //正确例子：{"msg":"ok","ret":0,"data":{"ok":["sn#key#remark#carnum","316500011#abcdefgh#快餐前台"],"no":["316500012#abcdefgh#快餐前台#13688889999  （错误：识别码不正确）"]},"serverExecutedTime":3}
    //错误：{"msg":"参数错误 : 该帐号未注册.","ret":-2,"data":null,"serverExecutedTime":37}



    /**
     * [批量删除打印机 Open_printerDelList]
     * @param  [string] $snlist [打印机编号，多台打印机请用减号“-”连接起来]
     * @return string [string]         [接口返回值]
     * @throws Exception
     */
    function printerDelList(string $snlist){
        $param = array(['snlist'=>$snlist]);
        return  $this->requestClient($this->printerId,'Open_printerDelList',$param);
    }


    /**
     * [修改打印机信息接口 Open_printerEdit]
     * @param  [string] $sn       [打印机编号]
     * @param  [string] $name     [打印机备注名称]
     * @param  [string] $phonenum [打印机流量卡号码,可以不传参,但是不能为空字符串]
     * @return [string]           [接口返回值]
     * @throws Exception
     */
    function printerEdit($sn,$name,$phonenum): string
    {
        $param = array(['sn'=>$sn, 'name'=>$name,'phonenum'=>$phonenum]);
        return  $this->requestClient($this->printerId,'Open_printMsg',$param);
    }
    //***接口返回值说明***
    //成功：{"msg":"ok","ret":0,"data":true,"serverExecutedTime":5}
    //错误：{"msg":"参数错误 : 参数值不能传空字符，\"\"、\"null\"、\"undefined\".","ret":-2,"data":null,"serverExecutedTime":1}
    //提示：


    /**
     * 接口只能是小票机使用
     * [打印订单接口 Open_printMsg]
     * @param $sn
     * @param $content
     * @param $times
     * @return string [string]          [接口返回值]
     * @throws Exception
     */
    function printReceipt($sn,$content,$times): string
    {
        $param = array(['sn'=>$sn, 'content'=>$content,'times'=>$times]);
        return  $this->requestClient($this->printerId,'Open_printMsg',$param);
    }
    //***接口返回值说明***
    //正确例子：{"msg":"ok","ret":0,"data":"123456789_20160823165104_1853029628","serverExecutedTime":6}
    //错误例子：{"msg":"错误信息.","ret":非零错误码,"data":null,"serverExecutedTime":5}
//$content = '<CB>测试打印</CB><BR>';
//$content .= '名称　　　　　 单价  数量 金额<BR>';
//$content .= '--------------------------------<BR>';
//$content .= '饭　　　　　 　10.0   10  100.0<BR>';
//$content .= '炒饭　　　　　 10.0   10  100.0<BR>';
//$content .= '蛋炒饭　　　　 10.0   10  100.0<BR>';
//$content .= '鸡蛋炒饭　　　 10.0   10  100.0<BR>';
//$content .= '西红柿炒饭　　 10.0   10  100.0<BR>';
//$content .= '西红柿蛋炒饭　 10.0   10  100.0<BR>';
//$content .= '西红柿鸡蛋炒饭 10.0   10  100.0<BR>';
//$content .= '--------------------------------<BR>';
//$content .= '备注：加辣<BR>';
//$content .= '合计：xx.0元<BR>';
//$content .= '送货地点：广州市南沙区xx路xx号<BR>';
//$content .= '联系电话：13888888888888<BR>';
//$content .= '订餐时间：2014-08-08 08:08:08<BR>';
//$content .= '<QR>http://www.feieyun.com</QR>';//把二维码字符串用标签套上即可自动生成二维码



    /**
     * [标签机打印订单接口 Open_printLabelMsg]
     * @param $sn
     * @param $content
     * @param $times
     * @return string [string]          [接口返回值]
     * @throws Exception
     */
    function printLabel($sn,$content,$times): string
    {
        $param = array(['sn'=>$sn, 'content'=>$content,'times'=>$times]);
        return  $this->requestClient($this->printerId,'Open_printLabelMsg',$param);
    }
    //***接口返回值说明***
    //正确例子：{"msg":"ok","ret":0,"data":"123456789_20160823165104_1853029628","serverExecutedTime":6}
    //错误例子：{"msg":"错误信息.","ret":非零错误码,"data":null,"serverExecutedTime":5}
    //标签说明：
//$content = "<DIRECTION>1</DIRECTION>";//设定打印时出纸和打印字体的方向，n 0 或 1，每次设备重启后都会初始化为 0 值设置，1：正向出纸，0：反向出纸，
//$content .= "<TEXT x='9' y='10' font='12' w='1' h='2' r='0'>#001       五号桌      1/3</TEXT><TEXT x='80' y='80' font='12' w='2' h='2' r='0'>可乐鸡翅</TEXT><TEXT x='9' y='180' font='12' w='1' h='1' r='0'>张三先生       13800138000</TEXT>";//40mm宽度标签纸打印例子，打开注释调用标签打印接口打印



    /**
     * [清空待打印订单接口 Open_delPrinterSqs]
     * @param string $sn
     * @return string [string]     [接口返回值]
     * @throws Exception
     */
    function cleanPrintList(string $sn): string
    {
        $param = array(['sn'=>$sn]);
        return  $this->requestClient($this->printerId,'Open_delPrinterSqs',$param);
    }
    //***接口返回值说明***
    //成功：{"msg":"ok","ret":0,"data":true,"serverExecutedTime":4}
    //错误：{"msg":"验证失败 : 打印机编号和用户不匹配.","ret":1002,"data":null,"serverExecutedTime":3}
    //错误：{"msg":"参数错误 : 参数值不能传空字符，\"\"、\"null\"、\"undefined\".","ret":-2,"data":null,"serverExecutedTime":2}
    //提示：



    /**
     * [查询订单是否打印成功接口 Open_queryOrderState]
     * @param  [string] $orderid [调用打印机接口成功后,服务器返回的JSON中的编号 例如：123456789_20190919163739_95385649]
     * @return [string]          [接口返回值]
     * @throws Exception
     */
    function checkPrintOrder(string $orderid): string
    {
        $param = array(['orderid'=>$orderid]);
        return  $this->requestClient($this->printerId,'Open_queryOrderState',$param);
    }
    //正确例子：
    //已打印：{"msg":"ok","ret":0,"data":true,"serverExecutedTime":6}
    //未打印：{"msg":"ok","ret":0,"data":false,"serverExecutedTime":6}


    /**
     * [查询指定打印机某天的订单统计数接口 Open_queryOrderInfoByDate]
     * @param  [string] $sn   [打印机的编号]
     * @param  [string] $date [查询日期，格式YY-MM-DD，如：2019-09-20]
     * @return [string]       [接口返回值]
     * @throws Exception
     */
    function findOrderInfoByDate($sn,$date): string
    {
        $param = array(['sn'=>$sn,'date'=>$date]);
        return  $this->requestClient($this->printerId,'Open_queryOrderInfoByDate',$param);
    }
    //***接口返回值说明***
    //正确例子：
    //{"msg":"ok","ret":0,"data":{"print":6,"waiting":1},"serverExecutedTime":9}
    //错误：{"msg":"验证失败 : 打印机编号和用户不匹配.","ret":1002,"data":null,"serverExecutedTime":3}



    /**
     * [获取某台打印机状态接口 Open_queryPrinterStatus]
     * @param string $sn
     * @return string [string]     [接口返回值]
     * @throws Exception
     */
    function getPrinterStatus(string  $sn): string
    {
        $param = array(['sn'=>$sn]);
        return  $this->requestClient($this->printerId,'Open_queryPrinterStatus',$param);
    }
    //正确例子：
    //{"msg":"ok","ret":0,"data":"离线","serverExecutedTime":9}
    //{"msg":"ok","ret":0,"data":"在线，工作状态正常","serverExecutedTime":9}
    //{"msg":"ok","ret":0,"data":"在线，工作状态不正常","serverExecutedTime":9}


}