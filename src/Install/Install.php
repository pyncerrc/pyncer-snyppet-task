<?php
namespace Pyncer\Snyppet\Task\Install;

use Pyncer\Snyppet\AbstractInstall;

class Install extends AbstractInstall
{
    protected function safeInstall(): bool
    {
        $this->connection->createTable('task')
            ->serial('id')
            ->string('name', 50)->null()
            ->string('alias', 50)->null()->index()->index('#unique')->unique()
            ->bool('running')->default(false)->index()
            ->dateTime('running_date_time')->null()->index()
            ->execute();

        return true;
    }

    protected function safeUninstall(): bool
    {
        if ($this->connection->hasTable('task')) {
            $this->connection->dropTable('task');
        }

        return true;
    }
}
