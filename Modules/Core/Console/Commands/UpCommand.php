<?php

namespace Modules\Core\Console\Commands;

use Illuminate\Foundation\Console\UpCommand as OriginalCommand;
use Modules\Core\Models\Channel;

class UpCommand extends OriginalCommand
{
    public function handle()
    {
        $this->upAllChannel();
        
        parent::handle();
    }

    protected function upAllChannel()
    {
        $this->comment('Activating all channels.');
        return Channel::query()->update(['is_maintenance_on' => 0]);
    }
}
