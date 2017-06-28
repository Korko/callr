<?php
namespace Korko\CallR;

use Korko\CallR\CallRClient;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CallRSmsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'callr:sms';

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
        $text = $this->option('text');

        // If we havent specified a message, setup a default one
        if (is_null($text)) {
            $text = 'This is a test message sent from the artisan console';
        }

        $this->line($text);

        $this->callr->message($this->argument('phone'), $text);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['phone', InputArgument::REQUIRED, 'The phone number that will receive a test message.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['text', null, InputOption::VALUE_OPTIONAL, 'Optional message that will be sent.', null],
        ];
    }
}

