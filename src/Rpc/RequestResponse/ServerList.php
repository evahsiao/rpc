<?php

/**
 * @Author: xml
 * @Date:   2019-03-30 17:38:20
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-09 13:56:27
 * Desc:服务列表
 */

namespace src\Rpc\RequestResponse;

class ServerList
{
	public function __construct()
	{

	}

	public function getServers()
	{
		return [
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
		];
	}

	public function getMethods()
	{
		//请求地址：127.0.0.1:9501/test/search
		return [
			'im' => [ //server
				'test' => [ //alias
					'space' => 'src\Rpc\TestUnit\ServerTest', //class
					'functions' => [
						'list',
						'detail'
					],
				],
			],
			'mall' => [],
		];
	}
}
