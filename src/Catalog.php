<?php namespace UON;

/**
 * Class Catalog
 * @package UON
 */
class Catalog extends Client
{
    /**
     * Get services of "I'am operator" by page number (first page by default)
     *
     * @link    https://api.u-on.ru/{key}/bcard-bonus-by-card/{id}.{_format}
     * @param   int $page - Unique card ID
     * @return  array|false
     */
    public function get($page = 1)
    {
        $endpoint = '/catalog-service/' . $page;
        return $this->doRequest('get', $endpoint);
    }

    /**
     * Create services of "I'am operator"
     *
     * @link    https://api.u-on.ru/{key}/bcard-activate/create.{_format}
     * @param   array $parameters - List of parameters [s_id ...]
     * @return  array|false
     */
    public function create($parameters)
    {
        $endpoint = '/catalog-service/create';
        return $this->doRequest('post', $endpoint, $parameters);
    }

    /**
     * Update services of "I'am operator"
     *
     * @link    https://api.u-on.ru/{key}/catalog-service/update/{id}.{_format}
     * @param   int $id - Unique ID of element
     * @param   array $parameters - List of parameters [s_id ...]
     * @return  array|false
     */
    public function update($id, $parameters)
    {
        $endpoint = '/catalog-service/update/' . $id;
        return $this->doRequest('post', $endpoint, $parameters);
    }

}
