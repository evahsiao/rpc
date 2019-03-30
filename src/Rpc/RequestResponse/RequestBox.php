<?php

/**
 * @Author: xml
 * @Date:   2019-03-30 17:38:20
 * @Last Modified by:   xml
 * @Last Modified time: 2019-03-30 18:02:23
 * Desc:发送数据进行封箱操作
 */

namespace src\Rpc\RequestResponse;

class RequestBox
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
				'test' => [
					'name' => 'src\Rpc\TestUnit\RequestTest', //class
					'functions' => [
						'test' => 'search', //别名-》方法名
						'call' => 'add',
					],
			],
			'mall' => [],
		];
	}
}
