<?php

namespace Components\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;
use Firebase\Auth\Token\Exception\InvalidToken;

class ControllerFirebaseSDK {

	private function loginSDK() {
		$serviceAccount = ServiceAccount::fromJsonFile('Components/KeySDK/chavesdk.json');
		$firebase = (new Factory)
   			->withServiceAccount($serviceAccount)
   			->create();

		$authSDK = $firebase->getAuth();
		return $authSDK;
	}

	public function UserToken ($idToken) {
		$authSDK = $this->loginSDK();

		//Verifica se o token é valido e recupera o usuário do token
		try{
	    	$verifiedIdToken = $authSDK->verifyIdToken($idToken);
	    	$uid = $verifiedIdToken->getClaim('sub');
			$user = $authSDK->getUser($uid);
			return $user;
		} catch (InvalidToken $e) {
	    	return $e->getMessage();
		}
	}


	public function sair($idToken, $authSDK) {
		try{
	    	$verifiedIdToken = $authSDK->verifyIdToken($idToken);
	    	$uid = $verifiedIdToken->getClaim('sub');
	    	$authSDK->revokeRefreshTokens($uid);
	    	echo "revogados";
	    	header('Location: http://localhost/fb/cli');
		} catch (InvalidToken $e) {
	    	echo $e->getMessage();
		}
	}

}

