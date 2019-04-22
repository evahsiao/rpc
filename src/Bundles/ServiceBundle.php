<?php

/**
 * @Author: xml
 * @Date:   2019-04-22 11:13:55
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-22 11:59:24
 */

namespace src\Bundles;

class ServiceBundle
{
	const RegisterService = 1000;
	const RequestService = 2000;

	private $server;
	private $fd;
	private $from_id;
	private $data;

	public static ServiceList = [];

	public function __construct($server, $fd, $from_id, $data)
	{
		$this->server = $server;
		$this->fd = $fd;
		$this->from_id = $from_id;
		$this->data = json_decode($data, true);
	}

	public function handle()
	{
		if ($this->data['type'] == self::RegisterService) 
		{
			//注册服务
			// $data = [
			// 	'type' => self::RegisterService,
			// 	'server' => '127.0.0.1',
			// 	'port' => '9502',
			// 	'service' => 'detail',
			// ];
			//存redis
			self::ServiceList['detail'] = [
				'server' => '127.0.0.1',
				'port' => '9502',
				'service' => 'detail'
			];
		}
	}
}
