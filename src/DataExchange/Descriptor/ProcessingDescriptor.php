<?php

/*
 * Copyright (C) 2015-2018 Libre Informatique
 *
 * This file is licensed under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PiaApi\DataExchange\Descriptor;

use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

class ProcessingDescriptor
{
    /**
     * @JMS\Type("string")
     * @JMS\Groups({"Default", "Export"})
     * @Assert\NotBlank
     *
     * @var string
     */
    protected $name = '';

    /**
     * @JMS\Type("string")
     * @JMS\Groups({"Default", "Export"})
     * @Assert\NotBlank
     *
     * @var string
     */
    protected $author = '';

    /**
     * @JMS\Type("string")
     * @JMS\Groups({"Default", "Export"})
     * @Assert\NotBlank
     *
     * @var string
     */
    protected $controllers = '';

    /**
     * @JMS\Type("string")
     * @JMS\Groups({"Default", "Export"})
     *
     * @var string|null
     */
    protected $description = '';

    /**
     * @JMS\Type("string")
     * @JMS\Groups({"Default", "Export"})
     *
     * @var string|null
     */
    protected $processors = '';

    /**
     * @JMS\Type("string")
     * @JMS\Groups({"Default", "Export"})
     *
     * @var string|null
     */
    protected $nonEuTransfer = '';

    /**
     * @JMS\Type("string")
     * @JMS\Groups({"Default", "Export"})
     *
     * @var string|null
     */
    protected $lifeCycle = '';

    /**
     * @JMS\Type("string")
     * @JMS\Groups({"Default", "Export"})
     *
     * @var string|null
     */
    protected $storage = '';

    /**
     * @JMS\Type("string")
     * @JMS\Groups({"Default", "Export"})
     *
     * @var string|null
     */
    protected $standards = '';

    /**
     * @JMS\Type("string")
     * @JMS\Groups({"Default", "Export"})
     *
     * @var string|null
     */
    protected $status = '';

    /**
     * @JMS\Type("DateTime")
     * @JMS\Groups({"Export"})
     *
     * @var \DateTime|null
     */
    protected $createdAt = '';

    /**
     * @JMS\Type("DateTime")
     * @JMS\Groups({"Export"})
     *
     * @var \DateTime|null
     */
    protected $updatedAt = '';

    public function __construct(
        string $name,
        string $author,
        string $controllers,
        string $description = null,
        string $processors = null,
        string $nonEuTransfer = null,
        string $lifeCycle = null,
        string $storage = null,
        string $standards = null,
        string $status = null,
        \DateTime $createdAt = null,
        \DateTime $updatedAt = null
    ) {
        $this->name = $name;
        $this->author = $author;
        $this->controllers = $controllers;
        $this->description = $description;
        $this->processors = $processors;
        $this->nonEuTransfer = $nonEuTransfer;
        $this->lifeCycle = $lifeCycle;
        $this->storage = $storage;
        $this->standards = $standards;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    protected function checkProperty($mode, $method)
    {
        $attribute = false;
        $reflect = new \ReflectionClass($this);

        $name = lcfirst(str_replace($mode, '', $method));
        $properties = array_column($reflect->getProperties(), 'name');

        if (in_array($name, $properties)) {
            $attribute = $name;
        }

        return $attribute;
    }

    public function __call($method, $args)
    {
        $value = false;

        if (strpos($method, 'set') !== false) {
            if ($name = $this->checkProperty('set', $method)) {
                $this->$name = $args[0];
            }

            $value = true;
        }

        if (strpos($method, 'get') !== false) {
            if ($name = $this->checkProperty('get', $method)) {
                $value = $this->$name;
            }
        }

        return $value;
    }
}