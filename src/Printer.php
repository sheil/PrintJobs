<?php

namespace Tpavlek\PrintJobs;

use Carbon\Carbon;

class Printer {

    const REMOTE_TABLE_NAME = ".tableDiv";

    public $client;
    public $url;
    public $name;
    public $ip;

    /**
     * Construct a new Printer.
     * @param $ip
     * @param $url
     * @param $name
     * @param \Goutte\Client $client
     */
    public function __construct($ip, $name, $url,\Goutte\Client $client) {
        $this->name = $name;
        $this->ip = $ip;
        $this->client = $client;
        $this->url = $url;
    }

    /**
     * Gets the first remote job from the server.
     *
     * Returns null if no jobs exist on the printer.
     * @return null|Job
     */
    public function getFirstRemoteJob() {
        $crawler = $this->client->request('GET', $this->url);
        $first_job = $crawler->filter(self::REMOTE_TABLE_NAME . "> tbody tr")->first();
        return Job::parseFromDom($first_job);
    }

    /**
     * Get the filesystem representation of the printer.
     *
     * Printers last job are stored in JSON files on the filesystem.
     * @return PrinterFile
     */
    public function getFilesystem() {
        return new PrinterFile($this->name);
    }

    /**
     * Gets the printer name from its URL.
     *
     * The printer name is the last digit in the IP address.
     *
     * @param string $url
     * @return string
     */
    public static function getNameFromUrl($url) {
        return explode('/', explode('.', $url)[3])[0];
    }

    public function toString() {
        return "Name: " . $this->name . " url: " . $this->url . "\n"; 
    }

} 
