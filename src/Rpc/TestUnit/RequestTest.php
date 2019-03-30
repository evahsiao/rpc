<?php

/**
 * @Author: xml
 * @Date:   2019-03-30 17:30:10
 * @Last Modified by:   xml
 * @Last Modified time: 2019-03-30 17:44:29
 * Desc: 客户端发送数据
 */

namespace src\Rpc\TestUnit;

use src\Rpc\Client\RpcClient;

public class RequestTest{
	private $client;
	public function __construct()
	{
		$this->client = new RpcClient();
	}

	public function test()
	{
		$data = [
			'username' => 'july',
			'age' => 16,
			'sex' => 'F',
		];
		$this->client->send($data);
	}

	public function call($mobile)
	{
		$data = [
			'username' => 'july',
			'mobile' => $mobile,
			'age' => 16,
			'sex' => 'F',
		];
		$this->client->send($data);
	}
}
