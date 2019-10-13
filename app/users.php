<?php

require_once __DIR__ . '/../vendor/autoload.php';
class User
{

    public $username;
    public $isClient;
    public $userGroup;
    public $internalUserId;
    public $id;
    public $firstName;
    public $lastName;
    public $cmdbCompanyId;
    public $primaryAccountId;
    public $email;
    private $clients;
    public $client;

    public function __construct()
    {
        $api = \Ubnt\UcrmPluginSdk\Service\UcrmApi::create();
        $security = \Ubnt\UcrmPluginSdk\Service\UcrmSecurity::create();
        $user = $security->getUser();
        $users = $api->get('clients');
        $this->client = array();
        $this->clients = $api->get('clients');
        $this->username = $user->username;
        $this->processClients();
        $this->isClient = $user->isClient;
        $this->userGroup = $user->userGroup;
        $this->internalUserId = $user->userId;
        $this->id = $this->client['id'];
        $this->firstName = $this->client['firstName'];
        $this->lastName = $this->client['lastName'];
        $this->cmdbCompanyId = $this->array_key_search('value', 'cmdb-company-id', 'name', $this->client['attributes']);
        $this->primaryAccountId = $this->array_key_search('value', 'primary-acct-id', 'name', $this->client['attributes']);
        $this->email = $this->client['contacts'][0]['email'];
        $this->clients = false;
        $this->client = false;
    }

    public function processClients()
    {
        foreach ($this->clients as $searchclient) {
            if ($searchclient['username'] == $this->username) {
                $this->client = $searchclient;
            }
        }
    }

    public function array_key_search($returnkey, $keyvalue, $key, $array)
    {
        $result = false;
        if (!empty($array)) {
            foreach ($array as $arrayitem) {
                if ($arrayitem[$key] == $keyvalue) {
                    $result = $arrayitem[$returnkey];
                }
            }
        }
        return $result;
    }

}
