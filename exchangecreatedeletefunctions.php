<?php

/**
 *Creates a Contact and Returns the Exchange ChangeKey and Id in an array
 	*
 	* @return array $exchangeContact
 		*$exchangeContact['Id'] = string 
		*$exchangeContact['ChangeKey'] = string
		*$exchangeContact['Error'] = string (empty if NO error)
 	*
 	* @param string $firstName
 		*REQUIRED
 	* @param string $lastName
 		*REQUIRED
 	* @param string $category
 		*REQUIRED
 	* @param string $middleName
 	* @param string $title
 	* @param string $suffix
 	* @param string $initials
 	* @param string $nickName
 	* @param string $birthday
 	* @param string $gender
 	* @param string $email1
 	* @param string $email2
 	* @param string $email3
 	* @param string $homePhone
 	* @param string $mobilePhone
 	* @param string $businessPhone
 	* @param string $otherPhone
 	* @param string $primaryPhone
 	* @param string $homeAddressStreet
 	* @param string $businessAddressStreet
 	* @param string $otherAddressStreet
 	* @param string $homeAddressCity
 	* @param string $businessAddressCity
 	* @param string $otherAddressCity
 	* @param string $homeAddressState
 	* @param string $businessAddressState
 	* @param string $otherAddressState
 	* @param string $homeAddressZip
 	* @param string $businessAddressZip
 	* @param string $otherAddressZip
 **/
function createExchangeContact($firstName,$lastName,$category,$middleName,$title,$suffix,$initials,$nickName,$birthday,$gender,$email1,$email2,$email3,$homePhone,$mobilePhone,$businessPhone,$otherPhone,$primaryPhone,$homeAddressStreet,$businessAddressStreet, $otherAddressStreet,$homeAddressCity,$businessAddressCity, $otherAddressCity,$homeAddressState,$businessAddressState, $otherAddressState,$homeAddressZip,$businessAddressZip, $otherAddressZip){
	//$exchangeContact = ['Id' => '', 'ChangeKey' => '', 'Error' =>''];

	//Check for the required inputs
	if ($firstName=='') {
		$exchangeContact['Error'] = 'Invalid Input';
		return $exchangeContact;
	}elseif ($lastName=='') {
		$exchangeContact['Error'] = 'Invalid Input';
		return $exchangeContact;
	}elseif ($category=='') {
		$exchangeContact['Error'] = 'Invalid Input';
		return $exchangeContact;
	}
	
	//create our webservice
	$ews = newWebService();

	$request = new EWSType_CreateItemType();

	$contact = new EWSType_ContactItemType();
	$contact->GivenName = $firstName;
	$contact->Surname = $lastName;
	

	//TO GET SHARED
	$request->SavedItemFolderId = new EWSType_TargetFolderIdType();
	$request->SavedItemFolderId->DistinguishedFolderId = new EWSType_DistinguishedFolderIdType();
	$request->SavedItemFolderId->DistinguishedFolderId->Id = EWSType_DistinguishedFolderIdNameType::CONTACTS;
	$request->SavedItemFolderId->DistinguishedFolderId->Mailbox = new StdClass;
	$request->SavedItemFolderId->DistinguishedFolderId->Mailbox->EmailAddress = 'smragon@intersystems.com';


	$request->Items->Contact[] = $contact;

	$result = $ews->CreateItem($request);

	if ($result->ResponseMessages->CreateItemResponseMessage->ResponseClass == 'Success') {
		$exchangeId = $result->ResponseMessages->CreateItemResponseMessage->Items->Contact->ItemId->Id;
		$exchangeChangeKey = $result->ResponseMessages->CreateItemResponseMessage->Items->Contact->ItemId->ChangeKey;
	}else{
		$exchangeContact['Error'] = $result->ResponseMessages->CreateItemResponseMessage->ResponseCode;
		return $exchangeContact;
	}

	//unset the web service
	unset($ews);

	if($category!=''){
		$status = updateCategory($exchangeId, $exchangeChangeKey, $category);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:category';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($middleName!=''){
		$status = updateMiddleName($exchangeId, $exchangeChangeKey, $middleName);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:middlename';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($title!=''){
		$status = updateTitle($exchangeId, $exchangeChangeKey, $title);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:title';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($suffix!=''){
		$status = updateSuffix($exchangeId, $exchangeChangeKey, $suffix);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:suffix';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($initials!=''){
		$status = updateInitials($exchangeId, $exchangeChangeKey, $initials);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:initials';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($nickName!=''){
		$status = updateNickName($exchangeId, $exchangeChangeKey, $nickName);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:nickname';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($birthday!=''){
		$status = updateBirthday($exchangeId, $exchangeChangeKey, $birthday);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:birthday';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($gender!=''){
		$status = updateGender($exchangeId, $exchangeChangeKey, $gender);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:gender';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($email1!=''){
		$status = updateEmail($exchangeId, $exchangeChangeKey, 1, $email1);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:email1';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($email2!=''){
		$status = updateEmail($exchangeId, $exchangeChangeKey, 2, $email2);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:email2';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($email3!=''){
		$status = updateEmail($exchangeId, $exchangeChangeKey, 3, $email3);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:email3';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($homePhone!=''){
		$status = updatePhone($exchangeId, $exchangeChangeKey, 'HomePhone', $homePhone);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:homephone';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($mobilePhone!=''){
		$status = updatePhone($exchangeId, $exchangeChangeKey, 'MobilePhone', $mobilePhone);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:mobilephone';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($businessPhone!=''){
		$status = updatePhone($exchangeId, $exchangeChangeKey, 'BusinessPhone', $businessPhone);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:businessphone';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($otherPhone!=''){
		$status = updatePhone($exchangeId, $exchangeChangeKey, 'OtherTelephone', $otherPhone);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:otherphone';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($primaryPhone!=''){
		$status = updatePhone($exchangeId, $exchangeChangeKey, 'PrimaryPhone', $primaryPhone);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:primaryphone';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($homeAddressStreet!='' && $homeAddressCity!='' && $homeAddressState!='' && $homeAddressZip!=''){
		$status = updateAddress($exchangeId, $exchangeChangeKey, 'Home', $homeAddressStreet, $homeAddressCity, $homeAddressState, $homeAddressZip);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:homeaddress';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($businessAddressStreet!='' && $businessAddressCity!='' && $businessAddressState!='' && $businessAddressZip!=''){
		$status = updateAddress($exchangeId, $exchangeChangeKey, 'Business', $businessAddressStreet, $businessAddressCity, $businessAddressState, $businessAddressZip);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:businessaddress';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	if($otherAddressStreet!='' && $otherAddressCity!='' && $otherAddressState!='' && $otherAddressZip!=''){
		$status = updateAddress($exchangeId, $exchangeChangeKey, 'Other', $otherAddressStreet, $otherAddressCity, $otherAddressState, $otherAddressZip);
	}
	if(!$status){
		$exchangeContact['Error'] = 'Contact Created; Error in adding non-required properties:otheraddress';
		$exchangeContact['Id'] = $exchangeId;
		$exchangeContact['ChangeKey'] = $exchangeChangeKey;
		return $exchangeContact;
	}


	//build and return our array
	$exchangeContact['Id'] = $exchangeId;
	$exchangeContact['ChangeKey'] = $exchangeChangeKey;
	$exchangeContact['Error'] = '';
	return $exchangeContact;
}

/**
 * Perfroms a "soft" delete of a Contact
 * @param string $exchangeId
 * @param string $exchangeChangeKey
**/
function deleteExchangeContact($exchangeId, $exchangeChangeKey){
	
	//create our webservice
	$ews = newWebService();

	// Define the delete item class
	$request = new EWSType_DeleteItemType();
	// Send to trash can, or use EWSType_DisposalType::HARD_DELETE instead to bypass the bin directly
	$request->DeleteType = EWSType_DisposalType::MOVE_TO_DELETED_ITEMS;

	// Set the item to be deleted
	$item = new EWSType_ItemIdType();
	$item->Id = $exchangeId;
	$item->ChangeKey = $exchangeChangeKey;

	// We can use this to mass delete but in this case it's just one item
	$items = new EWSType_NonEmptyArrayOfBaseItemIdsType();
	$items->ItemId = $item;
	$request->ItemIds = $items;

	// Send the request
	$response = $ews->DeleteItem($request);

	if ($result->ResponseMessages->DeleteItemResponseMessage->ResponseClass == 'Success') {
		return true;
	}else{
		return false;
	}
	
}
?>