<?php

/**
 * @Author: xml
 * @Date:   2019-03-30 13:32:20
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-16 14:52:46
 * Desc: 发送请求
 */
namespace src\Rpc\Client;

use Swoole;
use src\Rpc\Client\RpcClient;

class RpcRequest
{
	/*
	请求过程：
	1.调用client初始化到server的连接
	2.将需要发送的数据进行序列化处理
	3.将数据请求发送到服务器
	*/
	private $client;
	public function __construct()
	{
		$this->client = RpcClient::getInstance();
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
