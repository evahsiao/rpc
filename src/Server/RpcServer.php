<?php

/**
 * @Author: xml
 * @Date:   2019-03-30 15:58:06
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-22 16:18:39
 * Desc: rpc服务器
 */

namespace src\Server;

use src\Bundles\ServiceBundle;

class RpcServer
{
	public function __construct()
	{
		$server = new swoole_server("127.0.0.1", 9501);
		$server->on('connect', $this->onConnect($server, $fd));
		$server->on('receive', $this->onReceive($server, $fd, $from_id, $data));
		$server->on('close', $this->onClose($server, $fd));

		//启动服务
		//一旦服务启动，所有注册函数不可更改，更改后只有重启服务才生效
		$server->start();
	}

	public function onConnect($server, $fd)
	{
		echo "Client $fd connect.\n";
	}

	public function onReceive($server, $fd, $from_id, $data)
	{
		//接收到来自$fd的数据$data
		$bundle = new ServiceBundle($server, $fd, $from_id, $data);
		$res = $bundle->handle();
		$server->send($fd, "Server: ". $res);
	}

	public function onClose($server, $fd)
	{
		echo "Client closed";
	}
}