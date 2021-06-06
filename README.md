# rmtop-cloud_printer

安装打印机插件 

`composer require rmtop/rmsf_cloud_printer
`
### 发布打印机文件

`rmtop:printer_publish
`

#### 执行数据迁移
`php think migrate:run`

执行后创建 <br>
打印机列表数据表 <br>
打印机配置数据表 <br>
rm_cloud_printer //打印机列表 <br>
rm_cloud_printer_config  //打印机配置表  <br>


### 打印机操作方法：


#####打印机管理操作方法<br>
createConfig($config) //创建配置项 <br>
editConfig(int $id,array $config) //编辑配置项 <br>
deleteConfig(int $id)  //删除配置项<br>
addPrinter(string $print_type, string $print_title, string $print_sn, $print_extra, int $print_state, int $print_online, int $print_config_id
) //添加打印机<br>
deletePrinter(int $printer_id) //删除打印机<br>
editPrinter(int $printer_id,array $data) //编辑打印机<br>
getPrinterList(string $field,array $where,int $limit = 10) //获取打印机列表<br>
getPrintInfo(int $printer_id,string $field) //获取单个打印机信息`<br>


###飞鹅打印机操作方法<br>
allPrinterRun(string $type,bool $job = false, array $where ,string $filed,$content,int $times) //全部打印机打印<br><br>
singlePrinter(string $type,bool $job = false,array $where,$content,int $times)//单独打印机打印


###参数说明:
$type  receipt 小票打印｜ label 标签打印 <br>
$job  bool   true queue列队打印    false 直接打印<br>
$where  筛选打印机条件<br>
$content 打印内容<br>
$times 打印次数<br>