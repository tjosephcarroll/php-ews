<?



/**
 *Updates the First Name of a contact
 	* @param string $exchangeId
 	* @param string $exchangeChangeKey
 	* @param string $newName
 **/
function updateFirstName($exchangeId,$exchangeChangeKey, $newName){
	if($newName==''){
		return removeRegularProperty($exchangeId,$exchangeChangeKey,'FirstName');
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

	// Update Firstname (simple property)
	$field = new EWSType_SetItemFieldType();
	$field->FieldURI->FieldURI = 'contacts:GivenName';
	$field->Contact = new EWSType_ContactItemType();
	$field->Contact->GivenName = $newName;

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
 *Updates the Middle Name of a contact
 	* @param string $exchangeId
 	* @param string $exchangeChangeKey
 	* @param string $newName
 **/
function updateMiddleName($exchangeId,$exchangeChangeKey, $newName){
	if($newName==''){
		return removeRegularProperty($exchangeId,$exchangeChangeKey,'MiddleName');
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

	// Update (simple property)
	$field = new EWSType_SetItemFieldType();
	$field->FieldURI->FieldURI = 'contacts:MiddleName';
	$field->Contact = new EWSType_ContactItemType();
	$field->Contact->MiddleName = $newName;

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
 *Updates the Last Name of a contact
 	* @param string $exchangeId
 	* @param string $exchangeChangeKey
 	* @param string $newName
 **/
function updateLastName($exchangeId,$exchangeChangeKey, $newName){
	if($newName==''){
		return removeRegularProperty($exchangeId,$exchangeChangeKey,'LastName');
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

	// Update (simple property)
	$field = new EWSType_SetItemFieldType();
	$field->FieldURI->FieldURI = 'contacts:Surname';
	$field->Contact = new EWSType_ContactItemType();
	$field->Contact->Surname = $newName;

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
 *Updates the Title of a contact
 	* @param string $exchangeId
 	* @param string $exchangeChangeKey
 	* @param string $newTitle
 **/
function updateTitle($exchangeId,$exchangeChangeKey,$newTitle){
	if ($newTitle=='') {
		return removeExtendedProperty($exchangeId,$exchangeChangeKey,'0x3A45');
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

	// Title (extended property)
	$contact = new EWSType_ItemType();

	// Build the extended property and set it on the item.
	$property = new EWSType_ExtendedPropertyType();
	$property->ExtendedFieldURI = new EWSType_PathToExtendedFieldType();
	$property->ExtendedFieldURI->PropertyTag = '0x3A45';
	$property->ExtendedFieldURI->PropertyType = EWSType_MapiPropertyTypeType::STRING;
	$property->Value = $newTitle;
	$contact->ExtendedProperty = $property;

	// Build the set item field object and set the item on it.
	$field = new EWSType_SetItemFieldType();
	$field->ExtendedFieldURI = new EWSType_PathToExtendedFieldType();
	$field->ExtendedFieldURI->PropertyTag = '0x3A45';
	$field->ExtendedFieldURI->PropertyType = EWSType_MapiPropertyTypeType::STRING;
	$field->Contact = $contact;

	$change->Updates->SetItemField[] = $field;

	// Set all changes
	$request->ItemChanges[0] = $change;

	// Send request
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
 *Updates the Suffix of a contact
 	* @param string $exchangeId
 	* @param string $exchangeChangeKey
 	* @param string $newSuffix
 **/
function updateSuffix($exchangeId,$exchangeChangeKey,$newSuffix){
	if ($newSuffix=='') {
		return removeRegularProperty($exchangeId,$exchangeChangeKey,'Suffix');
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

	// Update  (simple property)
	$field = new EWSType_SetItemFieldType();
	$field->FieldURI->FieldURI = 'contacts:Generation';
	$field->Contact = new EWSType_ContactItemType();
	$field->Contact->Generation= $newSuffix;

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
 *Updates the Initials of a contact
 	* @param string $exchangeId
 	* @param string $exchangeChangeKey
 	* @param string $newInitials
 **/
function updateInitials($exchangeId,$exchangeChangeKey,$newInitials){
	if ($newInitials=='') {
		return removeRegularProperty($exchangeId,$exchangeChangeKey,'Initials');
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

	// Update  (simple property)
	$field = new EWSType_SetItemFieldType();
	$field->FieldURI->FieldURI = 'contacts:Initials';
	$field->Contact = new EWSType_ContactItemType();
	$field->Contact->Initials= $newInitials;

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
 *Updates the FullName of a contact
 	* @param string $exchangeId
 	* @param string $exchangeChangeKey
 	* @param string $newName
 **/
function updateFullName($exchangeId,$exchangeChangeKey,$newName){
	if ($newName=='') {
		return removeRegularProperty($exchangeId,$exchangeChangeKey,'FullName');
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

	// Update  (simple property)
	$field = new EWSType_SetItemFieldType();
	$field->FieldURI->FieldURI = 'contacts:DisplayName';
	$field->Contact = new EWSType_ContactItemType();
	$field->Contact->DisplayName= $newName;

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
 *Updates the Nickname of a contact
 	* @param string $exchangeId
 	* @param string $exchangeChangeKey
 	* @param string $newNickName
 **/
function updateNickName($exchangeId,$exchangeChangeKey,$newNickName){
	if ($newNickName=='') {
		return removeRegularProperty($exchangeId,$exchangeChangeKey,'Nickname');
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

	// Update simple property)
	$field = new EWSType_SetItemFieldType();
	$field->FieldURI->FieldURI = 'contacts:Nickname';
	$field->Contact = new EWSType_ContactItemType();
	$field->Contact->Nickname= $newNickName;

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
 *Updates the Birthdday of a contact
 	* @param string $exchangeId
 	* @param string $exchangeChangeKey
 	* @param string $newBirthday
 **/
function updateBirthday($exchangeId,$exchangeChangeKey,$newBirthday){
	if ($newBirthday=='') {
		return removeRegularProperty($exchangeId,$exchangeChangeKey,'Birthday');
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

	// Update (simple property)
	$field = new EWSType_SetItemFieldType();
	$field->FieldURI->FieldURI = 'contacts:Birthday';
	$field->Contact = new EWSType_ContactItemType();
	$field->Contact->Birthday= $newBirthday.'T00:00:00z';

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
 *Updates the Gender of a contact
 	* @param string $exchangeId
 	* @param string $exchangeChangeKey
 	* @param string $newGender
 		*Male or Female
 **/
function updateGender($exchangeId,$exchangeChangeKey,$newGender){
	if ($newGender=='') {
		return removeExtendedProperty($exchangeId,$exchangeChangeKey,'0x3A4D');
	}

	if ($newGender=='Female') {
		$newGender=1;
	}elseif ($newGender=='Male') {
		$newGender=2;
	}else{
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

	// Gender (extended property)
	$contact = new EWSType_ItemType();

	// Build the extended property and set it on the item.
	$property = new EWSType_ExtendedPropertyType();
	$property->ExtendedFieldURI = new EWSType_PathToExtendedFieldType();
	$property->ExtendedFieldURI->PropertyTag = '0x3A4D';
	$property->ExtendedFieldURI->PropertyType = EWSType_MapiPropertyTypeType::SHORT;
	$property->Value = $newGender;
	$contact->ExtendedProperty = $property;

	// Build the set item field object and set the item on it.
	$field = new EWSType_SetItemFieldType();
	$field->ExtendedFieldURI = new EWSType_PathToExtendedFieldType();
	$field->ExtendedFieldURI->PropertyTag = '0x3A4D';
	$field->ExtendedFieldURI->PropertyType = EWSType_MapiPropertyTypeType::SHORT;
	$field->Contact = $contact;

	$change->Updates->SetItemField[] = $field;

	// Set all changes
	$request->ItemChanges[0] = $change;

	// Send request
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
 *Updates the email of a contact
 	* @param string $exchangeId
 	* @param string $exchangeChangeKey
 	* @param integer $emailNumber (1-3)
 	* @param string $newEmail 
 **/
function updateEmail($exchangeId, $exchangeChangeKey, $emailNumber, $newEmail){

	//Simple sanitize
	if(($newEmail=='')&&($emailNumber<=3)){
		$emailType = 'Email'.$emailNumber;
		return removeIndexedProperty($exchangeId,$exchangeChangeKey,$emailType);
	}elseif($emailNumber>3){
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

	// Update Email (indexed property).
	$field = new EWSType_SetItemFieldType();
	$field->IndexedFieldURI->FieldURI = 'contacts:EmailAddress';
	$field->Contact = new EWSType_ContactItemType();
	$field->Contact->EmailAddresses = new EWSType_EmailAddressDictionaryType();

	$entry = new EWSType_EmailAddressDictionaryEntryType();
	$entry->_ = $newEmail;

	if ($emailNumber==1) {
		$entry->Key = EWSType_EmailAddressKeyType::EMAIL_ADDRESS_1;
		$field->IndexedFieldURI->FieldIndex = EWSType_EmailAddressKeyType::EMAIL_ADDRESS_1;
	}elseif ($emailNumber==2) {
		$entry->Key = EWSType_EmailAddressKeyType::EMAIL_ADDRESS_2;
		$field->IndexedFieldURI->FieldIndex = EWSType_EmailAddressKeyType::EMAIL_ADDRESS_2;
	}elseif ($emailNumber==3) {
		$entry->Key = EWSType_EmailAddressKeyType::EMAIL_ADDRESS_3;
		$field->IndexedFieldURI->FieldIndex = EWSType_EmailAddressKeyType::EMAIL_ADDRESS_3;
	}
		
	
	$field->Contact->EmailAddresses->Entry[0] = $entry;

	$change->Updates->SetItemField[0] = $field;

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
 *Updates the phone number of a contact
 	* @param string $exchangeId
 	* @param string $exchangeChangeKey
 	* @param string $phoneType 
 		*AssistantPhone, BusinessFax, BusinessPhone, BusinessPhone2, Callback, 
 		*CarPhone, CompanyMainPhone, HomeFax, HomePhone, HomePhone2, ISDN, 
 		*MobilePhone, OtherFax, OtherTelephone, Pager, PrimaryPhone, RadioPhone, 
 		*Telex, TtyTtdPhone
 	* @param string $newPhone
**/
function updatePhone($exchangeId, $exchangeChangeKey, $phoneType, $newPhone){
	
	//Simple sanitize
	if($newPhone==''){
		return removeIndexedProperty($exchangeId,$exchangeChangeKey,$phoneType);
	} elseif ($phoneType=='AssistantPhone') {
	} elseif ($phoneType=='BusinessFax') {
	} elseif ($phoneType=='BusinessPhone'){
	} elseif ($phoneType=='BusinessPhone2'){
	} elseif ($phoneType=='Callback') {
	} elseif ($phoneType=='CarPhone') {
	} elseif ($phoneType=='CompanyMainPhone') {
	} elseif ($phoneType=='HomeFax') {
	} elseif ($phoneType=='HomePhone') {
	} elseif ($phoneType=='HomePhone2') {
	} elseif ($phoneType=='ISDN') {
	} elseif ($phoneType=='MobilePhone') {
	} elseif ($phoneType=='OtherFax') {
	} elseif ($phoneType=='OtherTelephone') {
	} elseif ($phoneType=='Pager') {
	} elseif ($phoneType=='PrimaryPhone') {
	} elseif ($phoneType=='RadioPhone') {
	} elseif ($phoneType=='Telex') {
	} elseif ($phoneType=='TtyTtdPhone') {
	} else{
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

	// Update PhoneNumber (indexed property).
	$field = new EWSType_SetItemFieldType();
	$field->IndexedFieldURI->FieldURI = 'contacts:PhoneNumber';
	$field->Contact = new EWSType_ContactItemType();
	$field->Contact->PhoneNumbers = new EWSType_PhoneNumberDictionaryType();

	$entry = new EWSType_PhoneNumberDictionaryEntryType();
	$entry->_ = $newPhone;

	
	if ($phoneType=='AssistantPhone') {
		$entry->Key = EWSType_PhoneNumberKeyType::ASSISTANT_PHONE;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::ASSISTANT_PHONE;
	}elseif ($phoneType=='BusinessFax') {
		$entry->Key = EWSType_PhoneNumberKeyType::BUSINESS_FAX;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::BUSINESS_FAX;
	}elseif ($phoneType=='BusinessPhone'){
		$entry->Key = EWSType_PhoneNumberKeyType::BUSINESS_PHONE;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::BUSINESS_PHONE;
	}elseif ($phoneType=='BusinessPhone2'){
		$entry->Key = EWSType_PhoneNumberKeyType::BUSINESS_PHONE_2;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::BUSINESS_PHONE_2;
	}elseif ($phoneType=='Callback') {
		$entry->Key = EWSType_PhoneNumberKeyType::CALLBACK;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::CALLBACK;
	}elseif ($phoneType=='CarPhone') {
		$entry->Key = EWSType_PhoneNumberKeyType::CAR_PHONE;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::CAR_PHONE;
	}elseif ($phoneType=='CompanyMainPhone') {
		$entry->Key = EWSType_PhoneNumberKeyType::COMPANY_MAIN_PHONE;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::COMPANY_MAIN_PHONE;
	}elseif ($phoneType=='HomeFax') {
		$entry->Key = EWSType_PhoneNumberKeyType::HOME_FAX;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::HOME_FAX;
	}elseif ($phoneType=='HomePhone') {
		$entry->Key = EWSType_PhoneNumberKeyType::HOME_PHONE;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::HOME_PHONE;
	}elseif ($phoneType=='HomePhone2') {
		$entry->Key = EWSType_PhoneNumberKeyType::HOME_PHONE_2;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::HOME_PHONE_2;
	}elseif ($phoneType=='ISDN') {
		$entry->Key = EWSType_PhoneNumberKeyType::ISDN;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::ISDN;
	}elseif ($phoneType=='MobilePhone') {
		$entry->Key = EWSType_PhoneNumberKeyType::MOBILE_PHONE;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::MOBILE_PHONE;
	}elseif ($phoneType=='OtherFax') {
		$entry->Key = EWSType_PhoneNumberKeyType::OTHER_FAX;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::OTHER_FAX;
	}elseif ($phoneType=='OtherTelephone') {
		$entry->Key = EWSType_PhoneNumberKeyType::OTHER_PHONE;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::OTHER_PHONE;
	}elseif ($phoneType=='Pager') {
		$entry->Key = EWSType_PhoneNumberKeyType::PAGER;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::PAGER;
	}elseif ($phoneType=='PrimaryPhone') {
		$entry->Key = EWSType_PhoneNumberKeyType::PRIMARY_PHONE;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::PRIMARY_PHONE;
	}elseif ($phoneType=='RadioPhone') {
		$entry->Key = EWSType_PhoneNumberKeyType::RADIO_PHONE;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::RADIO_PHONE;
	}elseif ($phoneType=='Telex') {
		$entry->Key = EWSType_PhoneNumberKeyType::TELEX;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::TELEX;
	}elseif ($phoneType=='TtyTtdPhone') {
		$entry->Key = EWSType_PhoneNumberKeyType::TTY_TTD_PHONE;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhoneNumberKeyType::TTY_TTD_PHONE;
	}

	$field->Contact->PhoneNumbers->Entry[0] = $entry;

	$change->Updates->SetItemField[0] = $field;

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
 *Updates the Address of a contact
 	* @param string $exchangeId
 	* @param string $exchangeChangeKey
 	* @param string $addressType
 		*Business, Home, or Other
 	* @param string $newStreet
 		* "123 Fake Street, Apartment 4"
 		* "567 Not Real Avenue"
 	* @param string $newCity
 	* @param string $newState
 	* @param string $newZip
**/
function updateAddress($exchangeId, $exchangeChangeKey, $addressType, $newStreet, $newCity, $newState, $newZip){
	
	//Simple sanitize
	if($addressType=='Business') {}
	elseif ($addressType=='Home') {}
	elseif ($addressType=='Other') {}
	else{
		return false;
	}

	$flag = false;
	if ($newStreet=='') {
		$flag = removeAddressProperty($exchangeId,$exchangeChangeKey,$addressType,$newStreet);
		if($flag==false){
			return false;
		}
	}
	if ($newCity=='') {
		$flag = removeAddressProperty($exchangeId,$exchangeChangeKey,$addressType,$newCity);
		if($flag==false){
			return false;
		}	
	}
	if ($newState=='') {
		$flag = removeAddressProperty($exchangeId,$exchangeChangeKey,$addressType,$newState);
		if($flag==false){
			return false;
		}	
	}
	if ($newZip=='') {
		$flag = removeAddressProperty($exchangeId,$exchangeChangeKey,$addressType,$newZip);
		if($flag==false){
			return false;
		}	
	}
	if($flag){
		return $flag;
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

	// Update Street(indexed property).
	$field = new EWSType_SetItemFieldType();
	$field->IndexedFieldURI->FieldURI = 'contacts:PhysicalAddress:Street';


	$field->Contact = new EWSType_ContactItemType();
	$field->Contact->PhysicalAddresses= new EWSType_PhysicalAddressDictionaryType();

	$entry = new EWSType_PhysicalAddressDictionaryEntryType();
	

	if ($addressType=='Business') {
		$entry->Key = EWSType_PhysicalAddressKeyType::BUSINESS;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhysicalAddressKeyType::BUSINESS;
	}elseif ($addressType=='Home') {
		$entry->Key = EWSType_PhysicalAddressKeyType::HOME;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhysicalAddressKeyType::HOME;
	}elseif ($addressType=='Other') {
		$entry->Key = EWSType_PhysicalAddressKeyType::OTHER;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhysicalAddressKeyType::OTHER;
	}

	$field->Contact->PhysicalAddresses->Entry[0] = $entry;
	$field->Contact->PhysicalAddresses->Entry[0]->Street = $newStreet; 

	$change->Updates->SetItemField[0] = $field;

	$request->ItemChanges[0] = $change;


	$response = $ews->UpdateItem($request);

	$statuscode = $response->ResponseMessages->UpdateItemResponseMessage->ResponseCode;

	if ($statuscode=='NoError'){
	}else{
		unset($ews);
		return false;
	}

	// Update City(indexed property).
	$field = new EWSType_SetItemFieldType();
	$field->IndexedFieldURI->FieldURI = 'contacts:PhysicalAddress:City';


	$field->Contact = new EWSType_ContactItemType();
	$field->Contact->PhysicalAddresses= new EWSType_PhysicalAddressDictionaryType();

	$entry = new EWSType_PhysicalAddressDictionaryEntryType();
	

	if ($addressType=='Business') {
		$entry->Key = EWSType_PhysicalAddressKeyType::BUSINESS;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhysicalAddressKeyType::BUSINESS;
	}elseif ($addressType=='Home') {
		$entry->Key = EWSType_PhysicalAddressKeyType::HOME;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhysicalAddressKeyType::HOME;
	}elseif ($addressType=='Other') {
		$entry->Key = EWSType_PhysicalAddressKeyType::OTHER;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhysicalAddressKeyType::OTHER;
	}

	$field->Contact->PhysicalAddresses->Entry[0] = $entry;
	$field->Contact->PhysicalAddresses->Entry[0]->City= $newCity; 

	$change->Updates->SetItemField[0] = $field;

	$request->ItemChanges[0] = $change;


	$response = $ews->UpdateItem($request);

	$statuscode = $response->ResponseMessages->UpdateItemResponseMessage->ResponseCode;

	if ($statuscode=='NoError'){
	}else{
		unset($ews);
		return false;
	}

	// Update State(indexed property).
	$field = new EWSType_SetItemFieldType();
	$field->IndexedFieldURI->FieldURI = 'contacts:PhysicalAddress:State';


	$field->Contact = new EWSType_ContactItemType();
	$field->Contact->PhysicalAddresses= new EWSType_PhysicalAddressDictionaryType();

	$entry = new EWSType_PhysicalAddressDictionaryEntryType();
	

	if ($addressType=='Business') {
		$entry->Key = EWSType_PhysicalAddressKeyType::BUSINESS;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhysicalAddressKeyType::BUSINESS;
	}elseif ($addressType=='Home') {
		$entry->Key = EWSType_PhysicalAddressKeyType::HOME;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhysicalAddressKeyType::HOME;
	}elseif ($addressType=='Other') {
		$entry->Key = EWSType_PhysicalAddressKeyType::OTHER;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhysicalAddressKeyType::OTHER;
	}

	$field->Contact->PhysicalAddresses->Entry[0] = $entry;
	$field->Contact->PhysicalAddresses->Entry[0]->State= $newState; 

	$change->Updates->SetItemField[0] = $field;

	$request->ItemChanges[0] = $change;


	$response = $ews->UpdateItem($request);

	$statuscode = $response->ResponseMessages->UpdateItemResponseMessage->ResponseCode;

	if ($statuscode=='NoError'){
		
	}else{
		unset($ews);
		return false;
	}

	// Update State(indexed property).
	$field = new EWSType_SetItemFieldType();
	$field->IndexedFieldURI->FieldURI = 'contacts:PhysicalAddress:PostalCode';


	$field->Contact = new EWSType_ContactItemType();
	$field->Contact->PhysicalAddresses= new EWSType_PhysicalAddressDictionaryType();

	$entry = new EWSType_PhysicalAddressDictionaryEntryType();
	

	if ($addressType=='Business') {
		$entry->Key = EWSType_PhysicalAddressKeyType::BUSINESS;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhysicalAddressKeyType::BUSINESS;
	}elseif ($addressType=='Home') {
		$entry->Key = EWSType_PhysicalAddressKeyType::HOME;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhysicalAddressKeyType::HOME;
	}elseif ($addressType=='Other') {
		$entry->Key = EWSType_PhysicalAddressKeyType::OTHER;
		$field->IndexedFieldURI->FieldIndex = EWSType_PhysicalAddressKeyType::OTHER;
	}

	$field->Contact->PhysicalAddresses->Entry[0] = $entry;
	$field->Contact->PhysicalAddresses->Entry[0]->PostalCode= $newZip; 

	$change->Updates->SetItemField[0] = $field;

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
 *Updates the Category of a Contact
 * @param string $exchangeId
 * @param string $exchangeChangeKey
 * @param string $newCategory
	*All Offices, ISC
	*Attorneys & Real Estate Agents
	*Auto
	*Beauty/ Skin/ Nail Care
	*Business
	*Catering
	*Charitable Organizations
	*Children's Retail & Toys
	*Dentists
	*Doctors/ Physical Therapists/ Pharmacies
	*Dry Cleaner/ Luggage/ Shoe Repair
	*Educational Institutions
	*Entertainment
	*Friends & Family
	*Financial Institutions
	*Florists
	*Follen
	*Gloucester
	*Hotel/Travel
	*Housekeeping
	*ISC
	*Jewelry
	*Liquor Stores
	*Mailing Labels
	*Medical
	*Online Accounts
	*Personal Services
	*Photographers
	*Political
	*Property Maintenance
	*Ragon Institute Contact List
	*Religious Affiliations/Cemeteries/Funeral Homes
	*Restaurants/Dining & Specialty Foods
	*Retail
	*Sports Organizations/Venues
	*Subscriptions
	*Transportation/Delivery
**/
function updateCategory($exchangeId, $exchangeChangeKey, $newCategory){
	
	if($newCategory=='All Offices, ISC'){}
	elseif($newCategory=='Attorneys & Real Estate Agents'){}
	elseif($newCategory=='Auto'){}
	elseif($newCategory=='Beauty/ Skin/ Nail Care'){}
	elseif($newCategory=='Business'){}
	elseif($newCategory=='Catering'){}
	elseif($newCategory=='Charitable Organizations'){}
	elseif($newCategory=="Children's Retail & Toys"){}
	elseif($newCategory=='Dentists'){}
	elseif($newCategory=='Doctors/ Physical Therapists/ Pharmacies'){}
	elseif($newCategory=='Dry Cleaner/ Luggage/ Shoe Repair'){}
	elseif($newCategory=='Educational Institutions'){}
	elseif($newCategory=='Entertainment'){}
	elseif($newCategory=='Friends & Family'){}
	elseif($newCategory=='Financial Institutions'){}
	elseif($newCategory=='Florists'){}
	elseif($newCategory=='Follen'){}
	elseif($newCategory=='Gloucester'){}
	elseif($newCategory=='Hotel/Travel'){}
	elseif($newCategory=='Housekeeping'){}
	elseif($newCategory=='ISC'){}
	elseif($newCategory=='Jewelry'){}
	elseif($newCategory=='Liquor Stores'){}
	elseif($newCategory=='Mailing Labels'){}
	elseif($newCategory=='Medical'){}
	elseif($newCategory=='Online Accounts'){}
	elseif($newCategory=='Personal Services'){}
	elseif($newCategory=='Photographers'){}
	elseif($newCategory=='Political'){}
	elseif($newCategory=='Property Maintenance'){}
	elseif($newCategory=='Ragon Institute Contact List'){}
	elseif($newCategory=='Religious Affiliations/Cemeteries/Funeral Homes'){}
	elseif($newCategory=='Restaurants/Dining & Specialty Foods'){}
	elseif($newCategory=='Retail'){}
	elseif($newCategory=='Sports Organizations/Venues'){}
	elseif($newCategory=='Subscriptions'){}
	elseif($newCategory=='Transportation/Delivery'){}
	else{
		return removeRegularProperty($exchangeId,$exchangeChangeKey,'Category');
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

	// Update (simple property)
	$field = new EWSType_SetItemFieldType();
	$field->FieldURI->FieldURI = 'item:Categories';
	$field->Contact = new EWSType_ContactItemType();
	$field->Contact->Categories = new EWSType_ArrayOfStringsType();
	$field->Contact->Categories->String = $newCategory;

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