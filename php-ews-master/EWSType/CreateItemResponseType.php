<?php
/**
 * Contains EWSType_CreateItemResponseType.
 */

/**
 * Defines a response to a CreateItem request.
 *
 * @package php-ews\Types
 *
 * @todo Extend EWSType_BaseResponseMessageType.
 */
class EWSType_CreateItemResponseType extends EWSType
{
    /**
     * Contains the response messages for an Exchange Web Services request.
     *
     * @since Exchange 2007
     *
     * @var EWSType_ArrayOfResponseMessagesType
     */
    public $ResponseMessages;
}
