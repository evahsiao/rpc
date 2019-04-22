<?php

/**
 * @Author: xml
 * @Date:   2019-04-18 16:48:56
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-22 11:15:34
 * Desc:服务器
 */

namespace src\Service;

use Swoole;
use src\Rpc\Service\ServiceContainer;

class ServiceServer
{
	public function __construct()
	{
		$server = new swoole_server("127.0.0.1", 9501);

		//监听连接进入事件
		$server->on('connect', $this->onConnect($server, $fd));

		//监听数据接收事件
		$server->on('receive', $this->onReceive($server, $fd, $from_id, $data));

		//监听连接关闭事件
		$server->on('close', $this->onClose($server, $fd));
		$server->start();
	}

	public function onConnect($server, $fd)
	{
		echo "client $fd connect.\n";
	}

	public function onReceive($server, $fd, $from_id, $data)
	{
		echo "received: fd-$fd from_id:$from_id data:$data";
		// $instance = ServiceContainer::getInstance();
		// $content = $instance->handle($data);
		// $server->send($fd, $content);
	}

	public function onClose($server, $fd)
	{
		echo "client $fd closed.\n";
	}
}