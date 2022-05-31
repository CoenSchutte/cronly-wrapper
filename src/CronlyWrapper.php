<?php

namespace CoenSchutte\CronlyWrapper;

class CronlyWrapper
{
    private $apiKey = '';

    static $BASE_URL = 'http://35.180.188.76/api/';



    /**
     * Constructs the CronlyWrapper object.
     *
     * @param string $apiKey The cronly API key. Required.
     *
     * @api
     */
    public function __construct($apiKey)
    {
        if (!is_string($apiKey) || empty($apiKey)) {
            throw new \InvalidArgumentException("You must provide an API key.");
        }

        $this->apiKey = $apiKey;
    }

    /**
     * Sets the API Key.
     *
     * @param string $apiKey API key for the cronly API.
     *
     * @api
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Gets the API Key.
     *
     * @return string The API key.
     *
     * @api
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }


    /**
     * Gets all monitors.
     *
     * @return JSON The JSON response with all monitors.
     *
     * @api
     */
    public function getAllMonitors()
    {
        return $this->get('monitors');
    }

    /**
     * Gets a monitor by ID.
     *
     * @param int $monitorId The ID of the monitor.
     *
     * @return JSON The JSON response with the monitor.
     *
     * @api
     */
    public function getMonitor($monitorId)
    {
        return $this->get('monitors/' . $monitorId);
    }

    /**
     * Deletes a monitor by ID.
     *
     * @param int $monitorId The ID of the monitor.
     *
     * @return JSON Nothing :(.
     *
     * @api
     */
    public function deleteMonitor($monitorId)
    {
        return $this->delete('monitors/' . $monitorId);
    }



    /**
     * Gets all certificates.
     *
     * @return JSON The JSON response with all monitors.
     *
     * @api
     */
    public function getAllCertificates()
    {
        return $this->get('certificates');
    }

    /**
     * Gets a certificate by ID.
     *
     * @param int $certificateId The ID of the certificate.
     *
     * @return JSON The JSON response with the certificate.
     *
     * @api
     */
    public function getCertificate($certificateId)
    {
        return $this->get('certificates/' . $certificateId);
    }

    /**
     * Deletes a certificate by ID.
     *
     * @param int $certificateId The ID of the certificate.
     *
     * @return JSON Nothing :(.
     *
     * @api
     */
    public function deleteCertificate($certificateId)
    {
        return $this->delete('certificates/' . $certificateId);
    }

    /**
     * Gets all notifications.
     *
     * @return JSON The JSON response with all monitors.
     *
     * @api
     */
    public function getAllNotifications()
    {
        return $this->get('notifications');
    }

    /**
     * Gets all projects.
     *
     * @return JSON The JSON response with all monitors.
     *
     * @api
     */
    public function getAllProjects()
    {
        return $this->get('projects');
    }

    /**
     * Gets a project by ID.
     *
     * @param int $projectId The ID of the project.
     *
     * @return JSON The JSON response with the project.
     *
     * @api
     */
    public function getProject($projectId)
    {
        return $this->get('projects/' . $projectId);
    }

    /**
     * Deletes a project by ID.
     *
     * @param int $projectId The ID of the project.
     *
     * @return JSON Nothing :(.
     *
     * @api
     */
    public function deleteProject($projectId)
    {
        return $this->delete('projects/' . $projectId);
    }


    /**
     * Gets all users.
     *
     * @return JSON The JSON response with all monitors.
     *
     * @api
     */
    public function getAllUsers()
    {
        return $this->get('users');
    }

    /**
     * Gets a user by ID.
     *
     * @param int $userId The ID of the user.
     *
     * @return JSON The JSON response with the user.
     *
     * @api
     */
    public function getUser($userId)
    {
        return $this->get('users/' . $userId);
    }


    private function get($endpoint)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => self::$BASE_URL . $endpoint,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->apiKey,
                'Content-Type: application/json'
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    private function delete($endpoint)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => self::$BASE_URL . $endpoint,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->apiKey,
                'Content-Type: application/json'
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    private function post($endpoint)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => self::$BASE_URL . $endpoint,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->apiKey,
                'Content-Type: application/json'
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
