<?php
namespace Korko\CallR;

use Korko\CallR\CallRClient;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CallRSmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'callr:sms {phone} {text=This is a test message sent from the artisan console}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CallR command to test CallR API Integration.';

    /**
     * @var \Korko\CallR\CallRInterface
     */
    protected $callr;

    /**
     * Create a new command instance.
     *
     * @param \Korko\CallR\CallRClient $callr
     */
    public function __construct(CallRClient $callr)
    {
        parent::__construct();
        $this->callr = $callr;
    }

    /**
     * Execute the console command.
     */
    public function fire()
    {
        $this->line('Sending SMS via CallR to: '.$this->argument('phone'));

        // Grab the text option if specified
        $text = $this->argument('text');

        $this->line($text);

        $this->callr->message($this->argument('phone'), $text);
    }
}

