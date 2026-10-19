<?php

require_once __DIR__ . '/../core/Model.php';

class ContactModel extends Model
{
    protected string $table = 'contacts';

    public function getUnreadCount(): int
    {
        $result = $this->query("SELECT COUNT(*) as total FROM contacts WHERE status = 'new'");
        return (int)($result[0]['total'] ?? 0);
    }
}
