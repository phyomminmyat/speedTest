<?php
namespace UnitTestFiles\Test;

use PHPUnit\Framework\TestCase;

class SpeedUnitTest extends TestCase
{
    public function testHourly()
    {
        $hourlyMock = $this->getMockBuilder('Benchmark')
            ->setMethods(array('hourly'))
            ->getMock();

        $speed_result = json_decode(file_get_contents('result.json'), true);

        $hourlyMock->expects($this->once())
            ->method('hourly')
            ->will($this->returnValue($speed_result));

        $this->assertEquals($speed_result, $hourlyMock->hourly());
    }

    public function testDownloadSpeed()
    {
        $mock = $this->getMockBuilder('SpeedTest')
            ->setMethods(array('downloadSpeed'))
            ->getMock();

        $download_speed = 403.72;

        $mock->expects($this->once())
            ->method('downloadSpeed')
            ->will($this->returnValue(floatval(403.72)));

        $this->assertEquals($download_speed, $mock->downloadSpeed());
    }

    public function testUploadSpeed()
    {
        $mock = $this->getMockBuilder('SpeedTest')
            ->setMethods(array('uploadSpeed'))
            ->getMock();

        $upload_speed = 403.91;

        $mock->expects($this->once())
            ->method('uploadSpeed')
            ->will($this->returnValue(floatval(403.91)));

        $this->assertEquals($upload_speed, $mock->uploadSpeed());
    } 

    public function testPing()
    {
        $mock = $this->getMockBuilder('SpeedTest')
            ->setMethods(array('ping'))
            ->getMock();

        $ping = 1;

        $mock->expects($this->once())
            ->method('ping')
            ->will($this->returnValue(floatval(1)));

        $this->assertEquals($ping, $mock->ping());
    }

    public function testDownloadAverage()
    {

        $mock = $this->getMockBuilder('Benchmark')
            ->setMethods(array('downloadAverage'))
            ->getMock();
        
        $date = date('Y-m-d');

        $mock->expects($this->once())
            ->method('downloadAverage')
            ->will($this->returnArgument(0));

        $this->assertEquals($date, $mock->downloadAverage());
    }

    public function testUploadAverage()
    {
        $mock = $this->getMockBuilder('Benchmark')
            ->setMethods(array('uploadAverage'))
            ->getMock();
        
        $date = date('Y-m-d');

        $mock->expects($this->once())
            ->method('uploadAverage')
            ->will($this->returnArgument(0));

        $this->assertEquals($date, $mock->uploadAverage());

    }

    public function testPingAverage()
    {
        $mock = $this->getMockBuilder('Benchmark')
            ->setMethods(array('pingAverage'))
            ->getMock();
        
        $date = date('Y-m-d');

        $mock->expects($this->once())
            ->method('pingAverage')
            ->will($this->returnArgument(0));

        $this->assertEquals($date, $mock->pingAverage());
    }

    public function testDownload()
    {
        $mock = $this->getMockBuilder('Benchmark')
            ->setMethods(array('downloads'))
            ->getMock();
        
        $date = date('Y-m-d');

        $mock->expects($this->once())
            ->method('downloads')
            ->will($this->returnArgument(0));

        $this->assertEquals($date, $mock->downloads());
    } 

    public function testUpload()
    {
        $mock = $this->getMockBuilder('Benchmark')
            ->setMethods(array('uploads'))
            ->getMock();
        
        $date = date('Y-m-d');

        $mock->expects($this->once())
            ->method('uploads')
            ->will($this->returnArgument(0));

        $this->assertEquals($date, $mock->uploads());
    }
    
    public function testPingOptionalDate()
    {
        $mock = $this->getMockBuilder('Benchmark')
            ->setMethods(array('ping'))
            ->getMock();
        
        $date = date('Y-m-d');

        $mock->expects($this->once())
            ->method('ping')
            ->will($this->returnArgument(0));

        $this->assertEquals($date, $mock->ping());
    }

}
