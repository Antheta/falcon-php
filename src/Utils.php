<?php

namespace Antheta\Falcon;

use Antheta\Falcon\Traits\CoreHelpers;
use Antheta\Falcon\Traits\DriverControl;
use Antheta\Falcon\Traits\OptionsControl;
use Antheta\Falcon\Traits\ParserControl;

abstract class Utils
{
    use OptionsControl, CoreHelpers, ParserControl, DriverControl;
}
