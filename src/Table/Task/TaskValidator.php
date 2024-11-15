<?php
namespace Pyncer\Snyppet\Task\Table\Task;

use Pyncer\Data\Validation\AbstractValidator;
use Pyncer\Database\ConnectionInterface;
use Pyncer\Validation\Rule\BoolRule;
use Pyncer\Validation\Rule\DateTimeRule;
use Pyncer\Validation\Rule\StringRule;

class TaskValidator extends AbstractValidator
{
    public function __construct(ConnectionInterface $connection)
    {
        parent::__construct($connection);

        $this->addRules(
            'name',
            new StringRule(
                maxLength: 50,
            ),
        );

        $this->addRules(
            'alias',
            new StringRule(
                maxLength: 50,
            ),
        );

        $this->addRules(
            'running',
            new BoolRule(),
        );

        $this->addRules(
            'running_date_time',
            new DateTimeRule(
                allowNull: true,
            ),
        );
    }
}
