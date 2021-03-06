<?php

class EmailTest extends PHPUnit_Framework_TestCase {

    /** @var  Mockery\MockInterface */
    protected $mock_transport;
    /** @var  Mockery\MockInterface */
    protected $mock_message;
    protected $job;
    protected $printer;

    public function setUp()
    {
        $this->mock_transport = Mockery::mock('\Nette\Mail\SmtpMailer');
        $this->mock_message = Mockery::mock('\Nette\Mail\Message');
        $this->job = new \Tpavlek\PrintJobs\Job(12, "Mock Job", "mock_owner", "printing", "print", 1);
        $this->printer = new \Tpavlek\PrintJobs\Printer("http://mockurl.com/test", 8, new \Goutte\Client());
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testConstructor()
    {
        $email = new \Tpavlek\PrintJobs\Email(
            $this->job,
            $this->printer,
            $this->mock_transport,
            $this->mock_message
        );

        $this->assertAttributeEquals($this->mock_transport, "mailer", $email);
        $this->assertAttributeEquals($this->mock_message, "message", $email);
        $this->assertAttributeEquals($this->job, "job", $email);
        $this->assertAttributeEquals($this->printer, "printer", $email);
    }

    public function testSendEmail() {
        $email = new \Tpavlek\PrintJobs\Email(
            $this->job,
            $this->printer,
            $this->mock_transport,
            $this->mock_message
        );

        $this->mock_message->shouldReceive(
                'setFrom',
                'setSubject',
                'addTo',
                'setBody'
            )
            ->andReturnSelf();
        $this->mock_transport->shouldReceive('send');

        $email->send([ "mock_email@ualberta.ca "]);
    }

}
