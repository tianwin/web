<?php

namespace Mautic\WebhookBundle\Entity;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\ClassMetadata;
use Mautic\CoreBundle\Doctrine\Mapping\ClassMetadataBuilder;

/**
 * Class Log.
 */
class Log
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Webhook
     */
    private $webhook;

    /**
     * @var string
     */
    private $statusCode;

    /**
     * @var \DateTime
     */
    private $dateAdded;

    /**
     * @var float
     */
    private $runtime;

    /**
     * @var string
     */
    private $note;

    public static function loadMetadata(ClassMetadata $metadata)
    {
        $builder = new ClassMetadataBuilder($metadata);
        $builder->setTable('webhook_logs')
            ->setCustomRepositoryClass(LogRepository::class)
            ->addId();

        $builder->createManyToOne('webhook', 'Webhook')
            ->inversedBy('logs')
            ->addJoinColumn('webhook_id', 'id', false, false, 'CASCADE')
            ->build();

        $builder->createField('statusCode', Type::STRING)
            ->columnName('status_code')
            ->length(50)
            ->build();

        $builder->addNullableField('dateAdded', Type::DATETIME, 'date_added');
        $builder->addNullableField('note', Type::STRING);
        $builder->addNullableField('runtime', Type::FLOAT);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Webhook
     */
    public function getWebhook()
    {
        return $this->webhook;
    }

    /**
     * @return Log
     */
    public function setWebhook(Webhook $webhook)
    {
        $this->webhook = $webhook;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     *
     * @return Log
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * @return Log
     */
    public function setDateAdded(\DateTime $dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Strips tags and keeps first 191 characters so it would fit in the varchar 191 limit.
     *
     * @param string $note
     *
     * @return Log
     */
    public function setNote($note)
    {
        $this->note = substr(strip_tags(iconv('UTF-8', 'UTF-8//IGNORE', $note)), 0, 190);

        return $this;
    }

    /**
     * @return float
     */
    public function getRuntime()
    {
        return $this->runtime;
    }

    /**
     * @param float $runtime
     *
     * @return Log
     */
    public function setRuntime($runtime)
    {
        $this->runtime = round($runtime, 2);

        return $this;
    }
}
