<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Repositories\Country\CountryRepository;
use App\Repositories\Currency\CurrencyRepository;
use App\Repositories\State\StateRepository;
use App\Repositories\Timezone\TimezoneRepository;

class PublicApiController extends Controller
{
    private $_timezoneRepo;
    private $_currencyRepo;
    private $_countryRepo;
    private $_stateRepo;

    public function __construct(
        TimezoneRepository $timezoneRepo,
        CurrencyRepository $currencyRepo,
        CountryRepository  $countryRepo,
        StateRepository    $stateRepo
    )
    {
        $this->_timezoneRepo = $timezoneRepo;
        $this->_currencyRepo = $currencyRepo;
        $this->_countryRepo  = $countryRepo;
        $this->_stateRepo    = $stateRepo;
    }

    public function timezones()
    {
        try {
            $timezones = $this->_timezoneRepo->all();
            return $this->jsonData($timezones);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    public function currencies()
    {
        try {
            $currencies = $this->_currencyRepo->all();
            return $this->jsonData($currencies);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    public function countries()
    {
        try {
            $countries = $this->_countryRepo->all();
            return $this->jsonData($countries);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    public function states()
    {
        try {
            $states = $this->_stateRepo->all();
            return $this->jsonData($states);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
