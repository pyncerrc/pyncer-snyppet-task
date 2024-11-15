<?php
namespace Pyncer\Snyppet\Task\Table\Task;

use Pyncer\Snyppet\Task\Table\Task\TaskMapperQuery;
use Pyncer\Snyppet\Task\Table\Task\TaskModel;
use Pyncer\Data\Mapper\AbstractMapper;
use Pyncer\Data\MapperQuery\MapperQueryInterface;
use Pyncer\Data\Model\ModelInterface;

class TaskMapper extends AbstractMapper
{
    public function getTable(): string
    {
        return 'task';
    }

    public function forgeModel(iterable $data = []): ModelInterface
    {
        return new TaskModel($data);
    }

    public function isValidModel(ModelInterface $model): bool
    {
        return ($model instanceof TaskModel);
    }

    public function isValidMapperQuery(MapperQueryInterface $mapperQuery): bool
    {
        return ($mapperQuery instanceof TaskMapperQuery);
    }

    public function selectByAlias(
        string $alias,
    ): ?ModelInterface
    {
        return $this->selectByColumns([
            'alias' => $alias,
        ]);
    }
}
