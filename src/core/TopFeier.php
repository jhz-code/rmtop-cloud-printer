<?php
/**
 * Created by YnRmsf.
 * User: zhuok520@qq.com
 * Date: 2021/6/6
 * Time: 10:06 上午
 */


namespace RmTop\RmPrinter\core;


use RmTop\RmPrinter\lib\feier\FeierCloudPrint;
use RmTop\RmPrinter\model\PrinterModel;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\Exception;

class TopFeier
{


    /**
     * 让所有打印机执行打印
     * @param string $type
     * @param array $where
     * @param string $filed
     * @param $content
     * @param int $times
     * @throws Exception
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    function allPrinterRun(string $type, array $where ,string $filed,$content,int $times){
        if($where){
            $printerList = PrinterModel::where(1)->field($filed)->select();
        }else{
            $printerList = PrinterModel::where($where)->field($filed)->select();
        }
        if($printerList){
            $printer = new FeierCloudPrint();
            foreach ($printerList as $key=>$item){
                if($type == 'receipt'){
                    $printer->printReceipt($item['print_sn'],$content,$times);
                }else if($type == 'receipt'){
                    $printer->printLabel($item['print_sn'],$content,$times);
                }
            }
        }
    }


    /**
     *
     * @param string $type 打印类型｜receipt 小票 ｜ 标签 Label
     * @param array $where //检索打印机
     * @param $content  //打印内容
     * @param int $times  //打印次数
     * @throws Exception
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    function singlePrinter(string $type,array $where,$content,int $times){
         $printerInfo = PrinterModel::where($where)->find();
         if($printerInfo){
              $printer = new FeierCloudPrint();
             if($type == 'receipt'){
                 $printer->printReceipt($printerInfo['print_sn'],$content,$times);
             }else if($type == 'label'){
                 $printer->printLabel($printerInfo['print_sn'],$content,$times);
             }
         }
    }




}