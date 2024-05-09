<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;

class EventFixTimesCommand extends Command
{
    protected $signature = 'event:fix-times {--with-trashed : Include trashed events}';

    protected $description = 'Fixes the timestamps of events whose date does not match the regatta';

    public function handle(): int
    {
        $builder = Event::query();

        if ($this->option('with-trashed')) {
            $builder->withTrashed();
        }

        $builder->each(fn (Event $event) => $this->fixEvent($event));

        return static::SUCCESS;
    }

    private function fixEvent(Event $event): void
    {
        if ($event->time->isSameDay($event->regatta->date)) {
            return;
        }

        $this->info("Fixing event {$event->getKey()}");

        $event->update([
            'time' => $event->time->setDateFrom($event->regatta->date),
        ]);
    }
}
