<?php

namespace stopfordisptm\yii2\oauth2server\storage;

class Pdo extends \OAuth2\Storage\Pdo 
{
    public $dsn;
    
    public $username;
    
    public $password;
    
    public $connection = 'db';
    
    public function __construct($connection = null, $config = array())
    {
        if($connection === null) {
            if($this->connection !== null && \Yii::$app->has($this->connection)) {
                $db = \Yii::$app->get($this->connection);
                if(!($db instanceof \yii\db\Connection)) {
                    throw new \yii\base\InvalidConfigException('Connection component must implement \yii\db\Connection.');
                }
                
                if(!$db->getIsActive()) {
                    $db->open();
                }
                
                $connection = $db->pdo;
                $config = array_merge(array(
                    'client_table' => $db->tablePrefix . 'oauth_clients',
                    'access_token_table' => $db->tablePrefix . 'oauth_access_tokens',
                    'refresh_token_table' => $db->tablePrefix . 'oauth_refresh_tokens',
                    'code_table' => $db->tablePrefix . 'oauth_authorization_codes',
                    'user_table' => $db->tablePrefix . 'oauth_users',
                    'jwt_table'  => $db->tablePrefix . 'oauth_jwt',
                    'jti_table'  => $db->tablePrefix . 'oauth_jti',
                    'scope_table'  => $db->tablePrefix . 'oauth_scopes',
                    'public_key_table'  => $db->tablePrefix . 'oauth_public_keys',
                ), $config);
                
            } else {
                $connection = [
                    'dsn' => $this->dsn,
                    'username' => $this->username,
                    'password' => $this->password
                ];
            }
        }
        
        parent::__construct($connection, $config);
    }

    public function checkClientCredentials($client_id, $client_secret = null)
    {
        parent::checkClientCredentials($client_id, $client_secret);
    }

    public function isPublicClient($client_id)
    {
        return parent::isPublicClient($client_id);
    }

    public function getClientScope($client_id)
    {
        return parent::getClientScope($client_id);
    }

    public function checkRestrictedGrantType($client_id, $grantType)
    {
        return parent::checkRestrictedGrantType($client_id, $grantType);
    }
    public function getAccessToken($access_token)
    {
        return parent::getAccessToken($access_token);
    }

    public function setAccessToken($access_token, $client_id, $user_id, $expires, $scope = null)
    {
        return parent::setAccessToken($access_token, $client_id, $user_id, $expires, $scope);
    }

    public function unsetAccessToken($access_token)
    {
        return parent::unsetAccessToken($access_token);
    }

    public function getAuthorizationCode($code)
    {
        return parent::getAuthorizationCode($code);
    }

    public function setAuthorizationCode($code, $client_id, $user_id, $redirect_uri, $expires, $scope = null, $id_token = null, $code_challenge = null, $code_challenge_method = null)
    {
        return parent::setAuthorizationCode($code, $client_id, $user_id, $redirect_uri, $expires, $scope, $id_token, $code_challenge, $code_challenge_method);
    }

    public function expireAuthorizationCode($code)
    {
        return parent::expireAuthorizationCode($code);
    }

    public function checkUserCredentials($username, $password)
    {
        return parent::checkUserCredentials($username, $password);
    }

    public function getUserDetails($username)
    {
        return parent::getUserDetails($username);
    }

    public function getRefreshToken($refresh_token)
    {
        return parent::getRefreshToken($refresh_token);
    }

    public function setRefreshToken($refresh_token, $client_id, $user_id, $expires, $scope = null)
    {
        return parent::setRefreshToken($refresh_token, $client_id, $user_id, $expires, $scope);
    }

    public function unsetRefreshToken($refresh_token)
    {
        return parent::unsetRefreshToken($refresh_token);
    }

    public function getUser($username)
    {
        return parent::getUser($username);
    }

    public function setUser($username, $password, $firstName = null, $lastName = null)
    {
        return parent::setUser($username, $password, $firstName, $lastName);
    }

    public function scopeExists($scope)
    {
        return parent::scopeExists($scope);
    }

    public function getDefaultScope($client_id = null)
    {
        return parent::getDefaultScope($client_id);
    }

    public function getClientKey($client_id, $subject)
    {
        return parent::getClientKey($client_id, $subject);
    }

    public function getJti($client_id, $subject, $audience, $expires, $jti)
    {
        return parent::getJti($client_id, $subject, $audience, $expires, $jti);
    }

    public function setJti($client_id, $subject, $audience, $expires, $jti)
    {
        return parent::setJti($client_id, $subject, $audience, $expires, $jti);
    }

    public function getPublicKey($client_id = null)
    {
        return parent::getPublicKey($client_id);
    }

    public function getPrivateKey($client_id = null)
    {
        return parent::getPrivateKey($client_id);
    }

    public function getEncryptionAlgorithm($client_id = null)
    {
        return parent::getEncryptionAlgorithm($client_id);
    }
}
