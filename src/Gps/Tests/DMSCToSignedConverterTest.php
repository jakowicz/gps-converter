<?php

namespace SimonJakowicz\Gps\Tests;

use SimonJakowicz\Gps\Converters\DMSCToSignedConverter;

/**
 * Test the Gps coverter for DMSC format to signed degree format
 */
class DMSCToSignedConverterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Get a collection of co-ordinates in DMSC and signed formats
     * Degree, Minute Second latitude
     * Compass direction latitude
     * Degree, Minute Second Longitude
     * Compass direction Longitude
     * Signed latitude
     * Signed longitude
     *
     * @return array Collection of co-ordinates
     */
    public function getCoordinates()
    {
        return array(
            array(
                array("41", "25", "01"),
                "N",
                array("120", "58", "57"),
                "W",
                41.416944444444,
                -120.9825,
                '785/100',
                '7.85'
            )
        );
    }

    /**
     * Check to see getLatitude is working author
     *
     * @dataProvider getCoordinates
     * @covers SimonJakowicz\Gps\Converters\DMSCToSignedConverter::getLatitude
     */
    public function testGetLatitude(
        $dmsLatitude,
        $compassLatitude,
        $dmsLongitude,
        $compassLongitude,
        $signedLatutude,
        $signedLongitude,
        $dmsAltitude,
        $signedAltitude
    ) {
        $converter = new DMSCToSignedConverter($dmsLatitude, $compassLatitude, $dmsLongitude, $compassLongitude, $dmsAltitude);
        $this->assertEquals($converter->getLatitude(), $signedLatutude);
    }

    /**
     * Check to see getLongitude is working correctly
     *
     * @dataProvider getCoordinates
     * @covers SimonJakowicz\Gps\Converters\DMSCToSignedConverter::getLongitude
     */
    public function testGetLongitude(
        $dmsLatitude,
        $compassLatitude,
        $dmsLongitude,
        $compassLongitude,
        $signedLatutude,
        $signedLongitude,
        $dmsAltitude,
        $signedAltitude
    ) {
        $converter = new DMSCToSignedConverter($dmsLatitude, $compassLatitude, $dmsLongitude, $compassLongitude, $dmsAltitude);
        $this->assertEquals($converter->getLongitude(), $signedLongitude);
    }

    /**
     * Check to see getLongitude is working correctly
     *
     * @dataProvider getCoordinates
     * @covers SimonJakowicz\Gps\Converters\DMSCToSignedConverter::getLongitude
     */
    public function testGetAltitude(
        $dmsLatitude,
        $compassLatitude,
        $dmsLongitude,
        $compassLongitude,
        $signedLatutude,
        $signedLongitude,
        $dmsAltitude,
        $signedAltitude
    ) {
        $converter = new DMSCToSignedConverter($dmsLatitude, $compassLatitude, $dmsLongitude, $compassLongitude, $dmsAltitude);
        $this->assertEquals($converter->getAltitude(), $signedAltitude);
    }

    /**
     * Check to see getCoordinates is working correctly
     *
     * @author Simon Jakowicz
     * @dataProvider getCoordinates
     * @covers SimonJakowicz\Gps\Converters\DMSCToSignedConverter::getCoordinates
     */
    public function testGetCoordinates(
        $dmsLatitude,
        $compassLatitude,
        $dmsLongitude,
        $compassLongitude,
        $signedLatutude,
        $signedLongitude,
        $dmsAltitude,
        $signedAltitude
    ) {
        $converter = new DMSCToSignedConverter($dmsLatitude, $compassLatitude, $dmsLongitude, $compassLongitude, $dmsAltitude);
        $this->assertEquals($converter->getCoordinates(), $signedLatutude . ', ' . $signedLongitude);
    }
}
