<?php

/**
*Find a person's exchange Id adn ChangeKey based on FirstName, LastName, Suffix
	* @return array $exchangeContact
 		*$exchangeContact['Id'] = string 
		*$exchangeContact['ChangeKey'] = string
		*$exchangeContact['Error'] = string (empty if no error)
	*@param string $firstName
	*@param string $lastName
	*@param string $suffix
**/ /**/
function searchByName($firstName,$lastName,$suffix){
	//$exchangeContact = ['Id' => '', 'ChangeKey' => '', 'Error' =>''];

	//New web service
	$ews = newWebService();

	//Request
	$request->ItemShape = new EWSType_ItemResponseShapeType();
	$request->ItemShape->BaseShape = EWSType_DefaultShapeNamesType::ALL_PROPERTIES;

	$request->IndexedPageItemView = new EWSType_IndexedPageViewType;
	$request->IndexedPageItemView->BasePoint ='Beginning';
	$request->IndexedPageItemView->Offset = '0'; //What we loop over
	$request->IndexedPageItemView->MaxEntriesReturned = '1000';

	$request->ParentFolderIds = new EWSType_NonEmptyArrayOfBaseFolderIdsType();
	$request->ParentFolderIds->DistinguishedFolderId = new EWSType_DistinguishedFolderIdType();
	$request->ParentFolderIds->DistinguishedFolderId->Id = EWSType_DistinguishedFolderIdNameType::CONTACTS;
	$request->ParentFolderIds->DistinguishedFolderId->Mailbox = new StdClass;
	$request->ParentFolderIds->DistinguishedFolderId->Mailbox->EmailAddress = 'smragon@intersystems.com';
	
	$request->Traversal = EWSType_ItemQueryTraversalType::SHALLOW;

	for($i=0;$i<3;$i++){
		//next contact
		$request->IndexedPageItemView->Offset = $i*1000; 
		
		//make request
		$response = $ews->FindItem($request);

		$count = count($response->ResponseMessages->FindItemResponseMessage->RootFolder->Items->Contact);
		
		for($j=0;$j<$count;$j++){
			//Contact object
			$contact = $response->ResponseMessages->FindItemResponseMessage->RootFolder->Items->Contact[$j];

			//Check if a match
			if ($contact->GivenName==$firstName){
				if ($contact->Surname==$lastName){
					if ($contact->Generation==$suffix){
						$exchangeContact['Id'] = $contact->ItemId->Id;
						$exchangeContact['ChangeKey'] = $contact->ItemId->ChangeKey;
						unset($ews);
						break 2;
					}
				}
			}
		}
		
		

	}

	if($exchangeContact['Id']!=''){
		return $exchangeContact;
	}else{
		$exchangeContact['Error'] = 'No match found';
		return $exchangeContact;
	}
}

/**
*Find a person's exchange Id adn ChangeKey based on Email
	* @return array $exchangeContact
 		*$exchangeContact['Id'] = string 
		*$exchangeContact['ChangeKey'] = string
		*$exchangeContact['Error'] = string (empty if no error)
	*@param string $primaryEmail
**/
function searchByEmail($primaryEmail){
	
	//$exchangeContact = ['Id' => '', 'ChangeKey' => '', 'Error' =>''];

	//New web service
	$ews = newWebService();

	//Request
	$request->ItemShape = new EWSType_ItemResponseShapeType();
	$request->ItemShape->BaseShape = EWSType_DefaultShapeNamesType::ALL_PROPERTIES;

	$request->IndexedPageItemView = new EWSType_IndexedPageViewType;
	$request->IndexedPageItemView->BasePoint ='Beginning';
	$request->IndexedPageItemView->Offset = '0'; //What we loop over
	$request->IndexedPageItemView->MaxEntriesReturned = '1000';

	$request->ParentFolderIds = new EWSType_NonEmptyArrayOfBaseFolderIdsType();
	$request->ParentFolderIds->DistinguishedFolderId = new EWSType_DistinguishedFolderIdType();
	$request->ParentFolderIds->DistinguishedFolderId->Id = EWSType_DistinguishedFolderIdNameType::CONTACTS;
	$request->ParentFolderIds->DistinguishedFolderId->Mailbox = new StdClass;
	$request->ParentFolderIds->DistinguishedFolderId->Mailbox->EmailAddress = 'smragon@intersystems.com';
	
	$request->Traversal = EWSType_ItemQueryTraversalType::SHALLOW;


	for($i=0;$i<3;$i++){
		//next contact
		$request->IndexedPageItemView->Offset = $i*1000; 
		
		//make request
		$response = $ews->FindItem($request);

		$count = count($response->ResponseMessages->FindItemResponseMessage->RootFolder->Items->Contact);
		
		for($j=0;$j<$count;$j++){
			//Contact object
			$contact = $response->ResponseMessages->FindItemResponseMessage->RootFolder->Items->Contact[$j];

			//Check if a match
			if (is_object($contact->EmailAddresses)){
				if(is_object($contact->EmailAddresses->Entry)){
					if($contact->EmailAddresses->Entry->_==$primaryEmail){
						$exchangeContact['Id'] = $contact->ItemId->Id;
						$exchangeContact['ChangeKey'] = $contact->ItemId->ChangeKey;
						unset($ews);
						break 2;
					}
				}else{
					if($contact->EmailAddresses->Entry[0]->_==$primaryEmail){
						$exchangeContact['Id'] = $contact->ItemId->Id;
						$exchangeContact['ChangeKey'] = $contact->ItemId->ChangeKey;
						unset($ews);
						break 2;
					}
				}
			}
		}
		
		

	}

	if($exchangeContact['Id']!=''){
		return $exchangeContact;
	}else{
		$exchangeContact['Error'] = 'No match found';
		return $exchangeContact;
	}
	
}

/**
*Create list of changed record Id's that happened after the date time provided
	*@return array $exchangeContacts
		*$exchangeContacts[#]['Id'] = string
		*$exchangeContacts[#]['ChangeKey'] = string
		*$exchangeContacts['Count'] = integer
		*$exchangeContact['Error'] = string (empty if no error)
	*@param string $dateTime
		* Format YYYY-MM-DDT00:00:00z
**/
function createChangeList($dateTime){
	
	if ($dateTime==''){
		return false;
	}
	$exchangeContacts['Count'] = 0;

	//New web service
	$ews = newWebService();

	//Request
	$request->ItemShape = new EWSType_ItemResponseShapeType();
	$request->ItemShape->BaseShape = EWSType_DefaultShapeNamesType::ALL_PROPERTIES;

	$request->IndexedPageItemView = new EWSType_IndexedPageViewType;
	$request->IndexedPageItemView->BasePoint ='Beginning';
	$request->IndexedPageItemView->Offset = '0'; //What we loop over
	$request->IndexedPageItemView->MaxEntriesReturned = '1000';

	$request->ParentFolderIds = new EWSType_NonEmptyArrayOfBaseFolderIdsType();
	$request->ParentFolderIds->DistinguishedFolderId = new EWSType_DistinguishedFolderIdType();
	$request->ParentFolderIds->DistinguishedFolderId->Id = EWSType_DistinguishedFolderIdNameType::CONTACTS;
	$request->ParentFolderIds->DistinguishedFolderId->Mailbox = new StdClass;
	$request->ParentFolderIds->DistinguishedFolderId->Mailbox->EmailAddress = 'smragon@intersystems.com';
	
	$request->Traversal = EWSType_ItemQueryTraversalType::SHALLOW;
	for($i=0;$i<3;$i++){
	
	//next contact
		$request->IndexedPageItemView->Offset = $i*1000; 
		
		//make request
		$response = $ews->FindItem($request);

		$count = count($response->ResponseMessages->FindItemResponseMessage->RootFolder->Items->Contact);
	
		for($j=0;$j<$count;$j++){
			//Contact object
			$contact = $response->ResponseMessages->FindItemResponseMessage->RootFolder->Items->Contact[$j];
			$LastModifiedTime = $contact->LastModifiedTime;
			if($LastModifiedTime > $dateTime){
				
					$cnt = $exchangeContacts['Count'];
					$exchangeContacts[$cnt]['Id'] = $contact->ItemId->Id;
					$exchangeContacts[$cnt]['ChangeKey'] = $contact->ItemId->ChangeKey;
					$exchangeContacts['Count'] = $cnt+ 1;
			}
			

		}
		
		
	}

	if($exchangeContacts[0]['Id']!=''){
		return $exchangeContacts;
	}else{
		$exchangeContacts['Error'] = 'No match found';
		return $exchangeContacts;
	}

}

/**
*Return array of contact information
	*@return array $exchangeContact
		*$exchangeContact['FirstName'] = string
		*$exchangeContact['LastName'] = string
		*$exchangeContact['MiddleName'] = string
		*$exchangeContact['Suffx'] = string
		*$exchangeContact['Initials'] = string
		*$exchangeContact['FullName'] = string
		*$exchangeContact['NickName'] = string
		*$exchangeContact['Birthday'] = string
		*$exchangeContact['Category'] = string
		*$exchangeContact['Title'] = string
		*$exchangeContact['Gender'] = string
		*$exchangeContact['Email1'] = string
		*$exchangeContact['Email2'] = string
		*$exchangeContact['Email3'] = string
		*$exchangeContact['AssistantPhone'] = string
 		*$exchangeContact['BusinessFax'] = string
 		*$exchangeContact['BusinessPhone'] = string
 		*$exchangeContact['BusinessPhone2'] = string
 		*$exchangeContact['Callback'] = string
 		*$exchangeContact['CarPhone'] = string
 		*$exchangeContact['CompanyMainPhone'] = string
 		*$exchangeContact['HomeFax'] = string
 		*$exchangeContact['HomePhone'] = string
 		*$exchangeContact['HomePhone2'] = string
 		*$exchangeContact['ISDN'] = string
 		*$exchangeContact['MobilePhone'] = string
 		*$exchangeContact['OtherFax'] = string
 		*$exchangeContact['OtherTelephone'] = string
 		*$exchangeContact['Pager'] = string
 		*$exchangeContact['PrimaryPhone'] = string
 		*$exchangeContact['RadioPhone'] = string
 		*$exchangeContact['Telex'] = string
 		*$exchangeContact['TtyTtdPhone'] = string
		*$exchangeContact['HomeaAddress'] = string
 		*$exchangeContact['BusinessAddress'] = string
 		*$exchangeContact['OtherAddress'] = string
 	* @param string $exchangeId
 	* @param string $exchangeChangeKey
**/
function retrieveContact($exchangeId, $exchangeChangeKey){

	if($exchangeId==''){
		return false;
	}elseif ($exchangeChangeKey=='') {
		return false;
	}

	$ews = newWebService();
	$request = new EWSType_GetItemType();

	$request->ItemShape = new EWSType_ItemResponseShapeType();
	$request->ItemShape->BaseShape = EWSType_DefaultShapeNamesType::ALL_PROPERTIES;
	$request->ItemShape->AdditionalProperties = new EWSType_NonEmptyArrayOfPathsToElementType();

	$extendedProperty = new EWSType_PathToExtendedFieldType();
	$extendedProperty->PropertyTag = '0x3A4D';
	$extendedProperty->PropertyType = EWSType_MapiPropertyTypeType::SHORT;
	$request->ItemShape->AdditionalProperties->ExtendedFieldURI = array($extendedProperty);


	$request->ItemIds = new EWSType_NonEmptyArrayOfBaseItemIdsType();
	$request->ItemIds->ItemId = new EWSType_ItemIdType();
	$request->ItemIds->ItemId->Id = $exchangeId; 

	$response = $ews->GetItem($request);

	//Regular properties
	if($response->Items->Contact->GivenName ){
		$exchangeContact['FirstName'] = $response->Items->Contact->GivenName;
	}
	if($response->Items->Contact->Surname ){
		$exchangeContact['LastName'] = $response->Items->Contact->Surname;
	}
	if($response->Items->Contact->MiddleName ){
		$exchangeContact['MiddleName'] = $response->Items->Contact->MiddleName;
	}
	if($response->Items->Contact->Generation ){
		$exchangeContact['Suffx'] = $response->Items->Contact->Generation;
	}
	if($response->Items->Contact->Initials ){
		$exchangeContact['Initials'] = $response->Items->Contact->Initials;
	}
	if($response->Items->Contact->DisplayName ){
		$exchangeContact['FullName'] = $response->Items->Contact->DisplayName;
	}
	if($response->Items->Contact->Nickname ){
		$exchangeContact['NickName'] = $response->Items->Contact->Nickname;
	}
	if($response->Items->Contact->Birthday ){
		$exchangeContact['Birthday'] = $response->Items->Contact->Birthday;
	}
	if($response->Items->Contact->Categories->String ){
		$exchangeContact['Category'] = $response->Items->Contact->Categories->String;
	}

	//Extended Properties
	if($response->Items->Contact->CompleteName->Title){
		$exchangeContact['Title'] = $response->Items->Contact->CompleteName->Title;
	}
	if($response->Items->Contcat->ExtendedProperty->Value){
		$exchangeContact['Gender'] = $response->Items->Contact->ExtendedProperty->Value;
	}
	
	//Emails
	if(is_object($response->Items->Contact->EmailAddresses)){
		
		if(is_object($response->Items->EmailAddresses->Entry)){
			$exchangeContact['Email1'] = $response->Items->EmailAddresses->Entry->_;
		}
		else{
			$emailCount = count($response->Items->Contact->EmailAddresses->Entry);
			if($emailCount==2){
				$exchangeContact['Email1'] = $response->Items->EmailAddresses->Entry[0]->_;
				$exchangeContact['Email2'] = $response->Items->EmailAddresses->Entry[1]->_;
			}elseif ($emailCount==3) {
				$exchangeContact['Email1'] = $response->Items->EmailAddresses->Entry[0]->_;
				$exchangeContact['Email2'] = $response->Items->EmailAddresses->Entry[1]->_;
				$exchangeContact['Email3'] = $response->Items->EmailAddresses->Entry[2]->_;
			}
		}
	}

	//Phones
	if(is_object($response->Items->Contact->PhoneNumbers)){
		
		if(is_object($response->Items->Contact->PhoneNumbers->Entry)){
			$phoneKey = $response->Items->Contact->PhoneNumbers->Entry->Key;
			$exchangeContact[$phoneKey] = $response->Items->Contact->PhoneNumbers->Entry->_;
		}
		else{
			$phoneCount = count($response->Items->Contact->PhoneNumbers->Entry);	
			for($i=0;$i<$phoneCount;$i++){
				$phoneKey = $response->Items->Contact->PhoneNumbers->Entry[$i]->Key;
				$exchangeContact[$phoneKey] = $response->Items->Contact->PhoneNumbers->Entry[$i]->_;
			}
		}

	}

	//Addresses
	if(is_object($response->Items->Contact->PhysicalAddresses)){
		if(is_object($response->Items->Contact->PhysicalAddresses->Entry)){
				$addressKey = $response->Items->Contact->PhysicalAddresses->Entry->Key . 'Address';
				$exchangeContact[$addressKey] = $response->Items->Contact->PhysicalAddresses->Entry->Street .', '.$response->Items->Contact->PhysicalAddresses->Entry->City.', '.$response->Items->Contact->PhysicalAddresses->Entry->State.', '.$response->Items->Contact->PhysicalAddresses->Entry->PostalCode;   
		}
		else{
			$addressCount = count($response->Items->Contact->PhysicalAddresses->Entry);
			for($j=0;$j<$addressCount;$j++){
				$addressKey = $response->Items->Contact->PhysicalAddresses->Entry[$j]->Key . 'Address';
				$exchangeContact[$addressKey] = $response->Items->Contact->PhysicalAddresses->Entry[$j]->Street.', '.$response->Items->Contact->PhysicalAddresses->Entry[$j]->City.', '.$response->Items->Contact->PhysicalAddresses->Entry[$j]->State.', '.$response->Items->Contact->PhysicalAddresses->Entry[$j]->PostalCode;   
			}
		}
	}

	unset($ews);
	return $exchangeContact;
}

/**
 *Creates and returns an Exchange Web Services object
 	*@return ExchangeWebService object
*/
function newWebService(){
	
	$server = 'owa2.intersystems.com';
	$username = 'iscinternal\cledin';
	$password = 'Password1';

	$ews = new ExchangeWebServices($server, $username, $password, ExchangeWebServices::VERSION_2010_SP2);
	
	return $ews;
}
?>