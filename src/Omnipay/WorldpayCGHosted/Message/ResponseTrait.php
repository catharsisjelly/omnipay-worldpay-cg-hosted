<?php

namespace Omnipay\WorldpayCGHosted\Message;

/**
 * Encapsulates response-like behaviour shared between actual Worldpay response objects and notifications, which
 * actually come in Worldpay-initiated requests.
 */
trait ResponseTrait
{
    /** @var string */
    protected static $PAYMENT_STATUS_AUTHORISED = 'AUTHORISED';
    /** @var string */
    protected static $PAYMENT_STATUS_CAPTURED   = 'CAPTURED';
    /** @var \SimpleXMLElement */
    protected $data;

    /**
     * Get is successful
     *
     * @return bool
     */
    public function isSuccessful()
    {
        if (!isset($this->data->payment->lastEvent)) {
            return false;
        }

        return in_array(
            strtoupper($this->data->payment->lastEvent),
            [
                self::$PAYMENT_STATUS_AUTHORISED,
                self::$PAYMENT_STATUS_CAPTURED,
            ],
            true
        );
    }
}
