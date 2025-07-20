<?php

include ("{$_SERVER['DOCUMENT_ROOT']}/eventx_website/data_access/models/organizer.php");
include ("{$_SERVER['DOCUMENT_ROOT']}/eventx_website/data_access/repositories/organizers_repo.php");

class Organizers_handler extends organizers_repository
{
    function getOrganizer($o_email)
    {
        $data_row = parent::getOrganizer($o_email);
        $org_model = Organizer::fromSqlRow($data_row);

        return $org_model;
    }

    

    function getOrganizerById($oid, bool $forview = false)
    {
        $data_row = parent::getOrganizerById($oid, $forview);
        $org_model = $forview  === false ? Organizer::fromSqlRow($data_row)
            : [
                'email' => $data_row['email'],
                'name' => $data_row['organization_name'],
                'bio' => $data_row['bio'],
            ];

        return $org_model;
    }

    function switchToOrganizer(UserModel $user, $brandName, $bio, $contacts)
    {
        $res = parent::becomeOrganizer($user, $brandName, $bio);
        if (!is_string($res)) {
            parent::addOrganizerContacts($res, $contacts);
            return $res;
        } else {
            return $res;
        }
    }

}

