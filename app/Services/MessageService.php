<?php

namespace App\Services;
use RealRashid\SweetAlert\Facades\Alert;

class MessageService

{
    public  static function isEmpty($item)
    {
        return toast('Le champ '. $item. ' est obligatoire','error');
    }

    public  static function isError($message)
    {
        return toast('Erreur détectée!'.$message,'error');
    }

    public  static function successFully()
    {
        return toast("L'opération a été éffectuée avec succès!",'success');
    }

    public  static function isErrorFailed()
    {
        return toast("L'opération a échoué! veulliez réssayer",'error');
    }

    public  static function isErrorFailedUser()
    {
        return toast("L'opération a échoué! utilisateur non trouvé",'error');
    }

    public  static function isDataNoFound()
    {
        return toast("Vous n'êtes pas reconnues en tant que membre!",'error');
    }

    public  static function loginSuccess()
    {
        return toast("Connexion établir, vous pouvez continuer!",'success');
    }

    public  static function logoutSuccess()
    {
        return toast("Déconnexion avec succès!",'success');
    }

    public  static function AccountDisabled()
    {
        return toast("Ce compte n'est pas actif, merci de demander de l'aide!",'error');
    }

    public  static function isAlreadlyConnected()
    {
        return toast("Ce compte est déjà connecté, merci de demander de l'aide!",'error');
    }

    public  static function isAlreadlyDisconnected()
    {
        return toast("Ce compte est déjà déconnecté, merci!",'error');
    }

    public  static function emailExist()
    {
        return toast("Ce email est déjà utilisé, veuilliez le changer pour continuer!",'error');
    }

    public  static function failedRequest($_error)
    {
        return toast($_error,'error');
    }

    public  static function loginFailed($_error)
    {
        return toast($_error,'error');
    }
    public  static function isSuccess($_success)
    {
        return toast($_success,'success');
    }

}
