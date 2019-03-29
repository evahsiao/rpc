<?php

/**
 * @Author: xml
 * @Date:   2019-03-29 16:10:15
 * @Last Modified by:   xml
 * @Last Modified time: 2019-03-29 16:38:02
 */
require_once __DIR__."/../Kafka/KafkaService.php";

$begin = microtime(TRUE);
//单例模式，不再进行实例化
$kafka_client = KafkaService::getInstance();
for ($i=0; $i<10000; $i++) {
	$arr = [
	    'operation' => 'create', //"index", "delete", "create", "update"
	    'fields' => [
	        'sign' => 'im_messages', //用于标记当前文档所属类型，相当于table_name
	        'from_id' => 12796,
	        'to_id' => 12797,
	        'content' => 'ooo'. $i,
	        'accept' => 0, //默认值填充字段
	        'is_revoke' => 0, //默认值填充字段
	        'created_at' => date('Y-m-d H:i:s') //默认值填充字段
	    ]
	];
	$kafka_client->publish($arr);
}
echo (microtime(TRUE) - $begin);

//执行时间：0.038980007171631