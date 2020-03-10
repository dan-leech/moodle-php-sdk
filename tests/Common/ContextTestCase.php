<?php namespace MoodleSDK\Tests\Common;

use MoodleSDK\Auth\AuthTokenCredential;
use MoodleSDK\Rest\RestApiContext;

use PHPUnit\Framework\TestCase;

abstract class ContextTestCase extends TestCase
{

    private $context;

    public function contextProvider()
    {
        return [[$this->getContext()]];
    }

    protected function getContext()
    {
        if (!$this->context) {
            $this->context = RestApiContext::instance()
                ->setUrl(getenv('MOODLE_API_URL'))
                ->setCredential(new AuthTokenCredential(getenv('MOODLE_API_TOKEN')));

            if (getenv('ENVIRONMENT') === 'development') {
                $this->context->setDebug(true);
            }
        }

        return $this->context;
    }

}
