<?php

namespace tomyates\yii2\oauth2server;

trait BootstrapTrait
{
    /**
     * @var array Model's map
     */
    private $_modelMap = [
        'OauthClients'               => 'tomyates\yii2\oauth2server\models\OauthClients',
        'OauthAccessTokens'          => 'tomyates\yii2\oauth2server\models\OauthAccessTokens',
        'OauthAuthorizationCodes'    => 'tomyates\yii2\oauth2server\models\OauthAuthorizationCodes',
        'OauthRefreshTokens'         => 'tomyates\yii2\oauth2server\models\OauthRefreshTokens',
        'OauthScopes'                => 'tomyates\yii2\oauth2server\models\OauthScopes',
    ];
    
    /**
     * @var array Storage's map
     */
    private $_storageMap = [
        'access_token'          => 'tomyates\yii2\oauth2server\storage\Pdo',
        'authorization_code'    => 'tomyates\yii2\oauth2server\storage\Pdo',
        'client_credentials'    => 'tomyates\yii2\oauth2server\storage\Pdo',
        'client'                => 'tomyates\yii2\oauth2server\storage\Pdo',
        'refresh_token'         => 'tomyates\yii2\oauth2server\storage\Pdo',
        'user_credentials'      => 'tomyates\yii2\oauth2server\storage\Pdo',
        'public_key'            => 'tomyates\yii2\oauth2server\storage\Pdo',
        'jwt_bearer'            => 'tomyates\yii2\oauth2server\storage\Pdo',
        'scope'                 => 'tomyates\yii2\oauth2server\storage\Pdo',
    ];
    
    protected function initModule(Module $module)
    {
        $this->_modelMap = array_merge($this->_modelMap, $module->modelMap);
        foreach ($this->_modelMap as $name => $definition) {
            \Yii::$container->set("tomyates\\yii2\\oauth2server\\models\\" . $name, $definition);
            $module->modelMap[$name] = is_array($definition) ? $definition['class'] : $definition;
        }

        $this->_storageMap = array_merge($this->_storageMap, $module->storageMap);
        foreach ($this->_storageMap as $name => $definition) {
            \Yii::$container->set($name, $definition);
            $module->storageMap[$name] = is_array($definition) ? $definition['class'] : $definition;
        }
    }
}