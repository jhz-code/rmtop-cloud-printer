<?php
/**
 * Created by YnRmsf.
 * User: zhuok520@qq.com
 * Date: 2021/6/5
 * Time: 10:47 下午
 */


namespace RmTop\RmPrinter\lib\feier;


use think\Exception;

class FeierClient
{

     public   function __construct()
     {
         $this->ip = config('');
         $this->port = config('');
         $this->path = config('');
         $this->user = config('');
         $this->key = config('');
     }


    /**
     * 获取配置项
     */
    function getConfig(): array
    {
        $config['user'] =  $this->user;
        $config['stime'] = time();
        $config['sig'] = $this->signature($config['stime']);
        return $config;
    }


    /**
     * @param string $apiname
     * @param array $param
     * @return string
     * @throws Exception
     */
    function requestClient(string $apiName,array $param)
    {
        $params = $this->getConfig();
        $params['apiname'] = $apiName;
        $postData = array_map($params,$param);
        $client = new HttpClient($this->ip,$this->port);
        if(!$res = $client->post($this->path,$postData)){
            throw  new Exception($res);
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