<?php

namespace M151\LibraryOK\Routes;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use M151\LibraryOK\Repository;


/**
 * Class AbstractRoutes
 * @package M151\LibraryOK\Routes
 */
abstract class AbstractRoutes
{

    /**
     * @var Response
     */
    protected $request;
    /**
     * @var Response
     */
    protected $response;
    /**
     * @var []
     */
    protected $args;
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    function __invoke(Request $request, Response $response, array $args)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        $this->tempSaveCol();
        $this->tempSaveId();
        $this->tempSaveName();
    }

    /**
     * AbstractRoutes constructor.
     * @param ContainerInterface $container
     */
    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    private function tempSaveCol()
    {
        if (isset($this->args['col'])) {
            $_SESSION["col"] = $this->args['col'];
        } else {
            $_SESSION["col"] = 1;
        }
    }

    private function tempSaveName()
    {
        if (isset($this->args['name'])) {
            $_SESSION["name"] = $this->args['name'];
        }
    }

    private function tempSaveId()
    {
        if (isset($this->args['id'])) {
            $_SESSION["post_id"] = $this->args['id'];
        }
    }
}
