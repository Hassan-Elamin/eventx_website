<?php

// organizers table
class Organizer
{
    public $oid;
    public $email;

    public $name;
    public $bio;
    public $activated;

    public function __construct($oid, $email, $organization_name, $bio, $activated)
    {
        $oid !== null ? $this->oid = $oid : null;
        $this->email = $email;
        $this->name = $organization_name;
        $this->bio = $bio;
        $activated !== null ? $this->activated = $activated : null;
    }

    public static function fromSqlRow(array $row)
    {
        return new Organizer(
            $row['oid'] ?? null,
            $row['email'],
            $row['organization_name'],
            $row['bio'],
            $row['activated'] ?? null,
        );
    }
}
