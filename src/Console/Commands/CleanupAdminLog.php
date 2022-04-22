<?php

namespace Arbory\AdminLog\Console\Commands;

use Arbory\AdminLog\Models\AdminLog;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CleanupAdminLog extends Command
{
    /** @var string */
    protected $signature = 'arbory:cleanup-admin-log';

    /** @var string */
    protected $description = 'Cleanup Arbory admin log table';

    public function handle(): void
    {
        $retainFor = config('admin-log.cleanup.retain_for_days', 0);

        if ($retainFor) {
            $expiredBefore = Carbon::now()->subDays($retainFor);

            AdminLog::query()
                ->whereDate('created_at', '<=', $expiredBefore)
                ->delete();
        }
    }
}
