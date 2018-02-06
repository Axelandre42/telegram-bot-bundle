<?php

declare(strict_types=1);

namespace Ialert\TelegramBotBundle\Telegram;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface TelegramApiInterface
{
    /**
     * @param Request $request
     * @return Response
     */
    public function handleUpdate(Request $request): Response;
}
