<?php

/**
 * @Author: xml
 * @Date:   2019-04-16 14:28:13
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-18 13:23:53
 * Desc:客户端存根--存放服务端地址信息，将客户端的请求参数打包成网络消息，再通过网络发送给服务方
 */

namespace src\Rpc\Client;

use Swoole;

class RpcClientStub
{
	public function getServers()
	{
		$servers = [
			'im' => [
				'host' => '127.0.0.1',
				'port' => 9501,
				'protocol' => 'tcp'
			],
			'mall' => [
				'host' => '127.0.0.1',
				'port' => 80,
				'protocol' => 'http'
			],
			'test' => [
				'host' => '127.0.0.1',
				'port' => 9502,
				'protocol' => 'tcp',
			],
		];
	}
}
