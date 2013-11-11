ndff-api-client-php
===================

php classes for NDFF API

Examples usage:

    // create a new ndff observation object
    $observation = new ndff_observation();

    // set/change fields
    $observation->setDatasetidentity('http://ndff.nl/telmee/folders/12345');
    $observation->setOriginalabundance(1);
    $observation->setLocation(20, 'SRID=4326;POINT(5.850 51.496)', 'http://ndff-ecogrid.nl/codes/locationtypes/point');
    $observation->addExtrainfo('http://ndff-ecogrid.nl/codes/keys/validation/observation_status', 'nominal', 'http://ndff-ecogrid.nl/codes/domainvalues/validation/observation_status/concept');
    $observation->setTaxonidentity(12345);

    // create a new ndff_api_request
    $ndff_api_request = new ndff_api_request('telmee', 'onsjos', '********','json');
    // add previously created observation as data

    $ndff_api_request->set_request_data($observation);

    // POST it
    $ndff_api_request->resource_post('observation');
