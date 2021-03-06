<?php
    namespace vsphere;
    use \GuzzleHttp\Client;
    class vmware{
        const GET ="GET";
        const POST="POST";
        private $connection;


        public function __construct($host,array $credential,$options=['verify'=>false],$singleton=false)
        {
            $this->connection=connection::getInstance(new Client($options),$host,$credential,$singleton);
        }


        public function getAllOfVm(array $content=null){

            $vms=$this->connection->makeRequest(self::GET,"vcenter/vm",false,$content);

            return new manageVmObjects(json_decode($vms->getBody()),$this->connection);


        }

        /**
         * @param $VM
         * @param array|null $content
         * @return vm
         */
        public function getVmByVm($VM, array $content=null){
            $object=$this->connection->makeRequest(self::GET,"vcenter/vm/$VM",false,$content);
            return vm::makeVmInstance($this->connection,json_decode($object->getBody()),$VM);
        }
        public function getSessionId(){
            return $this->connection->session;
        }





    }

