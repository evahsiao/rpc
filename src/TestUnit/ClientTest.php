<?php

/**
 * @Author: xml
 * @Date:   2019-04-09 13:52:12
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-18 18:02:39
 * Desc: 客户端发送请求前的方法
 */

namespace src\Rpc\TestUnit;

use src\Rpc\Client\RpcClient;
use src\Rpc\Client\Server;
use src\Rpc\Service\ServiceServer;

public class ClientTest
{
	public function getDetail()
	{
		//开启服务
		$service = new ServiceServer();
		$id = 1;
		//请求服务端
		$server = new Server();
		$server->setHost('127.0.0.1');
		$server->setPort('9501');
		$server->setProtocol('tcp');

		$client = new RpcClient($server);
		$client->send($id);
	}
}