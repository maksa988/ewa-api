<?php

namespace Maksa988\EwaAPI\Types;

class CustomerCategory
{
    /**
     * @var string
     */
    const NATURAL = 'NATURAL';

    /**
     * @var string
     */
    const LEGAL = 'LEGAL';

    /**
     * @var string
     */
    const PRIVILEGED = 'PRIVILEGED';

    /**
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::NATURAL,
            self::LEGAL,
            self::PRIVILEGED,
        ];
    }
}