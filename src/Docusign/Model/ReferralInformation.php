<?php

namespace Docusign\Model;

class ReferralInformation extends Model {
    private $referralCode;
    private $referrerName;

    public function __construct($referralCode, $referrerName) {
        if( isset($referralCode) ) $this->referralCode = $referralCode;
        if( isset($referrerName) ) $this->referrerName = $referrerName;
    }

    public function setReferralCode($referralCode) { $this->referralCode = $referralCode; }
    public function getReferralCode() { return $this->referralCode; }
    public function setReferrerName($referrerName) { $this->referrerName = $referrerName; }
    public function getReferrerName() { return $this->referrerName; }
}
