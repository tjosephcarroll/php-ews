<?php
/**
 * Contains EWSType_MailTipsResponseMessageType.
 */

/**
 * Represents mail tips settings.
 *
 * @package php-ews\Types
 *
 * @todo Extend EWSType_ResponseMessageType.
 */
class EWSType_MailTipsResponseMessageType extends EWSType
{
    /**
     * Currently unused and reserved for future use.
     *
     * This element contains a value of 0.
     *
     * @since Exchange 2010
     *
     * @var integer
     */
    public $DescriptiveLinkKey;

    /**
     * Represents values for various types of mail tips.
     *
     * @since Exchange 2010
     *
     * @var EWSType_MailTips
     */
    public $MailTips;

    /**
     * Provides a text description of the status of the response.
     *
     * @since Exchange 2010
     *
     * @var string
     */
    public $MessageText;

    /**
     * Provides additional error response information.
     *
     * @since Exchange 2010
     *
     * @var string
     *
     * @todo Determine if we can use SimpleXML or DOMDocument here.
     */
    public $MessageXml;

    /**
     * Describes the status of the response.
     *
     * @since Exchange 2010
     *
     * @var EWSType_ResponseClassType
     */
    public $ResponseClass;

    /**
     * Provides an error code that identifies the specific error that the
     * request encountered.
     *
     * @since Exchange 2010
     *
     * @var EWSType_ResponseCodeType
     */
    public $ResponseCode;
}
