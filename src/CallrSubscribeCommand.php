<?php
namespace Korko\Callr;

use Korko\Callr\CallrClient;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CallrSubscribeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'callr:subscribe {type} {endpoint} {options?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Callr command to subscribe to webhooks.';

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
        $this->line('Subscribing to webhook '.$this->argument('type').' to '.$this->argument('endpoint'));

        $row = (array) $this->callr->getApi()->call('webhooks.subscribe', [ $this->argument('type'), $this->argument('endpoint'), $this->argument('options') ]);
        $this->table(array_keys($row), [$row]);
    }
}

