<?php

declare(strict_types=1);

namespace App\View;

use App\Model\DTO\Credential;
use App\Model\DTO\CredentialError;

/**
 * Cette objet est retourné lors de la méthode start
 * du controller de connexion
 */
class ConnexionView
{
    public Credential $credential;

    public CredentialError $error;

    public function __construct()
    {
        $this->credential = new Credential();
        $this->error = new CredentialError();
    }
}
