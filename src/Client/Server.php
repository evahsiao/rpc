<?php

/**
 * @Author: xml
 * @Date:   2019-04-18 14:34:28
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-18 14:35:32
 * Desc:服务器
 */
namespace src\Rpc\Client;

class Server
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