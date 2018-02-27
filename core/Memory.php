<?php declare(strict_types=1); namespace Velocious\core;

use Velocious\core\interfaces\MemoryInterface;
use Velocious\core\Exception;


class Memory implements MemoryInterface
{
    const SHORT_TTL  = 60;  # Sixty Seconds
    const MEDIUM_TTL = 300; # Five minutes
    const LONG_TTL   = 600; # Ten minutes

    /**
     * Creates a new items in the memory cache (Memcached)
     * @param string $key
     * @param $value
     * @param $ttl
     * @return bool
     */
    public static function createCache (string $key, $value, int $ttl) : bool {
        $Memcached = self::MemcachedService();
        if($Memcached->set($key, $value, $ttl))
            return true;
        return false;
    }

    /**
     * Reads a Key from the Cache
     * @param string $key
     * @return bool|mixed
     */
    public static function readCache (string $key) {
        $Memcached = self::MemcachedService();
        if($res = $Memcached->get($key))
            return $res;
        return false;
    }

    /**
     * Deletes a cache items from Memcached
     * @param string $key
     * @return bool
     */
    public static function deleteCache (string $key) : bool {
        $Memcached = self::MemcachedService();
        if($Memcached->delete($key))
            return true;
        return false;
    }

    /**
     * Prepends "AP1_" onto the key to make it more unique, as the
     * Memcached server is shared by all AP nodes.
     * @param string $key
     * @return string
     */
    public static function generateKey (string $key) : string {
        return 'AP1_' . $key;
    }

    /**
     * Returns an instantiated Memcached connection
     * @return \Memcached
     */
    public static function Memcached () : \Memcached {
        return self::MemcachedService();
    }

    /**
     * Sets up Memcached and returns the object
     * @return \Memcached
     */
    protected static function MemcachedService () {
        $Memcached = new \Memcached();

        # Setup Memcached Service
        $Memcached->setOption(\Memcached::OPT_CONNECT_TIMEOUT, 10);
        #$Memcached->setOption(\Memcached::OPT_DISTRIBUTION, \Memcached::DISTRIBUTION_CONSISTENT);
        #$Memcached->setOption(\Memcached::OPT_SERVER_FAILURE_LIMIT, 100);
        #$Memcached->setOption(\Memcached::OPT_REMOVE_FAILED_SERVERS, false);
        $Memcached->setOption(\Memcached::OPT_RETRY_TIMEOUT, 1);

        # Check if server list is empty
        $servers = $Memcached->getServerList();
        if (empty($servers))
            $Memcached->addServers([['localhost', 11221, 11]]);

        return $Memcached;
    }
}