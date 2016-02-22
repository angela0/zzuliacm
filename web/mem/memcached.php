<?php
	$memcache = new Memcached;
$memcache->addServer('127.0.0.1', 11211);
$stats = $memcache->getStats();
foreach ($stats as $key => $val) {
echo "$key : $val\n";
}
