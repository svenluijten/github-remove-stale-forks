<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;
use Sven\FileConfig\Stores\Store;
use Symfony\Component\Console\Input\InputArgument;

class AuthorizeCommand extends Command
{
    /**
     * @var string
     */
    protected $name = 'authorize';

    /**
     * @var string
     */
    protected $description = 'Configure your GitHub access token';

    public function handle(Store $store): ?int
    {
        $token = $this->argument('token') ?: $this->secret('What is your GitHub access token?', '');

        if (empty($token)) {
            $this->error('Please specify a GitHub access token to authenticate yourself.');
            $this->error('Head over to https://github.com/settings/tokens/new?scopes=public_repo,delete_repo&description=Github+Remove+Stale+Forks to generate one.');

            return 1;
        }

        $store->set('token', $token);

        return 0;
    }

    protected function getArguments(): array
    {
        return [
            ['token', InputArgument::OPTIONAL, 'Your GitHub access token'],
        ];
    }
}
