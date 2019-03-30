<?php

/**
 * @Author: xml
 * @Date:   2019-03-30 14:31:05
 * @Last Modified by:   xml
 * @Last Modified time: 2019-03-30 17:21:32
 * Desc:纯PHP编写rpc客户端
 */

namespace src\Rpc;

class BackRpcClient
{
	protected $urlInfo = array();

	public function __construct($url) {
		//解析url
		$this->urlInfo = parse_url($url);
		if (!$this->urlInfo) {
			exit("{$url} error \n");
		}
	}

	public function __call($method, $params) {
		//创建一个客户端
		$client = stream_socket_client("tcp://{$this->urlInfo['host']}:{$this->urlInfo['port']}", $errno, $errstr);
		if (!$client) {
			exit("{$errno}: {$errstr} \n");
		}

		//传递调用的类名
		$class = basename($this->urlInfo['path']);
		$proto = 'Rpc-Class: {$class};'. PHP_EOL;
		//传递调用的方法名
		$proto .= "Rpc-Method: {$method};". PHP_EOL;
		//传递方法的参数
		$params = json_encode($params);
		$proto .= "Rpc-Params: {$params};". PHP_EOL;
		//向服务端发送我们自定义的协议数据
		fwrite($client, $proto);
		//读物服务端传来的数据
		$data = fread($client, 2048);
		//关闭客户端
		fclose($client);
		return $data;
	}
}

$cli = new RpcClient('http://127.0.0.1:8888/test');
echo $cli->hehe();
echo $cli->hehe2(array('name' => 'test', 'age' => 27));