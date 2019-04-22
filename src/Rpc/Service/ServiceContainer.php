<?php

/**
 * @Author: xml
 * @Date:   2019-04-18 17:20:48
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-18 17:41:57
 * Desc:服务
 */

namespace src\Rpc\Service;

class ServiceContainer
{
	public $instance;
	
	const UserMsg = 1001; //读取用户信息
	const CheckOnlineMsg = 1002; //获取在线状态

	public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function handle($data)
	{
		$data = json_encode($data);

		switch ($data['type'])
		{
			case self::UserMsg:
				$content = [
					'id' => 1,
					'name' => 'jack',
					'age' => 15,
					'sex' => 'F',
					'mobile' => '13333333333'
				];
				break;
			case self::CheckOnlineMsg:
				$content = [
					'online' => 0,
				];
				break;
			default:
				$content = 0;
		}
		return $content;
	}
}