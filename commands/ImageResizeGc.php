<?php

namespace Pensoft\ImageResize\Commands;

use Pensoft\ImageResize\Classes\Resizer;
use Pensoft\ImageResize\Models\Settings;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ImageResizeGc extends Command
{
    protected $name = 'imageresize:gc';

    protected $description = 'Garbage collect all old resized images.';

    public function handle()
    {
        $minAge = Carbon::now()->modify('-' . Settings::getAgeToDelete());

        $deleted = Resizer::clearFiles($minAge);

        $this->info('Successfully deleted ' . $deleted . ' ' . Str::plural('file', $deleted));
    }
}
