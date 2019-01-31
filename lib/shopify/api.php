<?php
class ShopifyApi
{
    /**
     * The API URL base.
     * 
     * @var string
     */
    private $base;

    /**
     * Initializes properties.
     */
    public function __construct()
    {
        $this->setBase();
    }

    /**
     * Sets base property, or returns error on fail.
     *
     * @return mixed Optionally returns an error.
     */
    private function setBase()
    {
      $this->base =  'https://the-280-group.myshopify.com/api/graphql';
    }


    /**
     * Returns in person courses from shopify
     * 
     * @return mixed The decoded JSON or WP_Error.
     */
    public function getCollections()
    {
      $params = '{ shop {  collections(first: 100) {  edges { node { title id handle } } } }  }';
      return $this->requestGet($params);
    }


    /**
     * Returns in person courses from shopify
     * 
     * @return mixed The decoded JSON or WP_Error.
     */
    public function getInPersonCourses()
    {
      $params = '{ shop { collectionByHandle(handle: "training-courses") { id description products(first: 250) { edges { node{ id title onlineStoreUrl description handle tags variants(first: 10) { edges { node { id title sku price selectedOptions { name value } product { title  id collections(first: 10) { edges { node { title id  } } } } } } } } } } } } }';
      return $this->requestGet($params);
    }


    /**
     * Returns online courses from shopify
     * 
     * @return mixed The decoded JSON or WP_Error.
     */
    public function getOnlineCourses()
    {
      $params = '{ shop { collectionByHandle(handle: "course-type-online") { id description products(first: 250) { edges { node{ id title onlineStoreUrl description handle tags variants(first: 10) { edges { node { id title sku price selectedOptions { name value } product { title  id collections(first: 10) { edges { node { title id  } } } } } } } } } } } } }';
      return $this->requestGet($params);
    }


    /**
     * Returns toolkit products shopify
     * 
     * @return mixed The decoded JSON or WP_Error.
     */
    public function getToolkitProducts()
    {
      $params = '{ shop {  collectionByHandle(handle: "toolkits") {  id  description  products(first: 250) {  edges {  node{  id title onlineStoreUrl description handle tags variants(first: 10) { edges { node { id sku price selectedOptions { name value } } } } } } } } } }';
      return $this->requestGet($params);
    }

    /**
     * Returns the available fields of the form.
     * 
     * @return mixed The decoded JSON or WP_Error.
     */
    public function getEntries($id)
    {
      $filter = "";
      if ($id != "") $filter = '&Filter1=EntryId+Is_equal_to+'.$id;
      return $this->requestGet('/entries.json?pageSize=100&sort=EntryId&sortDirection=DESC'.$filter, "");
    }



    /**
     * Makes a GET request.
     *
     * @param string $endpoint The API endpoint.
     * @param array $params The query string parameters and values.
     * 
     * @return mixed The decoded JSON or WP_Error.
     */
    private function requestGet($params)
    {
      $response = wp_remote_post( $this->base, array(
        'method' => 'POST',
        'timeout' => 45,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array(
                      'Cache-Control' => 'no-cache',
                      'Authorization' => 'Basic NGZlNWI1MmVjOWI0MGMyOTVhNDRhNzJkZTI0NDc0OWI6NmY2MzhhOTkyNWMzZWZiZDFiNTI4MzE5NTRlM2U3MWQ=',
                      'Content-Type' => 'application/graphql',
                      'X-Shopify-Storefront-Access-Token' => 'aaa16ea56a536b16f0a96877f610e0b5'
                    ),
        'body' => $params,
        )
      );

      return $this->buildResponse($response['body']);
    }

    /**
     * Sets the response output.
     * 
     * @param string $request The JSON response body.
     * 
     * @return mixed The decoded JSON or WP_Error.
     */
    private function buildResponse($request)
    {
        $decoded = json_decode($request, true);

        if (isset($decoded->error_code) && (0 !== $decoded->error_code)) {
            $this->logError($decoded);
            $message = $this->filterErrorMessage($decoded->error_message);

            // no proper code returned, so we'll use 500
            $response = new WP_Error(500, $message, $decoded->data);
        } else {
            $response = $decoded;
        }

        return $response;
    }

    /**
     * Conditionally updates error message text.
     * 
     * @param string $message The existing error message.
     * 
     * @return string The updated error message.
     */
    private function filterErrorMessage($message)
    {
        
    }

    /**
     * Logs a new error.
     * 
     * @param mixed $message The error message.
     */
    private function logError($message)
    {

    }
}
