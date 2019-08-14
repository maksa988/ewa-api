<?php

namespace Maksa988\EwaAPI\Types;

class RegistrationType
{
    /**
     * @var string
     */
    const PERMANENT_WITHOUT_OTK = 'PERMANENT_WITHOUT_OTK';

    /**
     * @var string
     */
    const PERMANENT_WITH_OTK = 'PERMANENT_WITH_OTK';

    /**
     * @var string
     */
    const NOT_REGISTERED = 'NOT_REGISTERED';

    /**
     * @var string
     */
    const TEMPORARY = 'TEMPORARY';

    /**
     * @var string
     */
    const TEMPORARY_ENTRANCE = 'TEMPORARY_ENTRANCE';

    /**
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::PERMANENT_WITHOUT_OTK,
            self::PERMANENT_WITH_OTK,
            self::NOT_REGISTERED,
            self::TEMPORARY,
            self::TEMPORARY_ENTRANCE,
        ];
    }
}