<?php

namespace Modules\Core\Console\Commands;

use Illuminate\Foundation\Console\DownCommand as OriginalCommand;
use Modules\Core\Models\Channel;

class DownCommand extends OriginalCommand
{
    public function handle()
    {
        $this->downAllChannel();
        
        parent::handle();
    }

    protected function downAllChannel()
    {
        $this->comment('All channels are down.');
        return Channel::query()->update(['is_maintenance_on' => 1]);
    }
}
