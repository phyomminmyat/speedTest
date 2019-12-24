<?php

require_once('Benchmark.php');

class SpeedTest
{
	public $link = 'https://raw.githubusercontent.com/phyoeminnmyat/testJson/master/test.json';

    // return kb/s
    public function downloadSpeed(): float
    {
    	$link = 'https://raw.githubusercontent.com/phyoeminnmyat/testJson/master/test.json';

        $start = time();

        $size = Benchmark::checkFileSize($link);

        $end = time();

        $time = $end - $start;

        $size = $size / 1024; //1048576

        $speed = $size / $time;

        return floatval($speed);
    }

    // return kb/s
    public function uploadSpeed(): float
    {
        $file_name = 'test.json';

        $original_file = fopen($file_name, 'r+');
        $stat = fstat($original_file);
        $size = $stat['size'];

        $upload_time = time() - $_SERVER['REQUEST_TIME'];

        $size = $size / 1024;

        $speed = $size / $upload_time;

        return floatval($speed);
    }

    public function ping(): float
    {
        $host = 'www.google.com';
        $pingTime = shell_exec('ping -q -c1 ' . $host . ' | grep "packets transmitted" | sed s/"^[[:print:]]* time \([0-9]*\)ms$"/\\\\1/g');

        return floatval($pingTime);
    }
}

    set_time_limit(0); // make it run forever

    while(true) {

        Benchmark::hourly();
        $date = date('Y-m-d');

        $average_download_speed = Benchmark::downloadAverage($date);

        $average_upload_speed = Benchmark::uploadAverage($date);

        $average_ping_speed = Benchmark::pingAverage($date);

        echo "\n average download speed ...". $average_download_speed . ' Kb/s';

        echo "\n";

        echo "average upload speed ...". $average_upload_speed . ' Kb/s';
        echo "\n";
        echo "average ping speed ...". $average_ping_speed . ' ms';
        echo "\n";

        $download_speed_list  = Benchmark::downloads();
        $upload_speed_list  = Benchmark::upload();
        $ping_list  = Benchmark::pings();

        echo "download speed list... \n". 

        print_r(json_decode($download_speed_list));

        echo "\n";

        echo "upload speed list ... \n". 

        print_r(json_decode($upload_speed_list));
        echo "\n";
        echo "ping list... \n". 

        print_r(json_decode($ping_list));
        echo "\n";

        sleep(3600);
    }