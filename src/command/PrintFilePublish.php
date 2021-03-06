<?php


namespace RmTop\RmPrinter\command;


use RmTop\RmPrinter\lib\PublishFile;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use think\Exception;

class PrintFilePublish extends Command
{



    protected function configure()
    {
        $this->setName('rmtop:publish_printer')
            ->setDescription('printer publish');
    }


    /**
     * 执行数据
     * @param Input $input
     * @param Output $output
     * @return int|void|null
     * @throws \ReflectionException
     */
    protected function execute(Input $input, Output $output)
    {

        try{
            PublishFile::PublishFileToSys($output);//发布文件
            $output->writeln("all publish successfully！");
        }catch (Exception $exception){
            $output->writeln($exception->getMessage());
        }

    }






}