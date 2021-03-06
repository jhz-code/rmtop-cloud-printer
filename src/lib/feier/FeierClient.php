<?php
/**
 * Created by YnRmsf.
 * User: zhuok520@qq.com
 * Date: 2021/6/5
 * Time: 10:47 下午
 */


namespace RmTop\RmPrinter\lib\feier;


use RmTop\RmPrinter\model\PrinterConfigModel;
use think\Exception;

class FeierClient
{

    private $ip;
    /**
     * @var mixed
     */
    private $port;
    /**
     * @var mixed
     */
    private $path;
    /**
     * @var mixed
     */
    private $user;
    /**
     * @var mixed
     */
    private $key;

    /**
     * 获取配置项
     */
    function getConfig(int $printerConfigId): array
    {
        $config = PrinterConfigModel::where(['id'=>$printerConfigId])->value('config_text');
        $config = json_decode($config);
        $this->ip = $config['ip'];
        $this->port = $config['port'];
        $this->path = $config['path'];
        $this->user = $config['user'];
        $this->key = $config['key'];
        $config['user'] =  $this->user;
        $config['stime'] = time();
        $config['sig'] = $this->signature($config['stime']);
        return $config;
    }


    /**
     * @param int $printerConfigId
     * @param string $apiName
     * @param array $param
     * @return string
     */
    function requestClient(int $printerConfigId ,string $apiName,array $param): string
    {
        //获取打印机配置
        $params = $this->getConfig($printerConfigId);
        $params['apiname'] = $apiName;
        $postData = array_merge($params,$param);
        $client = new HttpClient($this->ip,$this->port);
        $res = $client->post($this->path,$postData);
        if(!$res){
            return $res;
        }else{
            return $client->getContent();
        }
    }


    /**
     * [signature 生成签名]
     * @param  [string] $time [当前UNIX时间戳，10位，精确到秒]
     * @return string [string]       [接口返回值]
     */
    function signature($time): string
    {
        return sha1($this->user.$this->key.$time);//公共参数，请求公钥
    }



}