<?php
namespace Pyncer\Snyppet\Task\Table\Task;

use Pyncer\Snyppet\Task\Table\Task\TaskModel;
use Pyncer\Data\MapperQuery\AbstractRequestMapperQuery;
use Pyncer\Data\Model\ModelInterface;
use Pyncer\Database\ConnectionInterface;
use Pyncer\Database\Record\SelectQueryInterface;

class TaskMapperQuery extends AbstractRequestMapperQuery
{
    protected function isValidFilter(
        string $left,
        mixed $right,
        string $operator
    ): bool
    {
        if ($left === 'alias' && is_string($right) && $operator === '=') {
            return true;
        }

        if ($left === 'running' && is_bool($right) && $operator === '=') {
            return true;
        }

        return parent::isValidFilter($left, $right, $operator);
    }
}
