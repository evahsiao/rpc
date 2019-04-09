<?php

/**
 * @Author: xml
 * @Date:   2019-03-30 13:32:20
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-09 13:48:37
 * Desc: 发送请求
 */
namespace src\Rpc;

use Swoole;

class RpcRequest
{
	private $client;
	public function __construct()
	{
		//可做成单例模式
		$this->client = new Coroutine\Client(SWOOLE_SOCK_TCP);
		$this->client->set(array(
			'open_length_check' => 1,
			'package_length_type' => 'N',
			'package_lenght_offset' => 0, //包长度计算起始值
			'package_body_offset' => 4, //从第几个字节开始计算长度
			'package_max_length' => 2000000, //协议最大长度
		));
		if (!$this->client->connect('127.0.0.1', 9501, 0.5)) 
		{
			exit("connect failed. Error: {$client->errorCode} \n");
		}
	}

	public function send(array $data)
	{
		$this->client->send(json_encode($data));
		$res = $this->client->recv();
		//将结果返回至相应的请求方法中
	}

	public function asyn_send(array $data)
	{
		$this->client->send(json_encode($data));
		$this->client->close();
	}
}
