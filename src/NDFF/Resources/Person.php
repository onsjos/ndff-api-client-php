<?php

/**
 * Author: jos
 * Date: 3/26/18
 * Class ndff_person
 * Creates an NDFF person object
 */

namespace NDFF;

class Person
{
    var $address;
    var $city;
    var $country;
    var $email;
    var $first_name;
    var $gender;
    var $identity;
    var $initials;
    var $number;
    var $phone;
    var $postalcode;
    var $surname;
    var $surname_prefix;
    var $username;

    /**
     * @return mixed
     */
    public function getAddress(){
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address){
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCity(){
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city){
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry(){
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country){
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email){
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFirstName(){
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name){
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getGender(){
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender){
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getIdentity(){
        return $this->identity;
    }

    /**
     * @param mixed $identity
     */
    public function setIdentity($identity){
        $this->identity = $identity;
    }

    /**
     * @return mixed
     */
    public function getInitials(){
        return $this->initials;
    }

    /**
     * @param mixed $initials
     */
    public function setInitials($initials){
        $this->initials = $initials;
    }

    /**
     * @return mixed
     */
    public function getNumber(){
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number){
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getPhone(){
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone){
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getPostalcode(){
        return $this->postalcode;
    }

    /**
     * @param mixed $postalcode
     */
    public function setPostalcode($postalcode) {
        $this->postalcode = $postalcode;
    }

    /**
     * @return mixed
     */
    public function getSurname() {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname) {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getSurnamePrefix() {
        return $this->surname_prefix;
    }

    /**
     * @param mixed $surname_prefix
     */
    public function setSurnamePrefix($surname_prefix) {
        $this->surname_prefix = $surname_prefix;
    }

    /**
     * @return mixed
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }


    /**
     * Create new Person
     */
    public function __construct() {

    }

}