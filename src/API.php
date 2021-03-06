<?php

namespace UON;

use UON\Exceptions\APIException;

use UON\Endpoint\Bcard;
use UON\Endpoint\Cash;
use UON\Endpoint\Catalog;
use UON\Endpoint\Chat;
use UON\Endpoint\Cities;
use UON\Endpoint\Countries;
use UON\Endpoint\Hotels;
use UON\Endpoint\Leads;
use UON\Endpoint\Misc;
use UON\Endpoint\Nutrition;
use UON\Endpoint\Payments;
use UON\Endpoint\Reminders;
use UON\Endpoint\Requests;
use UON\Endpoint\Sources;
use UON\Endpoint\Statuses;
use UON\Endpoint\Suppliers;
use UON\Endpoint\Users;

/**
 * @property    Bcard $bcard - Bonus cards
 * @property    Cash $cash - Money operations
 * @property    Catalog $catalog - Catalog of products
 * @property    Chat $chat - For work with chat messages
 * @property    Cities $cities - Cities of countries
 * @property    Countries $countries - Work with countries
 * @property    Hotels $hotels - Hotels methods
 * @property    Leads $leads - Details about clients
 * @property    Misc $misc - Optional single methods
 * @property    Nutrition $nutrition - Some methods about eat
 * @property    Payments $payments - Payment methods
 * @property    Reminders $reminders - Work with reminders
 * @property    Requests $requests - New requests from people
 * @property    Sources $sources - All available sources
 * @property    Statuses $statuses - Request statuses
 * @property    Suppliers $suppliers - External companies
 * @property    Users $users - For work with users
 *
 * Single entry point for all classes
 *
 * @package     UON
 * @since       1.7
 */
class API
{
    /**
     * All parameters of this class
     * @var Config
     */
    private $config;

    /**
     * API constructor, need to provide Config class for normal work
     *
     * @param   Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Magic method required for call of another classes
     *
     * @param   $class
     * @return  bool|object
     */
    public function __get($class)
    {
        // By default return is false
        $object = false;

        try {
            // Extract token from config array
            $token = $this->config->get('token');

            // Check if token is not available
            if (false === $token) {
                throw new APIException('Token is not set');
            }

            // Generate dynamic name of class
            $class = __NAMESPACE__ . '\\Endpoint\\' . ucfirst(strtolower($class));

            // Try to create object by name
            $object = new $class($this->config);

            // If object is not created
            if (!is_object($object)) {
                throw new APIException("Class $class could not to be loaded");
            }

        } catch (APIException $e) {
            // __constructor
        }

        return $object;
    }
}
