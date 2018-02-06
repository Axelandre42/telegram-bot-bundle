<?php

declare(strict_types=1);

namespace Ialert\TelegramBotBundle\Telegram;

use Ialert\TelegramBotBundle\Event\Telegram\TelegramEvent;
use Ialert\TelegramBotBundle\Event\Telegram\UpdateEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class TelegramApi implements TelegramApiInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param Request $request
     *
     * @throws BadRequestHttpException
     *
     * @return Response
     */
    public function handleUpdate(Request $request): Response
    {
        try {
            $data = BotApi::jsonValidate($request->getContent(), true);
        } catch (\Exception $e) {
            throw new BadRequestHttpException('Empty data');
        }

        /** @var Update $update */
        $update = Update::fromResponse($data);
        $event = $this->processUpdate($update);

        return $event->getResponse() ? $event->getResponse() : new Response();
    }

    /**
     * @param Update $update
     *
     * @return UpdateEvent
     */
    public function processUpdate(Update $update): UpdateEvent
    {
        $event = new UpdateEvent($update);
        $this->eventDispatcher->dispatch(TelegramEvent::UPDATE, $event);

        return $event;
    }
}
