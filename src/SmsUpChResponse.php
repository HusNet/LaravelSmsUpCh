<?php

namespace Husnet\LaravelSmsUpCh;

/**
 * Class SmsUpChResponse
 * @package Husnet\LaravelSmsUpCh
 */
class SmsUpChResponse
{
    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $ticket;

    /**
     * @var string
     */
    private $cost;

    /**
     * @var string
     */
    private $credits;

    /**
     * @var string
     */
    private $total;

    /**
     * @var string
     */
    private $sent;

    /**
     * @var string
     */
    private $blacklisted;

    /**
     * @var string
     */
    private $duplicated;

    /**
     * @var string
     */
    private $invalid;

    /**
     * @var string
     */
    private $npai;

    public function __construct(array $response)
    {
        $this->status = $response['status'] ?? 'unknown';
        $this->message = $response['message'] ?? '';
        $this->ticket = $response['ticket'] ?? '';
        $this->cost = $response['cost'] ?? '';
        $this->credits = $response['credits'] ?? '';
        $this->total = $response['total'] ?? '';
        $this->sent = $response['sent'] ?? '';
        $this->blacklisted = $response['blacklisted'] ?? '';
        $this->duplicated = $response['duplicated'] ?? '';
        $this->invalid = $response['invalid'] ?? '';
        $this->npai = $response['npai'] ?? '';
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return string|null
     */
    public function getTicket(): ?string
    {
        return $this->ticket;
    }

    /**
     * @return string|null
     */
    public function getCost(): ?string
    {
        return $this->cost;
    }

    /**
     * @return string|null
     */
    public function getCredits(): ?string
    {
        return $this->credits;
    }

    /**
     * @return string|null
     */
    public function getTotal(): ?string
    {
        return $this->total;
    }

    /**
     * @return string|null
     */
    public function getSent(): ?string
    {
        return $this->sent;
    }

    /**
     * @return string|null
     */
    public function getBlacklisted(): ?string
    {
        return $this->blacklisted;
    }

    /**
     * @return string|null
     */
    public function getDuplicated(): ?string
    {
        return $this->duplicated;
    }

    /**
     * @return string|null
     */
    public function getInvalid(): ?string
    {
        return $this->invalid;
    }

    /**
     * @return string|null
     */
    public function getNpai(): ?string
    {
        return $this->npai;
    }
}