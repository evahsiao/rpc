<?php

/**
 * @Author: xml
 * @Date:   2019-03-30 16:03:31
 * @Last Modified by:   xml
 * @Last Modified time: 2019-03-30 17:37:25
 */

namespace src\Rpc\Client;

use Swoole;

class RpcClient
{
	private $client;
	public function __construct()
	{
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
		$this->receive();
	}

	public function send(array $data)
	{
		$this->client->send(json_encode($data));
	}

	public function receive()
	{
		$this->client->recv();//同步方式
	}
	public function close()
	{
		$this->client->close();
	}
}