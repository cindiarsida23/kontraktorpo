<?php

require_once __DIR__ . '/../core/Model.php';

class SiteSettingModel extends Model
{
    protected string $table = 'site_settings';

    public function get(string $key, string $default = ''): string
    {
        $result = $this->query("SELECT key_value FROM site_settings WHERE key_name = ?", [$key]);
        if (!empty($result) && isset($result[0]['key_value'])) {
            return $result[0]['key_value'];
        }
        return $default;
    }

    public function set(string $key, string $value): void
    {
        $existing = $this->query("SELECT id FROM site_settings WHERE key_name = ?", [$key]);
        if (!empty($existing)) {
            $this->query("UPDATE site_settings SET key_value = ? WHERE key_name = ?", [$value, $key]);
        } else {
            $this->query("INSERT INTO site_settings (key_name, key_value) VALUES (?, ?)", [$key, $value]);
        }
    }

    public function getAllAsMap(): array
    {
        $rows = $this->all();
        $map = [];
        foreach ($rows as $row) {
            $map[$row['key_name']] = $row['key_value'];
        }
        return $map;
    }
}
