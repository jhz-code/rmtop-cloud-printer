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
     * @param array $data
     * @return PrinterModel|Model
     */
    function addPrinter(array $data){
        return PrinterModel::create($data);
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
