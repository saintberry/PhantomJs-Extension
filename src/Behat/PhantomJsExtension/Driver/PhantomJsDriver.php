<?php

namespace Behat\PhantomJsExtension\Driver;

use Behat\Mink\Driver\Selenium2Driver;
use Behat\Mink\Exception\DriverException;
use Symfony\Component\Process\Process;
use WebDriver\WebDriver;

class PhantomJsDriver extends Selenium2Driver
{
    /**
     * @var Symfony\Component\Process\Process
     */
    protected $phantomJsProc;

    /**
     * @var string
     */
    protected $phantomJsBin;

    /**
     * @var integer
     */
    protected $wdPort;

    /**
     * Instantiates the driver.
     *
     * @param string    $browserName Browser name
     * @param array     $desiredCapabilities The desired capabilities
     * @param string    $wdHost The WebDriver host
     * @param integer   $wdPort The WebDriver port
     * @param string    $bin The path to PhantomJS binary
     */
    public function __construct(
        $browserName = 'firefox',
        $desiredCapabilities = null,
        $wdHost = 'http://localhost:8643/wd/hub',
        $wdPort = 8643,
        $bin = '/usr/local/bin/phantomjs'
    ) {
        parent::__construct($browserName, $desiredCapabilities, $wdHost);
        $this->wdPort = $wdPort;
        $this->phantomJsBin = $bin;
    }

    /**
     * {@inheritdoc}
     */
    public function start()
    {
        if ($this->phantomJsProc !== null) {
            return parent::start();
        }

        $cmd = sprintf('exec %s --webdriver=%d /dev/null 2>&1', $this->phantomJsBin, $this->wdPort);

        try {
            $this->phantomJsProc = new Process($cmd);
            $this->phantomJsProc->disableOutput();
            $this->phantomJsProc->setTimeout(600);
            $this->phantomJsProc->start();
        } catch (\Exception $e) {
            throw new DriverException('Could not start PhantomJs', 0, $e);
        }

        if (!$this->phantomJsProc->isRunning()) {
            throw new DriverException('Could not confirm PhantomJs is running');
        }
        sleep(1);
        parent::start();
    }

    /**
     * {@inheritdoc}
     */
    public function stop()
    {
        parent::stop();
        $this->phantomJsProc->stop(0);
        $this->phantomJsProc = null;
    }
}
