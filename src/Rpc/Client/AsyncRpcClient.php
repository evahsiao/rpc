<?php

/**
 * @Author: xml
 * @Date:   2019-04-09 14:14:26
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-18 14:50:10
 * Desc: 异步客户端
 * Note: 异步客户端不可使用单例模式进行初始化
 * 因为每个客户端连接服务端后发送数据都是通过在连接时发送数据，数据处理返回结果注册的都是同一个receive函数
 * 也就是说，当有多个客户端请求时，为了区分是哪个客户端发出的以便返回结果能够正确返回
 * 使用多个连接而非一个连接中来统一处理
 */

namespace src\Rpc\Client;

use Swoole;

class AsyncRpcClient
{
	// public static $instance;
	private $client;
	public function __construct($data)
	{
		$this->client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
		$this->client->on("connect", $this->onConnect($cli));
		$this->client->on("receive", $this->onReceive($cli, $data));
		// $this->client->on("error", $this->onError($cli));
		$this->client->on("close", $this->onClose($cli));

		$this->client->connect('127.0.0.1', 9501, 0.5);
	}

	// public static function getInstance()
	// {
	// 	if (!self::$instance) {
	// 		self::$instance = new self();
	// 	}
	// 	return self::$instance;
	// }

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
