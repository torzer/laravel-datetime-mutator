<?php

namespace Torzer\Common\Traits;

/**
 * Inject a function to automagically set mutators for date format, specially in
 * d/m/Y format.
 */
trait MapDateTimeMutator
{

    private function getMapDateTimeMutatorArray() {
        return isset($this->mapDateTimeMutator) ? $this->mapDateTimeMutator : [];
    }

    private function isMutatorMappedDateTime($key) {
        return array_key_exists($key, $this->getMapDateTimeMutatorArray());
    }

    private function getMapDateTimeMutator($key) {
        $mapArray = $this->getMapDateTimeMutatorArray();

        $formats = [
            'from' => $this->getDateFormat(),
            'to' => $this->getDateFormat()
        ];

        if ($this->isMutatorMappedDateTime($key)) {
            $formats = array_merge($formats, $mapArray[$key]);
        }

        return $formats;
    }

    private function setDateOnlyMongo($value, $formats) {
        if (array_key_exists('date-only', $formats) &&  $formats['date-only'])
        {
            if ($this instanceof \Jenssegers\Mongodb\Eloquent\Model)
            {
                $value->timezone('UTC')
                        ->setTime(0,0,0);

                return new \MongoDB\BSON\UTCDateTime($value);
            }
        }

        return $value;
    }


    /**
     * Convert a DateTime to a storable string, creating from the customized
     * dateFormatMutator.
     *
     * @param  \DateTime|int  $value
     * @param array $formats Array with from and to keys to map the formats
     * @return string
     */
    public function fromDateTimeFormatMutator($key, $value, $formats)
    {
        $originalDateFormat = $this->getDateFormat();

        $this->setDateFormat($formats['from']);

        $value = $this->asDateTime($value);

        $value = $this->setDateOnlyMongo($value, $formats);

        $this->setDateFormat($originalDateFormat);

        return $value->format($formats['to']);
    }

    /**
     * Overrides setAttribute from Eloquent to set format date based on-
     * dateFormatMutator array
     *
     * @param string $key
     * @param mixed $value
     */
    public function setAttribute($key, $value)
    {
        if ( $this->isMutatorMappedDateTime($key) )
        {
            if ($value && (in_array($key, $this->getDates()) || $this->isDateCastable($key)))
            {
                $value = $this->fromDateTimeFormatMutator($key, $value, $this->getMapDateTimeMutator($key));
            }

            $this->attributes[$key] = $value;

            return $this;
        }

        return parent::setAttribute($key, $value);
    }

}
