<?php

namespace SimonJakowicz\Gps\Converters;

use SimonJakowicz\Gps\Converters\ConverterInterface;

/**
 * Used to convert latitude and longitude
 * From Degrees, Minutes, Seconds and Compass direction format e.g. 41 25 01 N, 120 58 57 W
 * To Signed Degree Format e.g. 41.416944444444, -120.9825
 *
 * @author Simon Jakowicz
 */
class DMSCToSignedConverter implements ConverterInterface
{

    /**
     * Latitude - Degrees, Minutes, Seconds and Compass direction format
     *
     * @var string
     */
    private $gpsLatitude;

    /**
     * Latitude compass direction, should be either "N" or "S" for "North" and "South"
     *
     * @var string
     */
    private $gpsLatitudeRef;

    /**
     * Longitude - Degrees, Minutes, Seconds and Compass direction format
     *
     * @var string
     */
    private $gpsLongitude;

    /**
     * Longitude compass direction, should be either "E" or "W" for "East" and "West"
     *
     * @var string
     */
    private $gpsLongitudeRef;

    /**
     * Meters above sea level
     *
     * @var string
     */
    private $gpsAltitude;

    /**
     * initialise the GPS calculator
     * @param array  $gpsLatitude
     * @param string $gpsLatitudeDirection
     * @param array  $gpsLongitude
     * @param string $gpsLongitudeDirection
     * @param string $gpsAltitude
     */
    public function __construct(array $gpsLatitude, $gpsLatitudeDirection, array $gpsLongitude, $gpsLongitudeDirection, $gpsAltitude)
    {
        $this->gpsLatitude           = $gpsLatitude;
        $this->gpsLatitudeDirection  = $gpsLatitudeDirection;
        $this->gpsLongitude          = $gpsLongitude;
        $this->gpsLongitudeDirection = $gpsLongitudeDirection;
        $this->gpsAltitude           = $gpsAltitude;
    }

    /**
     * {@inheritdoc}
     */
    public function getLatitude()
    {
        $latitudeDegrees  = count($this->gpsLatitude) > 0 ? $this->gpsValueCalculate($this->gpsLatitude[0]) : 0;
        $latitudeMinutes  = count($this->gpsLatitude) > 1 ? $this->gpsValueCalculate($this->gpsLatitude[1]) : 0;
        $latitudeSeconds  = count($this->gpsLatitude) > 2 ? $this->gpsValueCalculate($this->gpsLatitude[2]) : 0;
        $latitudeFlip     = $this->gpsLatitudeDirection == 'S' ? -1 : 1;

        $latitude         = $latitudeFlip * ($latitudeDegrees + $latitudeMinutes / 60 + $latitudeSeconds / 3600);

        return $latitude;

    }

    /**
     * {@inheritdoc}
     */
    public function getLongitude()
    {

        $longitudeDegrees = count($this->gpsLongitude) > 0 ? $this->gpsValueCalculate($this->gpsLongitude[0]) : 0;
        $longitudeMinutes = count($this->gpsLongitude) > 1 ? $this->gpsValueCalculate($this->gpsLongitude[1]) : 0;
        $longitudeSeconds = count($this->gpsLongitude) > 2 ? $this->gpsValueCalculate($this->gpsLongitude[2]) : 0;
        $longitudeFlip    = $this->gpsLongitudeDirection == 'W' ? -1 : 1;
        $longitude        = $longitudeFlip * ($longitudeDegrees + $longitudeMinutes / 60 + $longitudeSeconds / 3600);

        return $longitude;

    }

    /**
     * {@inheritdoc}
     */
    public function getAltitude()
    {
        return $this->gpsValueCalculate($this->gpsAltitude);
    }

    /**
     * {@inheritdoc}
     */
    public function getCoordinates()
    {
        return $this->getLatitude() . ', ' . $this->getLongitude();
    }

    /**
     * calculate a specific GPS value based on its D/M/S/C value
     * @param  int|string $gpsValue e.g. 3, 10, 1/3, 5/9
     * @return float
     */
    private function gpsValueCalculate($gpsValue)
    {
        $parts = explode('/', $gpsValue);

        if (count($parts) <= 0) {
            return 0;
        } elseif (count($parts) == 1) {
            return $parts[0];
        }

        return floatval($parts[0]) / floatval($parts[1]);

    }
}
