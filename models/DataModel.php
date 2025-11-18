<?php
class DataModel {
    private $dataFilePath = __DIR__ . '/../dados.json';

    /**
     * 
     * @param string $jsonContent 
     * @return bool
     */
    public function saveSensorData($jsonContent) {
        return file_put_contents($this->dataFilePath, $jsonContent);
    }

    /**
     * 
     * @return array|null
     */
    public function getSensorData() {
        if (file_exists($this->dataFilePath)) {
            $content = file_get_contents($this->dataFilePath);
            return json_decode($content, true);
        }
        return null;
    }
}
?>