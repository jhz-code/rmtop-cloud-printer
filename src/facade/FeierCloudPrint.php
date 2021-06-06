<?php
/**
 * Created by YnRmsf.
 * User: zhuok520@qq.com
 * Date: 2021/6/6
 * Time: 10:59 上午
 */


namespace RmTop\RmPrinter\facade;


use think\Facade;



class FeierCloudPrint extends Facade
{
    protected static function getFacadeClass()
    {
        return 'RmTop\RmPrinter\lib\feier\FeierCloudPrint';
    }

}