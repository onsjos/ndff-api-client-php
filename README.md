ndff-api-client-php
===================
Client for NDFF API 2, see http://beheer.ndff.nl/documentatie/api/waarnemingen.html for api documentation


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

``` php
    $code_request = new \NDFF\CodeRequest();
```
* GET speciesgroups *
``` php
    $speciesgroups = $code_request->resource_get('speciesgroups');
```

* GET speciesgroup butterflies *
``` php
    $speciesgroup_butterflies = $code_request->resource_get('speciesgroups/3596151');
```

* GET species in speciesgroup butterflies *
``` php
    $butterflies = $code_request->resource_get('speciesgroups/3596151/taxa');
```

* GET lifestages for butterflies *
``` php
    $butterflies = $code_request->resource_get('speciesgroups/3596151/lifestages');
```

* GET activities in english, ordered by name desc, limit to 10 results per page *
``` php
    $code_request->setUrlParameter('language', 'en');
    $code_request->setUrlParameter('ordering', '-name');
    $code_request->setUrlParameter('limit', '10');
    $activities = $code_request->resource_get('activities');
```

* Authenticate to the API and get an Oauth2 token
``` php
    $auth = new \NDFF\ApiAuthentication();
    
    // send username, password, client_id and (optional) client_secret
    $auth->authenticate('demo_user', '********', 'Oni9kqFIhPcfghIiX3a7ujFaF04M1T5w0ZUaYLUY', 'VbwYXdrn3QTGjtOUc9ZRXCNQJXH0DDNSGGTEB7sv343Pr2WA3tcx1IOx914dE2Mi0E9IWsxQ4y1EeEYJPowxvJwKiJIqtonVCrGZom4zQeYtpj3diHWxDRv3BcQCcHAuP');
    
    // you access_token
    $token = $auth->getToken();
```

* GET list of available Domains *
``` php
    $api_request = new \NDFF\APIRequest($token);
    $domains = $api_request->resource_get('domains');
```

* GET list of your Observations *
``` php
    $observations = $api_request->resource_get('observations');
    
    // Paginated response, get the nest page
    $api_request->setUrlParameter('page', 2);
    $observations = $api_request->resource_get('observations');
```

*POST a new NDFF observation*

``` php
    // create a new observation and set data
    $observation = new \NDFF\Observation();
    $observation->setDataset('http://telmee.nl/folders/332820');
    $observation->setAbundanceValue(1);
    $observation->setLocation(20, '{ "type": "Point", "coordinates": [5.850, 51.976]}');
    $observation->setTaxon('http://ndff-ecogrid.nl/taxonomy/taxa/cardueliscarduelis');
    $observation->addInvolved('http://ndff-ecogrid.nl/codes/involvementtypes/submitter', 'http://telmee.nl/contacts/persons/1170850');
    $observation->addExtrainfo('http://ndff-ecogrid.nl/codes/keys/observation/evidence', 'http://ndff-ecogrid.nl/codes/domainvalues/observation/evidence/photograph');
    
    // send the request to create it
    $result = $api_request->resource_post('observations', $observation);
```

*PUT an existing NDFF observation*

``` php
    // get existing observation
    $id = 12345;
    $existing_observation = $api_request->resource_get('observations', $id);
    $existing_observation->setAbundanceValue(77);
    $result = $api_request->resource_put('observations', $id, $existing_observation);
```

*In Silex Controller*
``` php
    use Symfony\Component\HttpFoundation\Response;

    // web/index.php
    require_once __DIR__.'/../vendor/autoload.php';

    $app = new Silex\Application();

    $app['debug'] = true;

    $app->get("/",function() {
        $code_request = new NDFF\CodeRequest();
        $butterflies = $code_request->resource_get('speciesgroups/3596151/taxa');
        return new Response(json_encode($butterflies));
    });

    $app->run();
```