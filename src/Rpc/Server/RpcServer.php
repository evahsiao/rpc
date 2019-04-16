<?php

/**
 * @Author: xml
 * @Date:   2019-03-30 15:58:06
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-16 15:00:07
 * Desc: rpc服务器
 */

namespace src\Rpc\Server;

class RpcServer
{
	public $host;
	public $port;
	public $protocol; //tcp,http,ws

	public function setHost($host) 
	{
		$this->host = $host;
	}

	public function getHost()
	{
		return $this->host;
	}

	public function setPort($port) 
	{
		$this->port = $port;
	}

	public function getPort()
	{
		return $this->port;
	}

	public function setProtocol($protocol) 
	{
		$this->protocol = $protocol;
	}

	public function getProtocol()
	{
		return $this->protocol;
	}
}