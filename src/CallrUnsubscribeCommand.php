<?php
namespace Korko\Callr;

use Korko\Callr\CallrClient;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CallrUnsubscribeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'callr:unsubscribe {hash}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Callr command to unsubscribe to webhooks.';

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
        $this->line('Unsubscribing to webhook '.$this->argument('hash'));
        $this->callr->getApi()->call('webhooks.unsubscribe', [ $this->argument('hash') ]);
    }
}

