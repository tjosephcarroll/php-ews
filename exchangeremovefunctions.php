<?php

/**
 *Removes a regular property from an outlook contact
 *
 *@param string $exchangeId
 *@param string $exchangeChangeKey
 *@param string $property
 	*FirstName
 	*LastName
 	*MiddleName
 	*Suffix
 	*Initials
 	*FullName
 	*Nickname
 	*Birthday
 	*Category
**/
function removeRegularProperty($exchangeId,$exchangeChangeKey,$property){
	
	if($property=='FirstName'){
		// Update Firstname (simple property)
		$field = new EWSType_SetItemFieldType();
		$field->FieldURI->FieldURI = 'contacts:GivenName';
		$field->Contact = new EWSType_ContactItemType();
		$field->Contact->GivenName = '';
	}
 	elseif($property=='LastName'){
 		// Update Last Name(simple property)
		$field = new EWSType_SetItemFieldType();
		$field->FieldURI->FieldURI = 'contacts:Surname';
		$field->Contact = new EWSType_ContactItemType();
		$field->Contact->Surname = $newName;
 	}
 	elseif($property=='MiddleName'){
 		// Update Middle name(simple property)
		$field = new EWSType_SetItemFieldType();
		$field->FieldURI->FieldURI = 'contacts:MiddleName';
		$field->Contact = new EWSType_ContactItemType();
		$field->Contact->MiddleName = '';
 	}
 	elseif($property=='Suffix'){
 		// Update Suffix (simple property)
		$field = new EWSType_SetItemFieldType();
		$field->FieldURI->FieldURI = 'contacts:Generation';
		$field->Contact = new EWSType_ContactItemType();
		$field->Contact->Generation= '';
 	}
 	elseif($property=='Initials'){
 		// Update fullname (simple property)
		$field = new EWSType_SetItemFieldType();
		$field->FieldURI->FieldURI = 'contacts:Initials';
		$field->Contact = new EWSType_ContactItemType();
		$field->Contact->Initials= '';
 	}
 	elseif($property=='FullName'){
 		// Update initials (simple property)
		$field = new EWSType_SetItemFieldType();
		$field->FieldURI->FieldURI = 'contacts:DisplayName';
		$field->Contact = new EWSType_ContactItemType();
		$field->Contact->DisplayName= '';
 	}
 	elseif($property=='Nickname'){
 		// Update nickname (simple property)
		$field = new EWSType_SetItemFieldType();
		$field->FieldURI->FieldURI = 'contacts:Nickname';
		$field->Contact = new EWSType_ContactItemType();
		$field->Contact->Nickname= '';
 	}
 	elseif($property=='Birthday'){
	 	// Update birthday (simple property)
		$field = new EWSType_SetItemFieldType();
		$field->FieldURI->FieldURI = 'contacts:Birthday';
		$field->Contact = new EWSType_ContactItemType();
		$field->Contact->Birthday= '0000-00-00T00:00:00z';
 	}
 	elseif($property=='Category'){
	 	// Update (simple property)
		$field = new EWSType_SetItemFieldType();
		$field->FieldURI->FieldURI = 'item:Categories';
		$field->Contact = new EWSType_ContactItemType();
		$field->Contact->Categories = new EWSType_ArrayOfStringsType();
		$field->Contact->Categories->String = '';
 	}
 	else{
 		return false;
 	}

	//new web service
	$ews = newWebService();

	//create a request
	$request = new EWSType_UpdateItemType();

	$request->SendMeetingInvitationsOrCancellations = 'SendToNone';
	$request->MessageDisposition = 'SaveOnly';
	$request->ConflictResolution = 'AlwaysOverwrite';
	$request->ItemChanges = array();

	// Build out item change request.
	$change = new EWSType_ItemChangeType();
	$change->ItemId = new EWSType_ItemIdType();
	$change->ItemId->Id = $exchangeId;
	$change->ItemId->ChangeKey = $exchangeChangeKey;
	$change->Updates = new EWSType_NonEmptyArrayOfItemChangeDescriptionsType();
	$change->Updates->SetItemField = array(); // Array of fields to be update
	$change->Updates->DeleteItemField = array(); // Array of fields to be removed



	$change->Updates->SetItemField[] = $field;

	$request->ItemChanges[0] = $change;

	$response = $ews->UpdateItem($request);

	$statuscode = $response->ResponseMessages->UpdateItemResponseMessage->ResponseCode;
	if ($statuscode=='NoError'){
		unset($ews);
		return true;
	}else{
		unset($ews);
		return false;
	}
}

/**
 *Removes an indexed property from an outlook contact
 *Handles all indexed properties except addresses 
 *
 *@param string $exchangeId
 *@param string $exchangeChangeKey
 *@param string $property
 	*Email1
 	*Email2
 	*Email3
 	*AssistantPhone 
 	*BusinessFax
 	*BusinessPhone
 	*BusinessPhone2
 	*Callback
 	*CarPhone
 	*CompanyMainPhone
 	*HomeFax
 	*HomePhone
 	*HomePhone2
 	*ISDN
 	*MobilePhone
 	*OtherFax
 	*OtherTelephone
 	*Pager
 	*PrimaryPhone
 	*RadioPhone
 	*Telex
 	*TtyTtdPhone
**/
function removeIndexedProperty($exchangeId,$exchangeChangeKey,$property){
	

	if($property=='Email1'){
		$fieldURI = 'contacts:EmailAddress';
		$fieldIndex = EWSType_EmailAddressKeyType::EMAIL_ADDRESS_1;
	}
 	elseif($property=='Email2'){
 		$fieldURI = 'contacts:EmailAddress';
 		$fieldIndex = EWSType_EmailAddressKeyType::EMAIL_ADDRESS_2;
 	}
 	elseif($property=='Email3'){
 		$fieldURI = 'contacts:EmailAddress';
 		$fieldIndex = EWSType_EmailAddressKeyType::EMAIL_ADDRESS_3;
 	}
 	elseif($property=='AssistantPhone'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::ASSISTANT_PHONE;
 	}
 	elseif($property=='BusinessFax'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::BUSINESS_FAX;
 	}
 	elseif($property=='BusinessPhone'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::BUSINESS_PHONE;
 	}
 	elseif($property=='BusinessPhone2'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::BUSINESS_PHONE_2;
 	}
 	elseif($property=='Callback'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::CALLBACK;
 	}
 	elseif($property=='CarPhone'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::CAR_PHONE;
 	}
 	elseif($property=='CompanyMainPhone'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::COMPANY_MAIN_PHONE;
 	}
 	elseif($property=='HomeFax'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::HOME_FAX;
 	}
 	elseif($property=='HomePhone'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::HOME_PHONE;
 	}
 	elseif($property=='HomePhone2'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::HOME_PHONE_2;
 	}
 	elseif($property=='ISDN'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::PHONE_NUMBER;
 	}
 	elseif($property=='MobilePhone'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::MOBILE_PHONE;
 	}
 	elseif($property=='OtherFax'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::OTHER_FAX;
 	}
 	elseif($property=='OtherTelephone'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::OTHER_TELEPHONE;
 	}
 	elseif($property=='Pager'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::PAGER;
 	}
 	elseif($property=='PrimaryPhone'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::PRIMARY_PHONE;
 	}
 	elseif($property=='RadioPhone'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::RADIO_PHONE;
 	}
 	elseif($property=='Telex'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::TELEX;
 	}
 	elseif($property=='TtyTtdPhone'){
 		$fieldURI = 'contacts:PhoneNumber';
 		$fieldIndex = EWSType_PhoneNumberKeyType::TTY_TTD_PHONE;
 	}
 	else{
 		return false;
 	}

	//new web service
	$ews = newWebService();

	//create a request
	$request = new EWSType_UpdateItemType();

	$request->SendMeetingInvitationsOrCancellations = 'SendToNone';
	$request->MessageDisposition = 'SaveOnly';
	$request->ConflictResolution = 'AlwaysOverwrite';
	$request->ItemChanges = array();

	// Build out item change request.
	$change = new EWSType_ItemChangeType();
	$change->ItemId = new EWSType_ItemIdType();
	$change->ItemId->Id = $exchangeId;
	$change->ItemId->ChangeKey = $exchangeChangeKey;
	$change->Updates = new EWSType_NonEmptyArrayOfItemChangeDescriptionsType();
	$change->Updates->SetItemField = array(); // Array of fields to be update
	$change->Updates->DeleteItemField = array(); // Array of fields to be removed

	$field = new stdClass();
	$field->IndexedFieldURI->FieldURI = $fieldURI;
	$field->IndexedFieldURI->FieldIndex = $fieldIndex;

	$change->Updates->DeleteItemField[] = $field;

	$request->ItemChanges[0] = $change;

	$response = $ews->UpdateItem($request);

	$statuscode = $response->ResponseMessages->UpdateItemResponseMessage->ResponseCode;
	if ($statuscode=='NoError'){
		unset($ews);
		return true;
	}else{
		unset($ews);
		return false;
	}	
	
}

/**
 *Removes an indexed property from an outlook contact
 *Handles all indexed properties except addresses 
 *
 *@param string $exchangeId
 *@param string $exchangeChangeKey
 *@param string $addressType
 	*Home
 	*Business
 	*Other
 *@param string $fieldName
 	*Street
 	*City
 	*State
 	*Zip
**/
function removeAddressProperty($exchangeId,$exchangeChangeKey,$addressType,$fieldName){
	if($addressType=='Home'){
		$fieldIndex = EWSTYPE_PhysicalAddressKeyType::HOME;
	}
 	elseif($addressType=='Business'){
 		$fieldIndex = EWSTYPE_PhysicalAddressKeyType::BUSINESS;
 	}
 	elseif($addressType=='Other'){
 		$fieldIndex = EWSTYPE_PhysicalAddressKeyType::OTHER;
 	}
 	else{
 		return false;
 	}
 	
 	if($fieldName=='Street'){
 		$fieldURI = 'contacts:PhysicalAddress:Street';
 	}
 	elseif($fieldName=='City'){
 		$fieldURI = 'contacts:PhysicalAddress:City';
 	}
 	elseif($fieldName=='State'){
 		$fieldURI = 'contacts:PhysicalAddress:State';
 	}
 	elseif($fieldName=='Zip'){
 		$fieldURI = 'contacts:PhysicalAddress:PostalCode';
 	}
 	else{
 		return false;
 	}

 	//new web service
	$ews = newWebService();

	//create a request
	$request = new EWSType_UpdateItemType();

	$request->SendMeetingInvitationsOrCancellations = 'SendToNone';
	$request->MessageDisposition = 'SaveOnly';
	$request->ConflictResolution = 'AlwaysOverwrite';
	$request->ItemChanges = array();

	// Build out item change request.
	$change = new EWSType_ItemChangeType();
	$change->ItemId = new EWSType_ItemIdType();
	$change->ItemId->Id = $exchangeId;
	$change->ItemId->ChangeKey = $exchangeChangeKey;
	$change->Updates = new EWSType_NonEmptyArrayOfItemChangeDescriptionsType();
	$change->Updates->SetItemField = array(); // Array of fields to be update
	$change->Updates->DeleteItemField = array(); // Array of fields to be removed

	$field = new stdClass();
	$field->IndexedFieldURI->FieldURI = $fieldURI;
	$field->IndexedFieldURI->FieldIndex = $fieldIndex;

	$change->Updates->DeleteItemField[] = $field;

	$request->ItemChanges[0] = $change;

	$response = $ews->UpdateItem($request);

	$statuscode = $response->ResponseMessages->UpdateItemResponseMessage->ResponseCode;
	if ($statuscode=='NoError'){
		unset($ews);
		return true;
	}else{
		unset($ews);
		return false;
	}	
}

/**
 *Removes a extended property from an outlook contact
 *
 *
 *@param string $exchangeId
 *@param string $exchangeChangeKey
 *@param string $propertyHex
 	*0x3A45(Title)
 	*0x3A4D(Gender)
**/
function removeExtendedProperty($exchangeId,$exchangeChangeKey,$propertyHex){
	
	if ($propertyHex=='0x3A45') {//Title
		$propertyTag = $propertyHex;
	}
	elseif ($propertyHex=='0x3A4D') {//Gender
		$propertyTag = $propertyHex;
	}
	else{
		return false;
	}

	//create a request
	$request = new EWSType_UpdateItemType();

	$request->SendMeetingInvitationsOrCancellations = 'SendToNone';
	$request->MessageDisposition = 'SaveOnly';
	$request->ConflictResolution = 'AlwaysOverwrite';
	$request->ItemChanges = array();

	// Build out item change request.
	$change = new EWSType_ItemChangeType();
	$change->ItemId = new EWSType_ItemIdType();
	$change->ItemId->Id = $exchangeId;
	$change->ItemId->ChangeKey = $exchangeChangeKey;
	$change->Updates = new EWSType_NonEmptyArrayOfItemChangeDescriptionsType();
	$change->Updates->SetItemField = array(); // Array of fields to be update
	$change->Updates->DeleteItemField = array(); // Array of fields to be removed
	$contact = new EWSType_ItemType();

	// Build the extended property and set it on the item.
	$property = new EWSType_ExtendedPropertyType();
	$property->ExtendedFieldURI = new EWSType_PathToExtendedFieldType();
	$property->ExtendedFieldURI->PropertyTag = $propertyTag;
	$property->ExtendedFieldURI->PropertyType = EWSType_MapiPropertyTypeType::STRING;
	$property->Value = '';
	$contact->ExtendedProperty = $property;

	// Build the set item field object and set the item on it.
	$field = new EWSType_SetItemFieldType();
	$field->ExtendedFieldURI = new EWSType_PathToExtendedFieldType();
	$field->ExtendedFieldURI->PropertyTag = $propertyTag;
	$field->ExtendedFieldURI->PropertyType = EWSType_MapiPropertyTypeType::STRING;
	$field->Contact = $contact;

	$change->Updates->SetItemField[] = $field;

	$request->ItemChanges[0] = $change;

	$response = $ews->UpdateItem($request);

	$statuscode = $response->ResponseMessages->UpdateItemResponseMessage->ResponseCode;
	if ($statuscode=='NoError'){
		unset($ews);
		return true;
	}else{
		unset($ews);
		return false;
	}	
}
?>