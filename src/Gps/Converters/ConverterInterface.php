<?php

namespace SimonJakowicz\Gps\Converters;

/**
 * An interface for all GPS format converter classes
 *
 * @author Simon Jakowicz
 */
interface ConverterInterface
{

    /**
     * get new latitude value
     * @return string
     */
    public function getLatitude();

    /**
     * get new longitude value
     * @return string
     */
    public function getLongitude();

    /**
     * get the new gps co-ordinates
     * @return string
     */
    public function getCoordinates();
}
