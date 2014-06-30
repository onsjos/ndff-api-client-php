ndff-api-client-php
===================

Php classes for NDFF API
------------------------

Examples usage:

*GET speciesgroup butterflies*

``` php
    $ndff_code_request = new CodeRequest();
    $ndff_code_request->resource_get('speciesgroup/butterflies/');
    $butterflies = $ndff_code_request->get_response_data();
```

*GET a list of all lifestages in XML*

``` php
    $ndff_code_request = new CodeRequest('xml');
    $ndff_code_request->resource_get('field/lifestages');
    $lifestages = $ndff_code_request->get_response_data();
```

*POST a new NDFF observation*

``` php
    // create a new observation and set data
    $observation = new Observation();
    $observation->setDatasetidentity('http://ndff.nl/telmee/folders/12345');
    $observation->setOriginalabundance(1);
    $observation->setLocation(20, 'SRID=4326;POINT(5.850 51.496)', 'http://ndff-ecogrid.nl/codes/locationtypes/point');
    $observation->setTaxonidentity(12345);

    // set the observation and send the request
    $ndff_api_request = new ApiRequest('telmee', 'onsjos', '********');
    $ndff_api_request->set_request_data($observation);
    $ndff_api_request->resource_post('observation');
```

*PUT an existing NDFF observation*

``` php
    // get existing observation
    $ndff_api_request = new ApiRequest('telmee', 'onsjos', '********');
    $ndff_api_request->request_get('observation/by');
    $ndff_code_request->resource_get('field/lifestages');

    $observation->addExtrainfo('http://ndff-ecogrid.nl/codes/keys/validation/observation_status', 'nominal', 'http://ndff-ecogrid.nl/codes/domainvalues/validation/observation_status/concept');

```