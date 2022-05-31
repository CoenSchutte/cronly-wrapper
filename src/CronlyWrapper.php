<?php

namespace CoenSchutte\CronlyWrapper;

class CronlyWrapper
{
    private $apiKey = '';

    public static $BASE_URL = 'https://cronly.app/api/';

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
     * Creates a monitor.
     *
     * @param string $name The name of the monitor.
     * @param string $timezone The timezone of the monitor.
     * @param string $schedule The schedule of the monitor.
     * @param int $duration The duration of the monitor.
     * @param int $projectId The project id of the monitor.
     *
     * @return JSON The JSON response with all monitors for the user.
     *
     * @api
     */
    public function createMonitor($name, $timezone, $schedule, $duration, $projectId = null)
    {

        if (!is_string($name) || empty($name)) {
            throw new \InvalidArgumentException("You must provide a name.");
        }

        if (!is_string($timezone) || empty($timezone)) {
            throw new \InvalidArgumentException("You must provide a timezone.");
        }

        if (!is_string($schedule) || empty($schedule)) {
            throw new \InvalidArgumentException("You must provide a schedule.");
        }

        if (!is_int($duration) || $duration < 1) {
            throw new \InvalidArgumentException("You must provide a duration.");
        }

        if ($projectId !== null && !is_int($projectId)) {
            throw new \InvalidArgumentException("If you provide a project id it must be an integer.");
        }

        $endpoint = 'monitors?name=' . urlencode($name) . '&timezone=' . urlencode($timezone) . '&schedule=' . urlencode($schedule) . '&duration=' . urlencode($duration);

        if ($projectId !== null) {
            $endpoint .= '&project_id=' . urlencode($projectId);
        }

        return $this->post($endpoint);
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
     * Creates a certificate monitor.
     *
     * @param string $name The name of the monitor.
     * @param string $timezone The timezone of the monitor.
     * @param string $schedule The schedule of the monitor.
     * @param int $duration The duration of the monitor.
     * @param int $projectId The project id of the monitor.
     *
     * @return JSON The JSON response with all monitors for the user.
     *
     * @api
     */
    public function createCertificate($hostname, $port = 443, $projectId = null)
    {
        if (!is_string($hostname) || empty($hostname)) {
            throw new \InvalidArgumentException("You must provide a hostname.");
        }

        if ($port < 1) {
            throw new \InvalidArgumentException("You must provide a port.");
        }

        if ($projectId !== null && !is_int($projectId)) {
            throw new \InvalidArgumentException("If you provide a project id it must be an integer.");
        }

        $endpoint = 'certificates?hostname=' . urlencode($hostname) . '&port=' . urlencode($port);

        if ($projectId !== null) {
            $endpoint .= '&project_id=' . urlencode($projectId);
        }

        return $this->post($endpoint);
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
     * @param int $page The page you want to view.
     * @param int $perPage The amount of notifications per page.
     * 
     * @return JSON The JSON response with all monitors.
     * 
     * @api
     */
    public function getAllNotifications($page = 1, $perPage = 10)
    {
        return $this->get('notifications/?page=' . $page . '&per_page=' . $perPage);
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
     * Gets all monitors for a user.
     *
     * @param string $name The name of the project.
     *
     * @return JSON The JSON response with all monitors for the user.
     *
     * @api
     */
    public function createProject($name)
    {
        if (!is_string($name) || empty($name)) {
            throw new \InvalidArgumentException("You must provide a name.");
        }

        return $this->post('projects?name=' . urlencode($name));
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
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => self::$BASE_URL . $endpoint,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $this->apiKey,
                'Content-Type: application/json',
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    private function delete($endpoint)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => self::$BASE_URL . $endpoint,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $this->apiKey,
                'Content-Type: application/json',
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    private function post($endpoint)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => self::$BASE_URL . $endpoint,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $this->apiKey,
                'Content-Type: application/json',
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
