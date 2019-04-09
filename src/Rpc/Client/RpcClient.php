<?php

/**
 * @Author: xml
 * @Date:   2019-03-30 16:03:31
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-09 14:13:30
 * Desc: RPC同步客户端
 */

namespace src\Rpc\Client;

use Swoole;

class RpcClient
{
	public static $instance;
	private $client;
	private function __construct()
	{
		$this->client = new swoole_client(SWOOLE_SOCK_TCP);
		if ($this->client->connect('127.0.0.1', 9501, 0.5)) {
			die("connect failed");
		}
	}

	public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function send(array $data)
	{
		$this->client->send(json_encode($data));
		$res = $this->client->recv();//同步方式
		return $res;
	}
}