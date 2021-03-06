<?php

namespace SwedbankPaymentPortal;

use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer as JMSSerializer;
use SwedbankPaymentPortal\SharedEntity\AbstractResponse;

/**
 * Turns class into xml string.
 */
class Serializer
{
    /**
     * @var JMSSerializer
     */
    private $serializer;

    /**
     * @var EventSubscriberInterface[]
     */
    private $subscribers = [];

    /**
     * Return xml data.
     *
     * @param object $object
     *
     * @return string
     */
    public function getXml($object)
    {
        return $this->getSerializer()->serialize($object, 'xml');
    }

    /**
     * Return xml data.
     *
     * @param string $xmlData
     * @param string $objectClass
     *
     * @return AbstractResponse
     */
    public function getObject($xmlData, $objectClass)
    {
        return $this->getSerializer()->deserialize($xmlData, $objectClass, 'xml');
    }

    /**
     * Adds subscriber.
     *
     * @param EventSubscriberInterface $subscriber
     */
    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        if ($this->serializer) {
            throw new \InvalidArgumentException('Serializer already created, cannot add subscriber.');
        }

        $this->subscribers[] = $subscriber;
    }

    /**
     * Returns serializer.
     *
     * @return JMSSerializer
     */
    private function getSerializer()
    {
        if (!$this->serializer) {
            $this->serializer = SerializerBuilder::create()->configureListeners(
                function (EventDispatcher $dispatcher) {
                    foreach ($this->subscribers as $subscriber) {
                        $dispatcher->addSubscriber($subscriber);
                    }
                }
            )->build();
        }

        return $this->serializer;
    }
}
