<?php

/**
 * @Author: xml
 * @Date:   2019-03-30 15:58:06
 * @Last Modified by:   xml
 * @Last Modified time: 2019-03-30 17:10:39
 * Desc: rpc服务器
 */

namespace src\Rpc\Server;

class RpcServer
{
	public $serv;

	public function __construct()
	{
		//服务器初始化
		$this->serv = new swoole_server('127.0.0.1', 9501);
		$this->connect();
		$this->receive();
		$this->close();
		$this->serv->start();
	}
	
	public function connect()
	{
		$this->serv->on('connect', function ($serv, $fd) {
			//客户端连接了服务端时的处理
		});
	}
	public function receive()
	{
		$this->serv->on('receive', function ($this->serv, $fd, $from_id, $data) {
			$this->serv->send($fd, "server: ". $data);
		});
	}

	public function close()
	{
		$this->serv->on('close', function ($this->serv, $fd) {
			//监听到关闭连接事件时处理
		});
	}
}