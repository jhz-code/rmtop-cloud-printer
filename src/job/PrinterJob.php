<?php
/**
 * Created by YnRmsf.
 * User: zhuok520@qq.com
 * Date: 2021/6/6
 * Time: 11:28 上午
 */


namespace RmTop\RmPrinter\job;


use RmTop\RmPrinter\lib\feier\FeierCloudPrint;
use think\queue\Job;

/**
 * 创建列队打印任务
 * Class PrinterJob
 * @package RmTop\RmPrinter\job
 */

class PrinterJob
{

    public function fire(Job $job, $data){

        //....这里执行具体的任务

        if($job->attempts() > 3) {
            //通过这个方法可以检查这个任务已经重试了几次了
            $job->release(300);
        }
        if($this->printerDone($data)){
            //如果任务执行成功后 记得删除任务，不然这个任务会重复执行，直到达到最大重试次数后失败后，执行failed方法
            $job->delete();
        }
        // 也可以重新发布这个任务
     //   $job->release($delay); //$delay为延迟时间

    }


    /**
     * @param $data
     * @return bool
     * @throws \think\Exception
     */
    function printerDone($data): bool
    {
        //直接打印
        $printer = new FeierCloudPrint();
        if('receipt' == $data['type']){
            $printer->printReceipt($data['print_sn'],$data['content'],$data['times']);
        }else if('label' == $data['type']){
            $printer->printReceipt($data['print_sn'],$data['content'],$data['times']);
        }
        return true;
    }


    public function failed($data){
        // ...任务达到最大重试次数后，失败了
    }


}