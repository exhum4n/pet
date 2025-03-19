<?php

declare(strict_types=1);

namespace App\Broadcasting\Centrifugo;

enum CentrifugoMethod
{
    case publish;
    case broadcast;
    case subscribe;
    case unsubscribe;
    case history;
    case history_remove;
    case batch;
    case presence;
    case presence_stats;
    case disconnect;
    case channels;
    case info;
}
