<?php

declare(strict_types=1);

namespace Ialert\TelegramBotBundle\Event\Telegram;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Response;
use TelegramBot\Api\Types\Update;

class UpdateEvent extends Event
{
    /**
     * @var Update
     */
    private $update;

    /**
     * @var Response
     */
    private $response;

    public function __construct(Update $update)
    {
        $this->update = $update;
    }

    /**
     * @param Update $update
     */
    public function setUpdate(Update $update)
    {
        $this->update = $update;
    }

    /**
     * @return Update|null
     */
    public function getUpdate(): ?Update
    {
        return $this->update;
    }

    /**
     * @return Response|null
     */
    public function getResponse(): ?Response
    {
        return $this->response;
    }

    /**
     * @param Response $response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }
}
