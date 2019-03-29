<?php

/**
 * @Author: xml
 * @Date:   2019-03-27 10:52:34
 * @Last Modified by:   xml
 * @Last Modified time: 2019-03-29 16:38:24
 * @Desc: kafka connect pool
 */

class KafkaService
{
	public static $instance;
	private $topic;

	private function __construct()
	{
		pcntl_sigprocmask(SIG_BLOCK, [SIGIO]);
        $conf = new \RdKafka\Conf();
        $conf->set('socket.blocking.max.ms', 1); //broker超时最大时长
        $conf->set('topic.metadata.refresh.sparse', 1); //只提取需要用到的topic
        $conf->set('topic.metadata.refresh.interval.ms', 600);
        $conf->set('internal.termination.signal', SIGIO); //librdkafka服务宕机时即时终止php进程

        $producer = new \RdKafka\Producer();
        $producer->addBrokers("127.0.0.1:9092");
        $topic = $producer->newTopic("test");
        $this->topic = $topic;
	}

	public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function publish(array $data)
	{
		$this->topic->produce(\RD_KAFKA_PARTITION_UA, 0, json_encode($data, true));
	}
}
