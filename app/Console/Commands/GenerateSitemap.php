<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Sitemap is generated dynamically from the sitemap routes.';

    public function handle(): int
    {
        $this->info('Sitemap is available at /sitemap.xml and updates dynamically.');

        return self::SUCCESS;
    }
}
