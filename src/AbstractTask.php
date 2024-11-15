<?php
namespace Pyncer\Snyppet\Task;

use Pyncer\Database\ConnectionInterface;
use Pyncer\Snyppet\Task\Table\Task\TaskMapper;
use Pyncer\Snyppet\Task\Table\Task\TaskModel;

abstract class AbstractTask
{
    protected array $errors = [];

    public function __construct(
        protected ConnectionInterface $connection,
        protected string $name,
        protected string $alias,
    ) {}

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function run(): void
    {
        $this->errors = [];

        $taskMapper = new TaskMapepr($this->connection);
        $taskModel = $taskMapper->selectByAlias($this->alias);

        if ($taskModel === null) {
            $taskModel = new TaskModel([
                'name' => $this->name,
                'alias' => $this->alias,
            ]);
        }

        if ($taskModel->getRunning()) {
            $this->errors[] = 'running';
            return;
        }

        $taskModel->setRunning(true);
        $taskModel->setRunningDateTime($this->connection->dateTime());

        $taskModel->replace($taskModel);

        $this->runTask();

        $taskModel->setRunning(false);
        $taskModel->setRunningDateTime(null);

        $taskModel->replace($taskModel);
    }

    abstract public function runTask(array $params = []): void;
}
