<?php

/**
 * @Author: xml
 * @Date:   2019-04-22 11:13:55
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-22 16:14:19
 */

namespace src\Bundles;

use Predis\Client as Redis;
use Swoole;

class ServiceBundle
{
	const RegisterService = 1000;
	const RequestService = 2000;

	private $server;
	private $fd;
	private $from_id;
	private $data;

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
			//	'name' => 'im',
			// 	'server' => '127.0.0.1',
			// 	'port' => '9502',
			// 	'service' => 'detail',
			// ];
			//存redis
			$redis = new Redis();
			if (!$redis->exists("rpc_server_". $data['name'])) {
				$redis->hmset("rpc_server_". $data['name'], [
					'server' => $data['server'],
					'port' => $data['port'],
				]);
			}
			//具体path由service内部定义
			$redis->sadd("rpc_service_". $data['name'], $data['service']);
			
		} else if ($this->data['type'] == self::RequestService)
		{
			//请求服务
			// $data = [
			// 	'type' => self::RequestService,
			// 	'service' => 'im/detail',
			// 	'data' => ['id' => 1],
			// ];
			$service = explode("/", $data['service']);
			$server = $service[0];
			$service = $service[1];

			$redis = new Redis();
			$server_addr = $redis->hget("rpc_server_". $server, "server");
			$server_port = $redis->hget("rpc_server_". $server, "port");

			if ($redis->exists("rpc_server_". $server)) {
				//存在服务器
				if ($redis->exists("rpc_service_". $service)) {
					//存在服务
					$client = new swoole_client(SWOOLE_SOCK_TCP);
					if ($client->connect($server_addr, $server_port, 0.5)) {
						die("connect failed");
					}
					$client->send(json_encode($data['data']));
					$res = $client->recv();
					$client->close();
					return $res;
				} else {
					//服务不存在
					return 400;
				}
			} else {
				return 400;
			}
		}
	}
}
