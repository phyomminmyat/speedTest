<?php 
/**
 *
 */
    class Benchmark
    {
        public $today;

        public function __construct()
        {
        }

        public function hourly()
        {
            try {
                $download_speed = SpeedTest::downloadSpeed();
                $upload_speed   = SpeedTest::uploadSpeed();
                $ping           = SpeedTest::ping();

                $file = 'result.json';

                if (file_exists($file)) {

                    $speed_result_lists  = [];
                    $hour                = date("H");
                    $speed_result        = json_decode(file_get_contents($file), true);
                    $speed_result[$hour] = array('download_speed' => $download_speed, 'upload_speed' => $upload_speed, 'ping' => $ping , 'date' => date("Y-m-d H:i:s"));

                    file_put_contents($file, json_encode($speed_result));

                    echo 'Finished saving result...';

                    $speed_result = json_decode(file_get_contents($file), true);

                    return $speed_result;

                    // exit();

                } else {

                }

            } catch (Exception $e) {

            }
        }

        public function downloadAverage($date)
        {
            try {

                if ($date) {
                    $search_date_time = strtotime(date('Y-m-d',strtotime($date)));
                } else {
                    $search_date_time = strtotime(date('Y-m-d'));
                }

                $file_name = 'result.json';
                $original_file = fopen($file_name, 'r+');
                
                $speed_result  = json_decode(file_get_contents($file_name));

                if (!$speed_result) {
                    return 0;
                }
               
                $download_speed_list= [];

                foreach ($speed_result as $key => $speed) {

                    $result_date_time = strtotime(date('Y-m-d',strtotime($speed->date)));
                    if ($result_date_time == $search_date_time) {
                       array_push($download_speed_list, $speed->download_speed);
                    }
                }

                $speed_list_size = sizeof($download_speed_list);
                $total_speed = 0;
                for ($i=0; $i < $speed_list_size; $i++) { 
                   $total_speed += $download_speed_list[$i];
                }

                $average_download_speed = $total_speed / $speed_list_size;
         
                return $average_download_speed;  

            } catch (Exception $e) {

                echo 'Something wrong....';
                return false;
            }
           
        }

        public function uploadAverage($date)
        {
            try {
                if ($date) {
                    $search_date_time = strtotime(date('Y-m-d',strtotime($date)));
                } else {
                    $search_date_time = strtotime(date('Y-m-d'));
                }

                $file_name = 'result.json';
                $original_file = fopen($file_name, 'r+');
                
                $speed_result  = json_decode(file_get_contents($file_name));

                if (!$speed_result) {
                    return 0;
                }

                $upload_speed_list= [];

                foreach ($speed_result as $key => $speed) {
                    
                    $result_date_time = strtotime(date('Y-m-d',strtotime($speed->date)));
                    if ($result_date_time == $search_date_time) {
                       array_push($upload_speed_list, $speed->upload_speed);
                    }
                }

                $speed_list_size = sizeof($upload_speed_list);
                $total_speed = 0;
                for ($i=0; $i < $speed_list_size; $i++) { 
                   $total_speed += $upload_speed_list[$i];
                }

                $average_upload_speed = $total_speed / $speed_list_size;
         
                return $average_upload_speed;
                    
            } catch (Exception $e) {
                echo 'Something wrong....';
                return false;
            }
        }

        public function pingAverage($date)
        {
            try {
                if ($date) {
                    $search_date_time = strtotime(date('Y-m-d',strtotime($date)));
                } else {
                    $search_date_time = strtotime(date('Y-m-d'));
                }

                $file_name = 'result.json';
                $original_file = fopen($file_name, 'r+');
                
                $speed_result  = json_decode(file_get_contents($file_name));

                if (!$speed_result) {
                    return 0;
                }
               
                $ping_list = [];

                foreach ($speed_result as $key => $speed) {
                    
                    $result_date_time = strtotime(date('Y-m-d',strtotime($speed->date)));
                    if ($result_date_time == $search_date_time) {
                       array_push($ping_list, $speed->ping);
                    }
                }

                $ping_list_size = sizeof($ping_list);
                $total_ping = 0;
                for ($i=0; $i < $ping_list_size; $i++) { 
                   $total_ping += $ping_list[$i];
                }

                $average_ping_speed = $total_ping / $ping_list_size;
         
                return  $average_ping_speed;
                    
            } catch (Exception $e) {

                echo 'Something wrong....';
                return false;

            }
        }

        public function downloads($date = [])
        {
            try {
                if ($date) {
                    $search_date_time = strtotime(date('Y-m-d',strtotime($date)));
                } else {
                    $search_date_time = strtotime(date('Y-m-d'));
                }

                $file_name = 'result.json';
                $original_file = fopen($file_name, 'r+');
                
                $speed_result  = json_decode(file_get_contents($file_name));

                if (!$speed_result) {
                    return [];
                }
               
                $download_speed_list= [];

                foreach ($speed_result as $key => $speed) {

                    $result_date_time = strtotime(date('Y-m-d',strtotime($speed->date)));
                    if ($result_date_time == $search_date_time) {
                       array_push($download_speed_list, $speed->download_speed);
                    }
                }

                return json_encode($download_speed_list);
                
            } catch (Exception $e) {
                return [];
            }
        }

        public function upload($date = [])
        {
            try {
                if ($date) {
                    $search_date_time = strtotime(date('Y-m-d',strtotime($date)));
                } else {
                    $search_date_time = strtotime(date('Y-m-d'));
                }

                $file_name = 'result.json';
                $original_file = fopen($file_name, 'r+');
                
                $speed_result  = json_decode(file_get_contents($file_name));

                if (!$speed_result) {
                    return [];
                }

                $upload_speed_list= [];

                foreach ($speed_result as $key => $speed) {
                    
                    $result_date_time = strtotime(date('Y-m-d',strtotime($speed->date)));
                    if ($result_date_time == $search_date_time) {
                       array_push($upload_speed_list, $speed->upload_speed);
                    }
                } 

                return json_encode($upload_speed_list); 

            } catch (Exception $e) {
                return [];
            }    
           
        }

        public function pings($date = [])
        {
    		try {
                if ($date) {
                    $search_date_time = strtotime(date('Y-m-d',strtotime($date)));
                } else {
                    $search_date_time = strtotime(date('Y-m-d'));
                }

                $file_name = 'result.json';

                $original_file = fopen($file_name, 'r+');
                
                $speed_result  = json_decode(file_get_contents($file_name));

                if (!$speed_result) {
                    return [];
                }
               
                $ping_list = [];

                foreach ($speed_result as $key => $speed) {
                    
                    $result_date_time = strtotime(date('Y-m-d',strtotime($speed->date)));
                    if ($result_date_time == $search_date_time) {
                       array_push($ping_list, $speed->ping);
                    }
                }

                return json_encode($ping_list);
                
            } catch (Exception $e) {
                
            }

           
        }

        public function checkFileSize($link)
        {
            try {
                $ch   = curl_init($link);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_NOBODY, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                $data = curl_exec($ch);
                $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
                curl_close($ch);
                $file = file_get_contents($link);
              
                return $size;

            } catch (Exception $e) {
                echo "Error " . json_decode($e);
            }
        }
    }