<?php

require_once __DIR__ . '/../core/Model.php';

class ServiceModel extends Model
{
    protected string $table = 'services';

    public function __construct()
    {
        parent::__construct();
        $this->fixInvalidIcons();
    }

    private function fixInvalidIcons(): void
    {
        try {
            $this->query("UPDATE services SET icon = 'house-door-fill' WHERE icon = 'home'");
            $this->query("UPDATE services SET icon = 'paint-bucket' WHERE icon = 'paint'");
        } catch (\Throwable $e) {
            // ignore if table doesn't exist yet
        }
    }
}
