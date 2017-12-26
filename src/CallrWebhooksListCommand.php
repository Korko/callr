<?php
namespace Korko\Callr;

use Korko\Callr\CallrClient;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CallrWebhooksListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'callr:get-webhooks-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Callr command to list subscribed webhooks.';

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
        $hooks = array_map(function($row) { return (array) $row; }, (array) $this->callr->getApi()->call('webhooks.get_list'));

        if(count($hooks) > 0) {
            $this->table(array_keys(current($hooks)), $hooks);
        } else {
            $this->info('No hook to list');
        }
    }
}

