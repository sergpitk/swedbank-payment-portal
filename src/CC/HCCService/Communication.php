<?php

namespace SwedbankPaymentPortal\CC\HCCService;

use SwedbankPaymentPortal\AbstractCommunication;
use SwedbankPaymentPortal\CC\HCCCommunicationEntity\AuthorizationRequest\AuthorizationRequest;
use SwedbankPaymentPortal\CC\HCCCommunicationEntity\AuthorizationResponse\AuthorizationResponse;
use SwedbankPaymentPortal\CC\HCCCommunicationEntity\HCCQueryRequest\HCCQueryRequest;
use SwedbankPaymentPortal\CC\HCCCommunicationEntity\HCCQueryResponse\HCCQueryResponse;
use SwedbankPaymentPortal\CC\HCCCommunicationEntity\SetupRequest\SetupRequest;
use SwedbankPaymentPortal\CC\HCCCommunicationEntity\SetupResponse\SetupResponse;
use SwedbankPaymentPortal\CC\HCCCommunicationEntity\ThreeDSecureAuthorizationRequest\ThreeDSecureAuthorizationRequest;
use SwedbankPaymentPortal\CC\HCCCommunicationEntity\ThreeDSecureAuthorizationResponse\ThreeDSecureAuthorizationResponse;
use SwedbankPaymentPortal\Logger\LoggerInterface;
use SwedbankPaymentPortal\Logger\NullLogger;
use SwedbankPaymentPortal\Options\CommunicationOptions;
use SwedbankPaymentPortal\Network;
use SwedbankPaymentPortal\SensitiveDataCleanup;
use SwedbankPaymentPortal\Serializer;
use SwedbankPaymentPortal\SharedEntity\Type\TransportType;

/**
 * Handles communication with guzzle.
 */
class Communication extends AbstractCommunication
{
    /**
     * Send a setup request.
     *
     * @param SetupRequest $setupRequest
     *
     * @return SetupResponse
     */
    public function sendSetupRequest(SetupRequest $setupRequest)
    {
        return $this->sendDataToNetwork(
            $setupRequest,
            SetupResponse::class,
            $this->getOptions()->getEndpoint(),
            TransportType::setup()
        );
    }

    /**
     * Send authorization request.
     *
     * @param AuthorizationRequest $authorizationRequest
     *
     * @return AuthorizationResponse
     */
    public function sendAuthRequest(AuthorizationRequest $authorizationRequest)
    {
        return $this->sendDataToNetwork(
            $authorizationRequest,
            AuthorizationResponse::class,
            $this->getOptions()->getEndpoint(),
            TransportType::authorization()
        );
    }
    
    /**
     * Send authorization request.
     *
     * @param HCCQueryRequest $hccQueryRequest
     *
     * @return HCCQueryResponse
     */
    public function sendHCCQueryRequest(HCCQueryRequest $hccQueryRequest)
    {
        return $this->sendDataToNetwork(
            $hccQueryRequest,
            HCCQueryResponse::class,
            $this->getOptions()->getEndpoint(),
            TransportType::hccQueryRequest()
        );
    }

    /**
     * Send three D authorization request.
     *
     * @param ThreeDSecureAuthorizationRequest $authorizationRequest
     *
     * @return ThreeDSecureAuthorizationResponse
     */
    public function sendThreeDAuthRequest(ThreeDSecureAuthorizationRequest $authorizationRequest)
    {
        return $this->sendDataToNetwork(
            $authorizationRequest,
            ThreeDSecureAuthorizationResponse::class,
            $this->getOptions()->getEndpoint(),
            TransportType::threeDauthorization()
        );
    }
}
