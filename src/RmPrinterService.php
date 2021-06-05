<?php

namespace RmTop\RmPrinter;

use RmTop\RmPrinter\command\PrintFilePublish;
use think\Service;

/**
 */
class RmPrinterService extends Service
{
    /**
     * Register service.
     *
     * @return void
     */
    public function register()
    {
        // 注册数据迁移服务
        $this->app->register(\think\migration\Service::class);
    }

    /**
     * Boot function.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands(['rmtop:printer_publish' => PrintFilePublish::class,]);
    }


}
