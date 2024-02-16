<?php

namespace App\Enumeration;

enum TrickStatus: string
{
    case published = 'published';
    case pending = 'pending';
    case unpublished = 'unpublished';
}


