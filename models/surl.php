<?php
/*
CREATE TABLE `surl` (
`ShortURL` varchar(10) NOT NULL,
`LongURL` varchar(2000) NOT NULL,
`Created` datetime NOT NULL,
`TotalClicks` int(11) NOT NULL,
`LastClicked` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 */
class surl
{
    public $ShortURL; // varchar(10) NOT NULL,
    public $LongURL; // varchar(2000) NOT NULL,
    public $Created; // datetime NOT NULL,
    public $TotalClicks; // int(11) NOT NULL,
    public $LastClicked; // datetime NOT NULL

    private static $urlMutex;

    private static function checkMutex()
    {
        // if (static::$urlMutex == null) {
        //     static::$urlMutex = new SyncMutex("iseveryoneOK");
        // }
    }

    private static function lock()
    {
        // return static::$urlMutex->lock();
    }
    private static function unlock()
    {
        // return static::$urlMutex->unlock();
    }
    public static function createURL(string $url)
    {
        static::checkMutex();
        try {
            static::lock();
            usleep(10000); // 10000 microseconds = 10 milliseconds;
            $sql = 'INSERT INTO `surl` (`ShortURL`, `LongURL`, `Created`, `TotalClicks`, `LastClicked`) VALUES (?,?,?,?,?)';
            $short = (new ShortUrl)->getValue();
            $date = date("Y-m-d H:i:s");
            require _models . "/db.php";
            $db = new db;
            $r = $db->exec($sql, [$short, $url, $date, 0, $date]);
            if ($r == null) {
                return ["success" => true, "url" => $short];
            } else {
                return ["success" => false, "err" => print_r($r, true)];
            }
        } finally {
            static::unlock();
        }
    }
}

class ShortUrl
{
    const CHAR_MAP = "0123456789qwertyuopasdfghjklizxcvbnm-_QWERTYUIOPASDFGHJKLZXCVBNM";
    private function GenerateUniq()
    {
        $now = DateTime::createFromFormat('U.u', microtime(true));
        //echo "<p>" . $now->format("m-d-Y H:i:s.u") . "</p>"; //  12-16-2018 20:49:56.379500
        $ls = number_format((($now->format("ymdGisu") + 0) / 1000), 0, ".", "");
        //echo "<p>" . $ls . "</p>"; //181216204956380
        return $ls;
    }

    private function Encode($long)
    {
        $result = "";
        //echo "<p>" . static::CHAR_MAP . "</p>";
        $base = strlen(static::CHAR_MAP);
        //echo "<p>" . $base . "</p>";
        do {
            $result = static::CHAR_MAP[$long % $base] . $result;
            $long = floor($long / $base);
        } while ($long > 0);

        //echo "<p>" . $result . "</p>";
        return $result;
    }

    // private long Decode(string s)
    // {
    //     long i = 0;

    //     foreach (var c in s)
    //     {
    //         i = (i * charMapBase) + charMap.IndexOf(c);
    //     }

    //     return i;
    // }

    private $value;
    public function __construct()
    {
        $this->value = $this->Encode($this->GenerateUniq());
    }
    public function getValue()
    {
        //echo "<p>" .  $this->value . "</p>";

        return $this->value;
    }

}
