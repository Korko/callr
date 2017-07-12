<?php
namespace Korko\Callr;

use Korko\Callr\CallrClient;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CallrSmsCommand extends Command
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
    protected $description = 'Callr command to test Callr API Integration.';

    /**
     * @var \Korko\Callr\CallrInterface
     */
    protected $callr;

    /**
     * Create a new command instance.
     *
     * @param \Korko\Callr\CallrClient $callr
     */
    public function __construct(CallrClient $callr)
    {
        parent::__construct();
        $this->callr = $callr;
    }

    /**
     * Execute the console command.
     */
    public function fire()
    {
        $this->line('Sending SMS via Callr to: '.$this->argument('phone'));

        // Grab the text option if specified
        $text = $this->argument('text');

        $this->line($text);

        $this->callr->message($this->argument('phone'), $text);
    }
}

