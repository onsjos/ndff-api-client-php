ndff-api-client-php
===================

Php classes for NDFF API
------------------------

Examples usage:

*GET speciesgroup butterflies*

``` php
    $ndff_code_request = new ndff_code_request();
    $ndff_code_request->resource_get('speciesgroup/butterflies/');
    $butterflies = $ndff_code_request->get_response_data();
```

*GET a list of availablelifestages in XML*

``` php
    $ndff_code_request = new ndff_code_request('xml');
    $ndff_code_request->resource_get('field/lifestages');
    $lifestages = $ndff_code_request->get_response_data();
```

*POST a new NDFF observation*

``` php
    // create a new observation and set data
    $observation = new ndff_observation();
    $observation->setDatasetidentity('http://ndff.nl/telmee/folders/12345');
    $observation->setOriginalabundance(1);
    $observation->setLocation(20, 'SRID=4326;POINT(5.850 51.496)', 'http://ndff-ecogrid.nl/codes/locationtypes/point');
    $observation->addExtrainfo('http://ndff-ecogrid.nl/codes/keys/validation/observation_status', 'nominal', 'http://ndff-ecogrid.nl/codes/domainvalues/validation/observation_status/concept');
    $observation->setTaxonidentity(12345);

    // set the observation and send the request
    $ndff_api_request = new ndff_api_request('telmee', 'onsjos', '********');
    $ndff_api_request->set_request_data($observation);
    $ndff_api_request->resource_post('observation');
```