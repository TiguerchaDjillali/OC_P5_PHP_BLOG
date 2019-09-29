<?php


namespace OpenFram\Routing;


use phpDocumentor\Reflection\Types\Boolean;

/**
 * Class Route
 *
 * @package OpenFram\Routing
 */
class Route
{
    protected $url;
    protected $module;
    protected $action;
    protected $varsNames = [];
    protected $vars = [];

    public function __construct($url, $module, $action, array $varsNames = [])
    {
        $this->setUrl($url);
        $this->setModule($module);
        $this->setAction($action);
        $this->setVarsNames($varsNames);
    }

    /**
     * @return bool
     */
    public function hasVars(): bool
    {
        return !empty($this->varsNames);
    }

    /**
     * @param  String $url
     * @return bool|array
     */
    public function match(string $url)
    {
        if (preg_match('`^' . $this->url . '$`', $url, $matches)) {
            return $matches;
        } else {
            return false;
        }
    }


    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getModule(): string
    {
        return $this->module;
    }

    /**
     * @param string $module
     */
    public function setModule(string $module): void
    {
        $this->module = $module;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action): void
    {
            $this->action = $action;
    }

    /**
     * @return array
     */
    public function getVarsNames(): array
    {
        return $this->varsNames;
    }

    /**
     * @param array $varsNames
     */
    public function setVarsNames(array $varsNames)
    {
        $this->varsNames = $varsNames;
    }

    /**
     * @return array
     */
    public function getVars(): array
    {
        return $this->vars;
    }

    /**
     * @param array $vars
     */
    public function setVars(array $vars)
    {
        $this->vars = $vars;
    }
}
