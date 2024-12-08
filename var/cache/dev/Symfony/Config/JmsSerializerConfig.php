<?php

namespace Symfony\Config;

require_once __DIR__.\DIRECTORY_SEPARATOR.'JmsSerializer'.\DIRECTORY_SEPARATOR.'HandlersConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'JmsSerializer'.\DIRECTORY_SEPARATOR.'SubscribersConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'JmsSerializer'.\DIRECTORY_SEPARATOR.'ObjectConstructorsConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'JmsSerializer'.\DIRECTORY_SEPARATOR.'PropertyNamingConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'JmsSerializer'.\DIRECTORY_SEPARATOR.'ExpressionEvaluatorConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'JmsSerializer'.\DIRECTORY_SEPARATOR.'MetadataConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'JmsSerializer'.\DIRECTORY_SEPARATOR.'VisitorsConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'JmsSerializer'.\DIRECTORY_SEPARATOR.'DefaultContextConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'JmsSerializer'.\DIRECTORY_SEPARATOR.'InstancesConfig.php';

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class JmsSerializerConfig implements \Symfony\Component\Config\Builder\ConfigBuilderInterface
{
    private $twigEnabled;
    private $profiler;
    private $enumSupport;
    private $handlers;
    private $subscribers;
    private $objectConstructors;
    private $propertyNaming;
    private $expressionEvaluator;
    private $metadata;
    private $visitors;
    private $defaultContext;
    private $instances;
    private $_usedProperties = [];

    /**
     * @default 'default'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function twigEnabled($value): self
    {
        $this->_usedProperties['twigEnabled'] = true;
        $this->twigEnabled = $value;

        return $this;
    }

    /**
     * @default true
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function profiler($value): self
    {
        $this->_usedProperties['profiler'] = true;
        $this->profiler = $value;

        return $this;
    }

    /**
     * @default false
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function enumSupport($value): self
    {
        $this->_usedProperties['enumSupport'] = true;
        $this->enumSupport = $value;

        return $this;
    }

    public function handlers(array $value = []): \Symfony\Config\JmsSerializer\HandlersConfig
    {
        if (null === $this->handlers) {
            $this->_usedProperties['handlers'] = true;
            $this->handlers = new \Symfony\Config\JmsSerializer\HandlersConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "handlers()" has already been initialized. You cannot pass values the second time you call handlers().');
        }

        return $this->handlers;
    }

    public function subscribers(array $value = []): \Symfony\Config\JmsSerializer\SubscribersConfig
    {
        if (null === $this->subscribers) {
            $this->_usedProperties['subscribers'] = true;
            $this->subscribers = new \Symfony\Config\JmsSerializer\SubscribersConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "subscribers()" has already been initialized. You cannot pass values the second time you call subscribers().');
        }

        return $this->subscribers;
    }

    public function objectConstructors(array $value = []): \Symfony\Config\JmsSerializer\ObjectConstructorsConfig
    {
        if (null === $this->objectConstructors) {
            $this->_usedProperties['objectConstructors'] = true;
            $this->objectConstructors = new \Symfony\Config\JmsSerializer\ObjectConstructorsConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "objectConstructors()" has already been initialized. You cannot pass values the second time you call objectConstructors().');
        }

        return $this->objectConstructors;
    }

    /**
     * @return \Symfony\Config\JmsSerializer\PropertyNamingConfig|$this
     */
    public function propertyNaming($value = [])
    {
        if (!\is_array($value)) {
            $this->_usedProperties['propertyNaming'] = true;
            $this->propertyNaming = $value;

            return $this;
        }

        if (!$this->propertyNaming instanceof \Symfony\Config\JmsSerializer\PropertyNamingConfig) {
            $this->_usedProperties['propertyNaming'] = true;
            $this->propertyNaming = new \Symfony\Config\JmsSerializer\PropertyNamingConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "propertyNaming()" has already been initialized. You cannot pass values the second time you call propertyNaming().');
        }

        return $this->propertyNaming;
    }

    /**
     * @return \Symfony\Config\JmsSerializer\ExpressionEvaluatorConfig|$this
     */
    public function expressionEvaluator($value = [])
    {
        if (!\is_array($value)) {
            $this->_usedProperties['expressionEvaluator'] = true;
            $this->expressionEvaluator = $value;

            return $this;
        }

        if (!$this->expressionEvaluator instanceof \Symfony\Config\JmsSerializer\ExpressionEvaluatorConfig) {
            $this->_usedProperties['expressionEvaluator'] = true;
            $this->expressionEvaluator = new \Symfony\Config\JmsSerializer\ExpressionEvaluatorConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "expressionEvaluator()" has already been initialized. You cannot pass values the second time you call expressionEvaluator().');
        }

        return $this->expressionEvaluator;
    }

    public function metadata(array $value = []): \Symfony\Config\JmsSerializer\MetadataConfig
    {
        if (null === $this->metadata) {
            $this->_usedProperties['metadata'] = true;
            $this->metadata = new \Symfony\Config\JmsSerializer\MetadataConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "metadata()" has already been initialized. You cannot pass values the second time you call metadata().');
        }

        return $this->metadata;
    }

    public function visitors(array $value = []): \Symfony\Config\JmsSerializer\VisitorsConfig
    {
        if (null === $this->visitors) {
            $this->_usedProperties['visitors'] = true;
            $this->visitors = new \Symfony\Config\JmsSerializer\VisitorsConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "visitors()" has already been initialized. You cannot pass values the second time you call visitors().');
        }

        return $this->visitors;
    }

    public function defaultContext(array $value = []): \Symfony\Config\JmsSerializer\DefaultContextConfig
    {
        if (null === $this->defaultContext) {
            $this->_usedProperties['defaultContext'] = true;
            $this->defaultContext = new \Symfony\Config\JmsSerializer\DefaultContextConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "defaultContext()" has already been initialized. You cannot pass values the second time you call defaultContext().');
        }

        return $this->defaultContext;
    }

    public function instances(string $name, array $value = []): \Symfony\Config\JmsSerializer\InstancesConfig
    {
        if (!isset($this->instances[$name])) {
            $this->_usedProperties['instances'] = true;
            $this->instances[$name] = new \Symfony\Config\JmsSerializer\InstancesConfig($value);
        } elseif (1 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "instances()" has already been initialized. You cannot pass values the second time you call instances().');
        }

        return $this->instances[$name];
    }

    public function getExtensionAlias(): string
    {
        return 'jms_serializer';
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('twig_enabled', $value)) {
            $this->_usedProperties['twigEnabled'] = true;
            $this->twigEnabled = $value['twig_enabled'];
            unset($value['twig_enabled']);
        }

        if (array_key_exists('profiler', $value)) {
            $this->_usedProperties['profiler'] = true;
            $this->profiler = $value['profiler'];
            unset($value['profiler']);
        }

        if (array_key_exists('enum_support', $value)) {
            $this->_usedProperties['enumSupport'] = true;
            $this->enumSupport = $value['enum_support'];
            unset($value['enum_support']);
        }

        if (array_key_exists('handlers', $value)) {
            $this->_usedProperties['handlers'] = true;
            $this->handlers = new \Symfony\Config\JmsSerializer\HandlersConfig($value['handlers']);
            unset($value['handlers']);
        }

        if (array_key_exists('subscribers', $value)) {
            $this->_usedProperties['subscribers'] = true;
            $this->subscribers = new \Symfony\Config\JmsSerializer\SubscribersConfig($value['subscribers']);
            unset($value['subscribers']);
        }

        if (array_key_exists('object_constructors', $value)) {
            $this->_usedProperties['objectConstructors'] = true;
            $this->objectConstructors = new \Symfony\Config\JmsSerializer\ObjectConstructorsConfig($value['object_constructors']);
            unset($value['object_constructors']);
        }

        if (array_key_exists('property_naming', $value)) {
            $this->_usedProperties['propertyNaming'] = true;
            $this->propertyNaming = \is_array($value['property_naming']) ? new \Symfony\Config\JmsSerializer\PropertyNamingConfig($value['property_naming']) : $value['property_naming'];
            unset($value['property_naming']);
        }

        if (array_key_exists('expression_evaluator', $value)) {
            $this->_usedProperties['expressionEvaluator'] = true;
            $this->expressionEvaluator = \is_array($value['expression_evaluator']) ? new \Symfony\Config\JmsSerializer\ExpressionEvaluatorConfig($value['expression_evaluator']) : $value['expression_evaluator'];
            unset($value['expression_evaluator']);
        }

        if (array_key_exists('metadata', $value)) {
            $this->_usedProperties['metadata'] = true;
            $this->metadata = new \Symfony\Config\JmsSerializer\MetadataConfig($value['metadata']);
            unset($value['metadata']);
        }

        if (array_key_exists('visitors', $value)) {
            $this->_usedProperties['visitors'] = true;
            $this->visitors = new \Symfony\Config\JmsSerializer\VisitorsConfig($value['visitors']);
            unset($value['visitors']);
        }

        if (array_key_exists('default_context', $value)) {
            $this->_usedProperties['defaultContext'] = true;
            $this->defaultContext = new \Symfony\Config\JmsSerializer\DefaultContextConfig($value['default_context']);
            unset($value['default_context']);
        }

        if (array_key_exists('instances', $value)) {
            $this->_usedProperties['instances'] = true;
            $this->instances = array_map(function ($v) { return new \Symfony\Config\JmsSerializer\InstancesConfig($v); }, $value['instances']);
            unset($value['instances']);
        }

        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['twigEnabled'])) {
            $output['twig_enabled'] = $this->twigEnabled;
        }
        if (isset($this->_usedProperties['profiler'])) {
            $output['profiler'] = $this->profiler;
        }
        if (isset($this->_usedProperties['enumSupport'])) {
            $output['enum_support'] = $this->enumSupport;
        }
        if (isset($this->_usedProperties['handlers'])) {
            $output['handlers'] = $this->handlers->toArray();
        }
        if (isset($this->_usedProperties['subscribers'])) {
            $output['subscribers'] = $this->subscribers->toArray();
        }
        if (isset($this->_usedProperties['objectConstructors'])) {
            $output['object_constructors'] = $this->objectConstructors->toArray();
        }
        if (isset($this->_usedProperties['propertyNaming'])) {
            $output['property_naming'] = $this->propertyNaming instanceof \Symfony\Config\JmsSerializer\PropertyNamingConfig ? $this->propertyNaming->toArray() : $this->propertyNaming;
        }
        if (isset($this->_usedProperties['expressionEvaluator'])) {
            $output['expression_evaluator'] = $this->expressionEvaluator instanceof \Symfony\Config\JmsSerializer\ExpressionEvaluatorConfig ? $this->expressionEvaluator->toArray() : $this->expressionEvaluator;
        }
        if (isset($this->_usedProperties['metadata'])) {
            $output['metadata'] = $this->metadata->toArray();
        }
        if (isset($this->_usedProperties['visitors'])) {
            $output['visitors'] = $this->visitors->toArray();
        }
        if (isset($this->_usedProperties['defaultContext'])) {
            $output['default_context'] = $this->defaultContext->toArray();
        }
        if (isset($this->_usedProperties['instances'])) {
            $output['instances'] = array_map(function ($v) { return $v->toArray(); }, $this->instances);
        }

        return $output;
    }

}
