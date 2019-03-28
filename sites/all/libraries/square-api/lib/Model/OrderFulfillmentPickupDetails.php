<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * OrderFulfillmentPickupDetails Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class OrderFulfillmentPickupDetails implements ArrayAccess
{
    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'recipient' => '\SquareConnect\Model\OrderFulfillmentRecipient',
        'expires_at' => 'string',
        'auto_complete_duration' => 'string',
        'schedule_type' => 'string',
        'pickup_at' => 'string',
        'pickup_window_duration' => 'string',
        'prep_time_duration' => 'string',
        'note' => 'string',
        'placed_at' => 'string',
        'accepted_at' => 'string',
        'rejected_at' => 'string',
        'ready_at' => 'string',
        'expired_at' => 'string',
        'picked_up_at' => 'string',
        'canceled_at' => 'string',
        'cancel_reason' => 'string'
    );
  
    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'recipient' => 'recipient',
        'expires_at' => 'expires_at',
        'auto_complete_duration' => 'auto_complete_duration',
        'schedule_type' => 'schedule_type',
        'pickup_at' => 'pickup_at',
        'pickup_window_duration' => 'pickup_window_duration',
        'prep_time_duration' => 'prep_time_duration',
        'note' => 'note',
        'placed_at' => 'placed_at',
        'accepted_at' => 'accepted_at',
        'rejected_at' => 'rejected_at',
        'ready_at' => 'ready_at',
        'expired_at' => 'expired_at',
        'picked_up_at' => 'picked_up_at',
        'canceled_at' => 'canceled_at',
        'cancel_reason' => 'cancel_reason'
    );
  
    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'recipient' => 'setRecipient',
        'expires_at' => 'setExpiresAt',
        'auto_complete_duration' => 'setAutoCompleteDuration',
        'schedule_type' => 'setScheduleType',
        'pickup_at' => 'setPickupAt',
        'pickup_window_duration' => 'setPickupWindowDuration',
        'prep_time_duration' => 'setPrepTimeDuration',
        'note' => 'setNote',
        'placed_at' => 'setPlacedAt',
        'accepted_at' => 'setAcceptedAt',
        'rejected_at' => 'setRejectedAt',
        'ready_at' => 'setReadyAt',
        'expired_at' => 'setExpiredAt',
        'picked_up_at' => 'setPickedUpAt',
        'canceled_at' => 'setCanceledAt',
        'cancel_reason' => 'setCancelReason'
    );
  
    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'recipient' => 'getRecipient',
        'expires_at' => 'getExpiresAt',
        'auto_complete_duration' => 'getAutoCompleteDuration',
        'schedule_type' => 'getScheduleType',
        'pickup_at' => 'getPickupAt',
        'pickup_window_duration' => 'getPickupWindowDuration',
        'prep_time_duration' => 'getPrepTimeDuration',
        'note' => 'getNote',
        'placed_at' => 'getPlacedAt',
        'accepted_at' => 'getAcceptedAt',
        'rejected_at' => 'getRejectedAt',
        'ready_at' => 'getReadyAt',
        'expired_at' => 'getExpiredAt',
        'picked_up_at' => 'getPickedUpAt',
        'canceled_at' => 'getCanceledAt',
        'cancel_reason' => 'getCancelReason'
    );
  
    /**
      * $recipient The recipient of this pickup fulfillment.
      * @var \SquareConnect\Model\OrderFulfillmentRecipient
      */
    protected $recipient;
    /**
      * $expires_at The expiry [timestamp](#workingwithdates) in RFC 3339 format, e.g., \"2016-09-04T23:59:33.123Z\". This timestamp indicates when the pickup fulfillment will expire if it is not accepted by the merchant. Expiration time can only be set up to 7 days in the future. If not set, this pickup fulfillment will be automatically accepted when placed.
      * @var string
      */
    protected $expires_at;
    /**
      * $auto_complete_duration The auto completion duration in RFC3339 duration format, e.g., \"P1W3D\". If set, an open and accepted pickup fulfillment will automatically move to the `COMPLETED` state after this period of time. If not set, this pickup fulfillment will remain accepted until it is canceled or completed.
      * @var string
      */
    protected $auto_complete_duration;
    /**
      * $schedule_type The schedule type of the pickup fulfillment. Defaults to `SCHEDULED`. See [OrderFulfillmentPickupDetailsScheduleType](#type-orderfulfillmentpickupdetailsscheduletype) for possible values
      * @var string
      */
    protected $schedule_type;
    /**
      * $pickup_at The pickup [timestamp](#workingwithdates) in RFC3339 timestamp format, e.g., \"2016-09-04T23:59:33.123Z\". For fulfillments with the schedule type `ASAP`, this is automatically set to the current time plus the expected duration to prepare the fulfillment. This represents the start of the pickup window.
      * @var string
      */
    protected $pickup_at;
    /**
      * $pickup_window_duration The pickup window duration in RFC3339 duration format, e.g., \"P1W3D\". This duration represents the window of time for which the order should be picked up after the `pickup_at` time. Can be used as an informational guideline for merchants.
      * @var string
      */
    protected $pickup_window_duration;
    /**
      * $prep_time_duration The preparation time duration in RFC3339 duration format, e.g., \"P1W3D\". This duration indicates how long it takes the merchant to prepare this fulfillment.
      * @var string
      */
    protected $prep_time_duration;
    /**
      * $note A general note about the pickup fulfillment.  Notes are useful for providing additional instructions and are displayed in Square apps.
      * @var string
      */
    protected $note;
    /**
      * $placed_at The [timestamp](#workingwithdates) in RFC3339 timestamp format, e.g., \"2016-09-04T23:59:33.123Z\", indicating when the fulfillment was placed.
      * @var string
      */
    protected $placed_at;
    /**
      * $accepted_at The [timestamp](#workingwithdates) in RFC3339 timestamp format, e.g., \"2016-09-04T23:59:33.123Z\", indicating when the fulfillment was accepted by the merchant.
      * @var string
      */
    protected $accepted_at;
    /**
      * $rejected_at The [timestamp](#workingwithdates) in RFC3339 timestamp format, e.g., \"2016-09-04T23:59:33.123Z\", indicating when the fulfillment was rejected.
      * @var string
      */
    protected $rejected_at;
    /**
      * $ready_at The [timestamp](#workingwithdates) in RFC3339 timestamp format, e.g., \"2016-09-04T23:59:33.123Z\", indicating when the merchant set the fulfillment as ready for pickup.
      * @var string
      */
    protected $ready_at;
    /**
      * $expired_at The [timestamp](#workingwithdates) in RFC3339 timestamp format, e.g., \"2016-09-04T23:59:33.123Z\", indicating when the fulfillment expired.
      * @var string
      */
    protected $expired_at;
    /**
      * $picked_up_at The [timestamp](#workingwithdates) in RFC3339 timestamp format, e.g., \"2016-09-04T23:59:33.123Z\", indicating when the fulfillment was picked up by the recipient.
      * @var string
      */
    protected $picked_up_at;
    /**
      * $canceled_at The [timestamp](#workingwithdates) in RFC3339 timestamp format, e.g., \"2016-09-04T23:59:33.123Z\", indicating when the fulfillment was canceled by the merchant or buyer.
      * @var string
      */
    protected $canceled_at;
    /**
      * $cancel_reason A description of why the pickup was canceled. Max length is 100 characters.
      * @var string
      */
    protected $cancel_reason;

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initializing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            if (isset($data["recipient"])) {
              $this->recipient = $data["recipient"];
            } else {
              $this->recipient = null;
            }
            if (isset($data["expires_at"])) {
              $this->expires_at = $data["expires_at"];
            } else {
              $this->expires_at = null;
            }
            if (isset($data["auto_complete_duration"])) {
              $this->auto_complete_duration = $data["auto_complete_duration"];
            } else {
              $this->auto_complete_duration = null;
            }
            if (isset($data["schedule_type"])) {
              $this->schedule_type = $data["schedule_type"];
            } else {
              $this->schedule_type = null;
            }
            if (isset($data["pickup_at"])) {
              $this->pickup_at = $data["pickup_at"];
            } else {
              $this->pickup_at = null;
            }
            if (isset($data["pickup_window_duration"])) {
              $this->pickup_window_duration = $data["pickup_window_duration"];
            } else {
              $this->pickup_window_duration = null;
            }
            if (isset($data["prep_time_duration"])) {
              $this->prep_time_duration = $data["prep_time_duration"];
            } else {
              $this->prep_time_duration = null;
            }
            if (isset($data["note"])) {
              $this->note = $data["note"];
            } else {
              $this->note = null;
            }
            if (isset($data["placed_at"])) {
              $this->placed_at = $data["placed_at"];
            } else {
              $this->placed_at = null;
            }
            if (isset($data["accepted_at"])) {
              $this->accepted_at = $data["accepted_at"];
            } else {
              $this->accepted_at = null;
            }
            if (isset($data["rejected_at"])) {
              $this->rejected_at = $data["rejected_at"];
            } else {
              $this->rejected_at = null;
            }
            if (isset($data["ready_at"])) {
              $this->ready_at = $data["ready_at"];
            } else {
              $this->ready_at = null;
            }
            if (isset($data["expired_at"])) {
              $this->expired_at = $data["expired_at"];
            } else {
              $this->expired_at = null;
            }
            if (isset($data["picked_up_at"])) {
              $this->picked_up_at = $data["picked_up_at"];
            } else {
              $this->picked_up_at = null;
            }
            if (isset($data["canceled_at"])) {
              $this->canceled_at = $data["canceled_at"];
            } else {
              $this->canceled_at = null;
            }
            if (isset($data["cancel_reason"])) {
              $this->cancel_reason = $data["cancel_reason"];
            } else {
              $this->cancel_reason = null;
            }
        }
    }
    /**
     * Gets recipient
     * @return \SquareConnect\Model\OrderFulfillmentRecipient
     */
    public function getRecipient()
    {
        return $this->recipient;
    }
  
    /**
     * Sets recipient
     * @param \SquareConnect\Model\OrderFulfillmentRecipient $recipient The recipient of this pickup fulfillment.
     * @return $this
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }
    /**
     * Gets expires_at
     * @return string
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }
  
    /**
     * Sets expires_at
     * @param string $expires_at The expiry [timestamp](#workingwithdates) in RFC 3339 format, e.g., \"2016-09-04T23:59:33.123Z\". This timestamp indicates when the pickup fulfillment will expire if it is not accepted by the merchant. Expiration time can only be set up to 7 days in the future. If not set, this pickup fulfillment will be automatically accepted when placed.
     * @return $this
     */
    public function setExpiresAt($expires_at)
    {
        $this->expires_at = $expires_at;
        return $this;
    }
    /**
     * Gets auto_complete_duration
     * @return string
     */
    public function getAutoCompleteDuration()
    {
        return $this->auto_complete_duration;
    }
  
    /**
     * Sets auto_complete_duration
     * @param string $auto_complete_duration The auto completion duration in RFC3339 duration format, e.g., \"P1W3D\". If set, an open and accepted pickup fulfillment will automatically move to the `COMPLETED` state after this period of time. If not set, this pickup fulfillment will remain accepted until it is canceled or completed.
     * @return $this
     */
    public function setAutoCompleteDuration($auto_complete_duration)
    {
        $this->auto_complete_duration = $auto_complete_duration;
        return $this;
    }
    /**
     * Gets schedule_type
     * @return string
     */
    public function getScheduleType()
    {
        return $this->schedule_type;
    }
  
    /**
     * Sets schedule_type
     * @param string $schedule_type The schedule type of the pickup fulfillment. Defaults to `SCHEDULED`. See [OrderFulfillmentPickupDetailsScheduleType](#type-orderfulfillmentpickupdetailsscheduletype) for possible values
     * @return $this
     */
    public function setScheduleType($schedule_type)
    {
        $this->schedule_type = $schedule_type;
        return $this;
    }
    /**
     * Gets pickup_at
     * @return string
     */
    public function getPickupAt()
    {
        return $this->pickup_at;
    }
  
    /**
     * Sets pickup_at
     * @param string $pickup_at The pickup [timestamp](#workingwithdates) in RFC3339 timestamp format, e.g., \"2016-09-04T23:59:33.123Z\". For fulfillments with the schedule type `ASAP`, this is automatically set to the current time plus the expected duration to prepare the fulfillment. This represents the start of the pickup window.
     * @return $this
     */
    public function setPickupAt($pickup_at)
    {
        $this->pickup_at = $pickup_at;
        return $this;
    }
    /**
     * Gets pickup_window_duration
     * @return string
     */
    public function getPickupWindowDuration()
    {
        return $this->pickup_window_duration;
    }
  
    /**
     * Sets pickup_window_duration
     * @param string $pickup_window_duration The pickup window duration in RFC3339 duration format, e.g., \"P1W3D\". This duration represents the window of time for which the order should be picked up after the `pickup_at` time. Can be used as an informational guideline for merchants.
     * @return $this
     */
    public function setPickupWindowDuration($pickup_window_duration)
    {
        $this->pickup_window_duration = $pickup_window_duration;
        return $this;
    }
    /**
     * Gets prep_time_duration
     * @return string
     */
    public function getPrepTimeDuration()
    {
        return $this->prep_time_duration;
    }
  
    /**
     * Sets prep_time_duration
     * @param string $prep_time_duration The preparation time duration in RFC3339 duration format, e.g., \"P1W3D\". This duration indicates how long it takes the merchant to prepare this fulfillment.
     * @return $this
     */
    public function setPrepTimeDuration($prep_time_duration)
    {
        $this->prep_time_duration = $prep_time_duration;
        return $this;
    }
    /**
     * Gets note
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }
  
    /**
     * Sets note
     * @param string $note A general note about the pickup fulfillment.  Notes are useful for providing additional instructions and are displayed in Square apps.
     * @return $this
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }
    /**
     * Gets placed_at
     * @return string
     */
    public function getPlacedAt()
    {
        return $this->placed_at;
    }
  
    /**
     * Sets placed_at
     * @param string $placed_at The [timestamp](#workingwithdates) in RFC3339 timestamp format, e.g., \"2016-09-04T23:59:33.123Z\", indicating when the fulfillment was placed.
     * @return $this
     */
    public function setPlacedAt($placed_at)
    {
        $this->placed_at = $placed_at;
        return $this;
    }
    /**
     * Gets accepted_at
     * @return string
     */
    public function getAcceptedAt()
    {
        return $this->accepted_at;
    }
  
    /**
     * Sets accepted_at
     * @param string $accepted_at The [timestamp](#workingwithdates) in RFC3339 timestamp format, e.g., \"2016-09-04T23:59:33.123Z\", indicating when the fulfillment was accepted by the merchant.
     * @return $this
     */
    public function setAcceptedAt($accepted_at)
    {
        $this->accepted_at = $accepted_at;
        return $this;
    }
    /**
     * Gets rejected_at
     * @return string
     */
    public function getRejectedAt()
    {
        return $this->rejected_at;
    }
  
    /**
     * Sets rejected_at
     * @param string $rejected_at The [timestamp](#workingwithdates) in RFC3339 timestamp format, e.g., \"2016-09-04T23:59:33.123Z\", indicating when the fulfillment was rejected.
     * @return $this
     */
    public function setRejectedAt($rejected_at)
    {
        $this->rejected_at = $rejected_at;
        return $this;
    }
    /**
     * Gets ready_at
     * @return string
     */
    public function getReadyAt()
    {
        return $this->ready_at;
    }
  
    /**
     * Sets ready_at
     * @param string $ready_at The [timestamp](#workingwithdates) in RFC3339 timestamp format, e.g., \"2016-09-04T23:59:33.123Z\", indicating when the merchant set the fulfillment as ready for pickup.
     * @return $this
     */
    public function setReadyAt($ready_at)
    {
        $this->ready_at = $ready_at;
        return $this;
    }
    /**
     * Gets expired_at
     * @return string
     */
    public function getExpiredAt()
    {
        return $this->expired_at;
    }
  
    /**
     * Sets expired_at
     * @param string $expired_at The [timestamp](#workingwithdates) in RFC3339 timestamp format, e.g., \"2016-09-04T23:59:33.123Z\", indicating when the fulfillment expired.
     * @return $this
     */
    public function setExpiredAt($expired_at)
    {
        $this->expired_at = $expired_at;
        return $this;
    }
    /**
     * Gets picked_up_at
     * @return string
     */
    public function getPickedUpAt()
    {
        return $this->picked_up_at;
    }
  
    /**
     * Sets picked_up_at
     * @param string $picked_up_at The [timestamp](#workingwithdates) in RFC3339 timestamp format, e.g., \"2016-09-04T23:59:33.123Z\", indicating when the fulfillment was picked up by the recipient.
     * @return $this
     */
    public function setPickedUpAt($picked_up_at)
    {
        $this->picked_up_at = $picked_up_at;
        return $this;
    }
    /**
     * Gets canceled_at
     * @return string
     */
    public function getCanceledAt()
    {
        return $this->canceled_at;
    }
  
    /**
     * Sets canceled_at
     * @param string $canceled_at The [timestamp](#workingwithdates) in RFC3339 timestamp format, e.g., \"2016-09-04T23:59:33.123Z\", indicating when the fulfillment was canceled by the merchant or buyer.
     * @return $this
     */
    public function setCanceledAt($canceled_at)
    {
        $this->canceled_at = $canceled_at;
        return $this;
    }
    /**
     * Gets cancel_reason
     * @return string
     */
    public function getCancelReason()
    {
        return $this->cancel_reason;
    }
  
    /**
     * Sets cancel_reason
     * @param string $cancel_reason A description of why the pickup was canceled. Max length is 100 characters.
     * @return $this
     */
    public function setCancelReason($cancel_reason)
    {
        $this->cancel_reason = $cancel_reason;
        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset 
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }
  
    /**
     * Gets offset.
     * @param  integer $offset Offset 
     * @return mixed 
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }
  
    /**
     * Sets value based on offset.
     * @param  integer $offset Offset 
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }
  
    /**
     * Unsets offset.
     * @param  integer $offset Offset 
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
  
    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) {
            return json_encode(\SquareConnect\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        } else {
            return json_encode(\SquareConnect\ObjectSerializer::sanitizeForSerialization($this));
        }
    }
}
