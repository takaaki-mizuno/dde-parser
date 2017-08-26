<?php
namespace TakaakiMizuno\DDEParser;

class DDEParser
{
    public function parse($json, $assoc = false)
    {
        $columns = json_decode($json, true);
        $result = $assoc ? [] : new \stdClass();
        foreach ($columns as $key => $data) {
            if ($assoc) {
                $result[$key] = $this->readData($data, $assoc);
            } else {
                $result->$key = $this->readData($data, $assoc);
            }
        }

        return $result;
    }

    private function readData($data, $assoc = false)
    {
        $keys = array_keys($data);
        if (count($keys) != 1) {
            return null;
        }
        $key = $keys[0];
        switch ($key) {
            case "s":
            case "n":
            case "b":
                return $data[$key];
            case "l":
                $result = [];
                foreach ($data[$key] as $subdata) {
                    $result[] = $this->readData($subdata, $assoc);
                }
                return $result;
            case "m":
                $result = $assoc ? [] : new \stdClass();
                foreach ($data[$key] as $subkey => $subdata) {
                    if ($assoc) {
                        $result[$subkey] = $this->readData($subdata, $assoc);
                    } else {
                        $result->$subkey = $this->readData($subdata, $assoc);
                    }
                }
                return $result;
        }
        return null;
    }
}
