<?php

/**
 * @Author: xml
 * @Date:   2019-04-09 14:14:26
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-16 14:22:45
 * Desc: 异步客户端
 * Note: 方案设计有误，废弃
 */

namespace src\Rpc\Client;

use Swoole;

class AsyncRpcClient
{
	public static $instance;
	private $client;
	private function __construct()
	{
		$this->client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
		$this->client->on("connect", $this->onConnect($cli));
		$this->client->on("receive", $this->onReceive($cli, $data));
		// $this->client->on("error", $this->onError($cli));
		$this->client->on("close", $this->onClose($cli));

		$this->client->connect('127.0.0.1', 9501, 0.5);
	}

	public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	//异步多进程模式不可使用单例的多线程模式，无法使用，废弃
	public function send($data)
	{
		$this->client->send($data);
	}

	public function onConnect($cli, $request_data)
	{
		//建立连接成功
		$cli->send(json_encode($request_data));
	}

	public function onReceive($cli, $data) 
	{
		return $data;
	}

	public function onClose($cli)
	{
		//断开连接
	}
