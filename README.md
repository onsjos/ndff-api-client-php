ndff-api-client-php
===================
Client for ndff api, see http://beheer.ndff.nl/documentatie/api/waarnemingen.html for api documentation


Installing
------------------------
Download the zip from github or install through [composer](www.getcomposer.org). Add the lines below to `composer.json` en run
`php composer.phar update ndff/api-client`
``` JSON
{
    "require": {
        "ndff/api-client": "dev-master"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/onsjos/ndff-api-client-php.git"
        }
    ]    
}
```

Examples
------------------------
After including the classes (e.g. with the composer autoloader) you should be able
to run the following examples.

*GET speciesgroup butterflies*

``` php
    $ndff_code_request = new NDFF\CodeRequest();
    $ndff_code_request->resource_get('speciesgroup/butterflies/');
    $butterflies = $ndff_code_request->get_response_data();
```

*GET a list of all lifestages in XML*

``` php
    $ndff_code_request = new NDFF\CodeRequest('xml');
    $ndff_code_request->resource_get('field/lifestages');
    $lifestages = $ndff_code_request->get_response_data();
```

*POST a new NDFF observation*

``` php
    // create a new observation and set data
    $observation = new NDFF\Observation();
    $observation->setDatasetidentity('http://ndff.nl/telmee/folders/12345');
    $observation->setOriginalabundance(1);
    $observation->setLocation(20, 'SRID=4326;POINT(5.850 51.496)', 'http://ndff-ecogrid.nl/codes/locationtypes/point');
    $observation->setTaxonidentity(12345);

    // set the observation and send the request
    $ndff_api_request = new NDFF\ApiRequest('telmee', 'onsjos', '********');
    $ndff_api_request->set_request_data($observation);
    $ndff_api_request->resource_post('observation');
```

*PUT an existing NDFF observation*

``` php
    // get existing observation
    $ndff_api_request = new NDFF\ApiRequest('telmee', 'onsjos', '********');
    $ndff_api_request->request_get('observation/by');
    $ndff_code_request->resource_get('field/lifestages');

    $observation->addExtrainfo('http://ndff-ecogrid.nl/codes/keys/validation/observation_status', 'nominal', 'http://ndff-ecogrid.nl/codes/domainvalues/validation/observation_status/concept');

```

*In Silex Controller*
```php
use Symfony\Component\HttpFoundation\Response;

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

$app->get("/",function() {
    $ndff_code_request = new NDFF\CodeRequest();
    $ndff_code_request->resource_get('speciesgroup/butterflies/');
    $butterflies = $ndff_code_request->get_response_data();
    return new Response(json_encode($butterflies));
});

$app->run();
```