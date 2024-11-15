<?php
namespace Pyncer\Snyppet\Task\Table\Task;

use DateTime;
use DateTimeInterface;
use Pyncer\Data\Model\AbstractModel;

use function Pyncer\date_time as pyncer_date_time;

use const Pyncer\DATE_TIME_FORMAT as PYNCER_DATE_TIME_FORMAT;

class TaskModel extends AbstractModel
{
    public function getName(): string
    {
        return $this->get('name');
    }
    public function setName(string $value): static
    {
        $this->set('name', $value);
        return $this;
    }

    public function getAlias(): string
    {
        return $this->get('alias');
    }
    public function setAlias(string $value): static
    {
        $this->set('alias', $value);
        return $this;
    }

    public function getRunning(): bool
    {
        return $this->get('running');
    }
    public function setRunning(bool $value): static
    {
        $this->set('running', $value);
        return $this;
    }

    public function getRunningDateTime(): ?DateTime
    {
        $value = $this->get('running_date_time');
        return pyncer_date_time($value);
    }
    public function setRunningDateTime(null|string|DateTimeInterface $value): static
    {
        if ($value instanceof DateTimeInterface) {
            $value = $value->format(PYNCER_DATE_TIME_FORMAT);
        }
        $this->set('running_date_time', $this->nullify($value));
        return $this;
    }

    public static function getDefaultData(): array
    {
        return [
            'id' => 0,
            'name' => '',
            'alias' => '',
            'running' => false,
            'running_date_time' => null,
        ];
    }
}
