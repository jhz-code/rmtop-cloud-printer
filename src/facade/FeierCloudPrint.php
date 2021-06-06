<?php
/**
 * Created by YnRmsf.
 * User: zhuok520@qq.com
 * Date: 2021/6/6
 * Time: 10:59 上午
 */


namespace RmTop\RmPrinter\facade;


use RmTop\RmPrinter\model\PrinterConfigModel;
use RmTop\RmPrinter\model\PrinterModel;
use think\Facade;
use think\Model;

/**
 *@method static  createConfig($config) 创建配置项
 *@method static  editConfig(int $id,array $config) 编辑配置项
 *@method static   deleteConfig(int $id) 删除配置项
 *@method static  addPrinter(string $print_type, string $print_title, string $print_sn,$print_extra,int $print_state,int $print_online,int $print_config_id)
 *@method static  deletePrinter(int $printer_id) //删除打印机
 *@method static  editPrinter(int $printer_id,array $data) //编辑打印机
 *@method static  getPrinterList(string $field,array $where,int $limit = 10) //获取打印机列表
 *@method static  getPrintInfo(int $printer_id,string $field)
 *
 */

class FeierCloudPrint extends Facade
{
    protected static function getFacadeClass()
    {
        return 'RmTop\RmPrinter\lib\feier\FeierCloudPrint';
    }

}