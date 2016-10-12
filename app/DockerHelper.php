<?php

/**
 * User: iman
 * Date: 10/10/16
 * Time: 3:48 PM
 */
namespace App;

use Docker\API\Model\ContainerConfig;
use Docker\Docker;

class DockerHelper
{
    private $docker;

    function __construct()
    {
        $this->docker = new Docker();
    }

    function getManager() {
        return $this->docker->getContainerManager();
    }

    function createNewMiddleware() {
        $containerConfig = new ContainerConfig();
        $containerConfig->setImage(config('middleware.image'));
        $containerCreateResult = $this->getManager()->create($containerConfig);

        if(config('middleware.name') == 'I1820') {
            $containerConfig->setEnv('I1820_INFLUXDB_HOST', config('middleware.db_host'));
        }

        $this->getManager()->start($containerCreateResult->getId());

        // Create and run container

        return $containerCreateResult->getId();
    }

    function findContainerIp($containerId) {

    }

}
