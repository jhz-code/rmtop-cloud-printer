<?php
/**
 * Created by YnRmsf.
 * User: zhuok520@qq.com
 * Date: 2021/6/5
 * Time: 8:33 下午
 */


namespace RmTop\RmPrinter\core;

use RmTop\RmPrinter\model\PrinterModel;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\Model;

/**
 * 打印机管理
 * Class TopPrinterManage
 * @package RmTop\RmPrinter\core
 */
class TopPrinterManage
{
    /**
     * 创建打印机
     * @param string $print_type 打印机类型
     * @param string $print_title 打印机名称
     * @param string $print_sn 打印机编号
     * @param $print_extra   打印机配置
     * @param int $print_state 打印机状态
     * @param int $print_online 打印在线状态
     * @return PrinterModel|Model //
     */
    function addPrinter(string $print_type, string $print_title, string $print_sn,
         $print_extra,
         int $print_state,
         int $print_online,
         int $print_config_id
       ){
        return PrinterModel::create([
             'print_title'=>$print_title,
             'print_type'=>$print_type,
             'print_sn'=>$print_sn,
             'print_extra'=>$print_extra,
             'print_state'=>$print_state,
             'print_online'=>$print_online,
             'print_config_id'=>$print_config_id,
        ]);
    }


    /**
     * 删除打印机
     * @param int $printer_id
     * @return bool
     */
    function deletePrinter(int $printer_id): bool
    {
        return PrinterModel::where(['id'=>$printer_id])->delete();
    }


    /**
     * 编辑打印机
     * @param int $printer_id
     * @param array $data
     * @return PrinterModel
     */
    function editPrinter(int $printer_id,array $data): PrinterModel
    {
        return PrinterModel::where(['id'=>$printer_id])->update($data);
    }


    /**
     * 获取打印机列表
     * @param string $filed
     * @param array $where
     * @param int $limit
     * @return \think\Paginator
     * @throws DbException
     */
    function getPrinterList(string $field,array $where,int $limit = 10): \think\Paginator
    {
        if($where){
            return PrinterModel::where($where)->field($field)->paginate($limit);
        }else{
            return PrinterModel::where(1)->field($field)->paginate($limit);
        }
    }


    /**
     * 获取打印机详情
     * @param int $printer_id
     * @param string $field
     * @return array|Model|null
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    function getPrintInfo(int $printer_id,string $field){
        return PrinterModel::where(['id'=>$printer_id])->field($field)->find();
    }




}
