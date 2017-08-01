<?php

namespace Torzer\Common\Traits;

/**
 * Inject a function to automagically set mutators for date format, specially in
 * d/m/Y format.
 */
trait MapDateTimeMutator
{


    /**
     * Convert a DateTime to a storable string, creating from the customized
     * dateFormatMutator.
     *
     * @param  \DateTime|int  $value
     * @param array $formats Array with from and to keys to map the formats
     * @return string
     */
    public function fromDateTimeFormatMutator($value, $formats)
    {
        $originalDateFormat = $this->getDateFormat();

        $this->setDateFormat($formats['from']);

        $value = $this->asDateTime($value);

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
        $mapDateTimeMutator = isset($this->mapDateTimeMutator) ? $this->mapDateTimeMutator : [];

        if (array_key_exists($key, $mapDateTimeMutator)) {
            if ($value && (in_array($key, $this->getDates()) || $this->isDateCastable($key))) {
                $value = $this->fromDateTimeFormatMutator($value, $mapDateTimeMutator[$key]);
            }

            $this->attributes[$key] = $value;

            return $this;
        }

        return parent::setAttribute($key, $value);
    }

}
