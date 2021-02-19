<?php

namespace OZiTAG\Tager\Backend\Menus;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\App;
use OZiTAG\Tager\Backend\Panel\Contracts\IRouteHandler;
use OZiTAG\Tager\Backend\Panel\Structures\TagerRouteHandler;

class TagerMenus
{
    /** @var string[] */
    private static array $variableJobs = [];

    /** @var mixed[] */
    private static array $variableDefaultValues = [];

    public function getVariableValue(string $variable): mixed
    {
        if (!array_key_exists($variable, self::$variableJobs)) {
            return self::$variableDefaultValues[$variable] ?? null;
        }

        $jobClassName = self::$variableJobs[$variable];

        try {
            $value = dispatch_now(new $jobClassName);
        } catch (\Exception $exception) {
            $value = null;
        }

        return $value;
    }

    public function isVariableExisted(string $variable): bool
    {
        return array_key_exists($variable, self::$variableJobs);
    }

    public static function registerVariable(string $variableName, string $jobClassName, mixed $defaultValue = null)
    {
        self::$variableJobs[$variableName] = $jobClassName;
        self::$variableDefaultValues[$variableName] = $defaultValue;
    }
}
