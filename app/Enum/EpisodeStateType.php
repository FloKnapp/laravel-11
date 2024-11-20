<?php

namespace App\Enum;

enum EpisodeStateType: string
{

    case DRAFT = 'draft';

    case PUBLISHED = 'published';

    case DELETED = 'deleted';

}
