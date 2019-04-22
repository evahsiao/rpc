<?php

/**
 * @Author: xml
 * @Date:   2019-04-22 16:31:24
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-22 16:54:34
 */

namespace src\Service;
use src\Service\Services;

class ServiceHandler
{
	private $server;
	private $fd;
	private $from_id;
	private $data;

	public function __construct($server, $fd, $from_id, $data)
	{
		$this->server = $server;
		$this->fd = $fd;
		$this->from_id = $from_id;
		$this->data = json_decode($data);
	}

	public function handle()
	{
		$service = $this->data['service'];
		switch($service) {
			case "detail":
				$services = new Service();
				$content = $service->getDetail($this->data);
				break;
			default:
				$content = "";
				break;
		}
		$this->server->push($fd, json_encode($content));
	}
}